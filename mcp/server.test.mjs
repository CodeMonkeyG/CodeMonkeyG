import assert from 'node:assert/strict';
import test from 'node:test';
import { createServer } from './server.mjs';
import config from './site-data.json' with { type: 'json' };

test('exposes only declared MCP tools and validates content search', async (t) => {
  const server = createServer({ ...config, blog: [{ title: 'Public blog post', url: 'https://codemonkeyg.com/blog/posts/example/', date: '2026-01-01', description: 'Public metadata.' }] });
  await new Promise((resolve) => server.listen(0, '127.0.0.1', resolve));
  t.after(() => server.close());
  const url = `http://127.0.0.1:${server.address().port}/mcp`;
  const request = (method, params) => fetch(url, { method: 'POST', headers: { 'content-type': 'application/json' }, body: JSON.stringify({ jsonrpc: '2.0', id: 1, method, params }) });
  const tools = await (await request('tools/list', {})).json();
  assert.deepEqual(tools.result.tools.map((tool) => tool.name), ['get_site_info', 'search_content', 'search_blog']);
  const search = await (await request('tools/call', { name: 'search_content', arguments: { query: 'resume' } })).json();
  assert.match(search.result.content[0].text, /Resume/);
  assert.equal((await fetch(`${url}/other`)).status, 404);
});
