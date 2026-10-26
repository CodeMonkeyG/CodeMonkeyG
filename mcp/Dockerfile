FROM node:22-alpine
WORKDIR /app
COPY mcp/server.mjs mcp/site-data.json ./
COPY blog/src/content/blog ./blog-content
USER node
EXPOSE 3000
CMD ["node", "server.mjs"]
