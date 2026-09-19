---
title: "Containerizing Full-Stack Systems with Docker and Nginx"
description: "A pragmatic guide to architecting multi-container production environments with reverse proxies, SSL termination, and subpath routing."
pubDate: 2026-09-15
author: "Giovanni Alvarez"
tags: ["Docker", "Nginx", "DevOps", "Architecture"]
draft: false
---

Deploying multi-tier applications across microservices or hybrid static/dynamic stacks often suffers from over-engineering. In many environments, a simple, declarative Docker Compose setup coupled with Nginx provides superior reliability and observability compared to heavyweight Kubernetes clusters.

## The Architecture Pattern

In this architecture, Nginx acts as the single ingress gateway for our domain:

```
[ Incoming Requests (Port 443 / 80) ]
                  |
                  v
       [ Nginx Reverse Proxy ]
        /         |          \
       v          v           v
  [ Static/PHP ] [ Astro Blog ] [ Backend Services ]
   (Port 9000)    (Port 4321)      (DB / Queues)
```

### Nginx Subpath Routing

To route traffic to our Astro blog running in its own container, we configure Nginx to proxy `/blog` requests directly to the `blog` service name:

```nginx
# docker/nginx/default.conf
location /blog {
    proxy_pass http://blog:4321;
    proxy_http_version 1.1;
    proxy_set_header Upgrade $http_upgrade;
    proxy_set_header Connection "upgrade";
    proxy_set_header Host $host;
    proxy_set_header X-Real-IP $remote_addr;
    proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
    proxy_set_header X-Forwarded-Proto $scheme;
}
```

### The Docker Compose Definition

The blog service definition is straightforward:

```yaml
services:
  blog:
    container_name: codemonkeyg-blog
    restart: unless-stopped
    build:
      context: .
      dockerfile: docker/blog/Dockerfile
    volumes:
      - ./blog:/app
      - /app/node_modules
    ports:
      - "4321:4321"
    environment:
      - NODE_ENV=development
```

Using volume mounts allows local changes to Markdown files or Astro components to trigger instant Hot Module Replacement (HMR) without restarting the container.

## Key Benefits

- **Isolation**: The blog's Node.js runtime is completely decoupled from PHP-FPM or static assets.
- **Portability**: Any developer can clone the repository and run `docker compose up -d` to get the entire website and blog running locally.
- **Zero-downtime upgrades**: Updating blog dependencies or node versions never affects the primary application.
