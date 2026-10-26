import http from 'node:http';
import { readFile, readdir } from 'node:fs/promises';
import { fileURLToPath } from 'node:url';

const MAX_BODY_BYTES = 16 * 1024;
const MAX_QUERY_LENGTH = 120;
const RATE_LIMIT = 60;
const RATE_WINDOW_MS = 60_000;

const json = (response, status, body, origin) => {
  const headers = {
    'Content-Type': 'application/json; charset=utf-8',
    'Cache-Control': 'no-store',
    'X-Content-Type-Options': 'nosniff',
  };
  if (origin) headers['Access-Control-Allow-Origin'] = origin;
  response.writeHead(status, headers);
  response.end(JSON.stringify(body));
};

const responseFor = (id, result) => ({ jsonrpc: '2.0', id, result });
const errorFor = (id, code, message) => ({ jsonrpc: '2.0', id: id ?? null, error: { code, message } });
const textResult = (value) => ({ content: [{ type: 'text', text: JSON.stringify(value) }] });

export const loadBlogPosts = async (directory) => {
  const files = (await readdir(directory)).filter((file) => file.endsWith('.md'));
  const posts = await Promise.all(files.map(async (file) => {
    const source = await readFile(new URL(file, directory), 'utf8');
    const frontmatter = source.match(/^---\r?\n([\s\S]*?)\r?\n---/);
    if (!frontmatter || /^(?:draft|published):\s*(?:true|false)\s*$/m.test(frontmatter[1]) && (/^draft:\s*true\s*$/m.test(frontmatter[1]) || /^published:\s*false\s*$/m.test(frontmatter[1]))) return null;
    const field = (name) => frontmatter[1].match(new RegExp(`^${name}:\\s*["']?(.+?)["']?\\s*$`, 'm'))?.[1];
    const title = field('title');
    const description = field('description');
    const date = field('pubDate') ?? field('date');
    if (!title || !description || !date) return null;
    const slug = file.replace(/\.md$/, '');
    return { title, date, description, url: `https://codemonkeyg.com/blog/posts/${slug}/` };
  }));
  return posts.filter(Boolean).sort((a, b) => b.date.localeCompare(a.date));
};

export const createServer = (config) => {
  const requests = new Map();
  const allowedOrigins = new Set([`https://${config.domain}`, `https://www.${config.domain}`]);

  const getOrigin = (request) => {
    const origin = request.headers.origin;
    return typeof origin === 'string' && allowedOrigins.has(origin) ? origin : undefined;
  };

  const rateLimited = (request) => {
    const ip = request.headers['x-real-ip'] ?? request.socket.remoteAddress ?? 'unknown';
    const now = Date.now();
    const timestamps = (requests.get(ip) ?? []).filter((timestamp) => now - timestamp < RATE_WINDOW_MS);
    timestamps.push(now);
    requests.set(ip, timestamps);
    return timestamps.length > RATE_LIMIT;
  };

  const tools = [
    {
      name: 'get_site_info',
      description: 'Returns curated public information about this website.',
      inputSchema: { type: 'object', additionalProperties: false, properties: {} },
    },
    {
      name: 'search_content',
      description: 'Searches this site’s curated public content. It never fetches URLs or reads files supplied by callers.',
      inputSchema: {
        type: 'object',
        additionalProperties: false,
        required: ['query'],
        properties: { query: { type: 'string', minLength: 1, maxLength: MAX_QUERY_LENGTH } },
      },
    },
    ...(config.blog ? [{
      name: 'search_blog',
      description: 'Lists or searches public blog posts from the allowlisted blog content collection.',
      inputSchema: {
        type: 'object',
        additionalProperties: false,
        properties: { query: { type: 'string', minLength: 1, maxLength: MAX_QUERY_LENGTH } },
      },
    }] : []),
    ...(config.services ? [{
      name: 'list_services',
      description: 'Lists the site’s explicit public service catalog.',
      inputSchema: {
        type: 'object',
        additionalProperties: false,
        properties: { language: { type: 'string', enum: Object.keys(config.services) } },
      },
    }] : []),
  ];

  const search = (items, query) => {
    const normalized = query.trim().toLocaleLowerCase();
    if (!normalized || normalized.length > MAX_QUERY_LENGTH) return null;
    return items.filter((item) => JSON.stringify(item).toLocaleLowerCase().includes(normalized));
  };

  const invoke = (name, args) => {
    if (!args || Array.isArray(args) || typeof args !== 'object') throw new Error('arguments must be an object');
    if (name === 'get_site_info' && Object.keys(args).length === 0) return config.siteInfo;
    if (name === 'search_content' && Object.keys(args).length === 1 && typeof args.query === 'string') {
      const results = search(config.content, args.query);
      if (!results) throw new Error(`query must be 1-${MAX_QUERY_LENGTH} characters`);
      return { query: args.query.trim(), results, message: results.length ? undefined : 'No matching curated public content found.' };
    }
    if (name === 'search_blog' && config.blog && (Object.keys(args).length === 0 || (Object.keys(args).length === 1 && typeof args.query === 'string'))) {
      const results = args.query === undefined ? config.blog : search(config.blog, args.query);
      if (!results) throw new Error(`query must be 1-${MAX_QUERY_LENGTH} characters`);
      return { ...(args.query === undefined ? {} : { query: args.query.trim() }), posts: results, message: results.length ? undefined : 'No matching public blog posts found.' };
    }
    if (name === 'list_services' && config.services && (Object.keys(args).length === 0 || (Object.keys(args).length === 1 && Object.hasOwn(config.services, args.language)))) {
      const language = args.language ?? Object.keys(config.services)[0];
      return { language, services: config.services[language] };
    }
    throw new Error('Unknown tool or invalid arguments');
  };

  return http.createServer((request, response) => {
    const origin = getOrigin(request);
    if (request.url !== '/mcp') return json(response, 404, { error: 'Not found' }, origin);
    if (request.method === 'OPTIONS') {
      if (!origin) return json(response, 403, { error: 'Origin not allowed' });
      response.writeHead(204, { 'Access-Control-Allow-Origin': origin, 'Access-Control-Allow-Methods': 'POST, OPTIONS', 'Access-Control-Allow-Headers': 'content-type, mcp-protocol-version', 'Access-Control-Max-Age': '600', Vary: 'Origin' });
      return response.end();
    }
    if (request.method !== 'POST') {
      response.setHeader('Allow', 'POST, OPTIONS');
      return json(response, 405, { error: 'Method not allowed' }, origin);
    }
    if (rateLimited(request)) return json(response, 429, { error: 'Too many requests' }, origin);
    if (!request.headers['content-type']?.startsWith('application/json')) return json(response, 400, { error: 'Content-Type must be application/json' }, origin);

    let size = 0;
    let body = '';
    request.on('data', (chunk) => {
      size += chunk.length;
      if (size > MAX_BODY_BYTES) request.destroy();
      else body += chunk;
    });
    request.on('error', () => json(response, 400, { error: 'Request body exceeds 16 KiB' }, origin));
    request.on('end', () => {
      if (size > MAX_BODY_BYTES) return;
      let rpc;
      try { rpc = JSON.parse(body); } catch { return json(response, 400, { error: 'Invalid JSON' }, origin); }
      if (!rpc || rpc.jsonrpc !== '2.0' || typeof rpc.method !== 'string') return json(response, 400, { error: 'Invalid JSON-RPC request' }, origin);
      let result;
      if (rpc.method === 'initialize') {
        result = { protocolVersion: '2025-03-26', capabilities: { tools: {} }, serverInfo: { name: config.name, version: '1.0.0' }, instructions: config.instructions };
      } else if (rpc.method === 'notifications/initialized') {
        return response.writeHead(202).end();
      } else if (rpc.method === 'tools/list') {
        result = { tools };
      } else if (rpc.method === 'tools/call') {
        try { result = textResult(invoke(rpc.params?.name, rpc.params?.arguments ?? {})); }
        catch (error) { result = { ...textResult({ error: error.message }), isError: true }; }
      } else {
        return json(response, 200, errorFor(rpc.id, -32601, 'Method not found'), origin);
      }
      return json(response, 200, responseFor(rpc.id, result), origin);
    });
  });
};

const configPath = fileURLToPath(new URL('./site-data.json', import.meta.url));
if (process.argv[1] === fileURLToPath(import.meta.url)) {
  const config = JSON.parse(await readFile(configPath, 'utf8'));
  if (config.blogContentDirectory) {
    const directory = new URL(`${config.blogContentDirectory.replace(/^\.\//, '')}/`, import.meta.url);
    config.blog = await loadBlogPosts(directory);
  }
  createServer(config).listen(3000, '0.0.0.0');
}
