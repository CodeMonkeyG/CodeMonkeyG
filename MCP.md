# Public MCP endpoint

`https://codemonkeyg.com/mcp` is an intentionally anonymous, read-only MCP Streamable HTTP endpoint. It exposes `get_site_info`, `search_content`, and `search_blog`; blog results are limited to the curated public blog metadata allowlist. It has no write, fetch, filesystem, shell, private-data, or deployment tools.

Only JSON-RPC `initialize`, `notifications/initialized`, `tools/list`, and `tools/call` are accepted over `POST`; the service limits request bodies to 16 KiB and each IP to 60 requests/minute. CORS only accepts this site's HTTPS origins.

For a protocol check:

```sh
curl -sS https://codemonkeyg.com/mcp -H 'content-type: application/json' \
  --data '{"jsonrpc":"2.0","id":1,"method":"tools/list","params":{}}'
```
