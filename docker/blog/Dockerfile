FROM node:20-alpine

WORKDIR /app

# Install curl for health checks if needed
RUN apk add --no-cache curl

# Copy dependencies first for Docker caching
COPY blog/package*.json ./
RUN npm install

# Copy application source
COPY blog/ .

# Copy entrypoint script
COPY docker/blog/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

EXPOSE 4321

ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
