# CodeMonkeyG Engineering Blog (Astro)

A modern, fast, markdown-driven technical blog built with [Astro](https://astro.build/) and [Tailwind CSS](https://tailwindcss.com/), containerized alongside the [CodeMonkeyG](https://codemonkeyg.com) resume site.

---

## 🚀 Features

- **Markdown & Content Collections**: Strict TypeScript validation for frontmatter schema (`title`, `description`, `pubDate`, `tags`, `author`, `draft`).
- **Matching Design System**: Built with the exact dark theme and color palette of CodeMonkeyG (`#0099ff`, `#ff9900`, `#181818`, and `#202022`).
- **Dynamic Routing**:
  - `/blog`: Blog index listing all articles sorted by date.
  - `/blog/posts/[slug]`: Rendered markdown articles with reading time and syntax highlighting.
  - `/blog/tags`: Topic index.
  - `/blog/tags/[tag]`: Articles filtered by technology tag.
  - `/blog/rss.xml`: Full RSS 2.0 feed for readers and syndication.
- **Docker Containerized**: Runs as an isolated service behind Nginx with automatic subpath routing (`/blog`).
- **HMR / Live Reloading**: Edits to `.md` posts or Astro components update immediately during development.

---

## ✍️ Adding a New Blog Post

Create a new Markdown file inside `blog/src/content/blog/` (e.g. `my-new-post.md`):

```markdown
---
title: "Title of Your Article"
description: "Brief summary for SEO, social previews, and cards."
pubDate: 2026-09-19
author: "Giovanni Alvarez"
tags: ["Architecture", "Docker", "Go"]
draft: false
---

Your markdown content goes here!

## Subheading

Code blocks, images, blockquotes, and lists work out of the box.
```

The new post will immediately appear on `/blog`, `/blog/tags`, and in `/blog/rss.xml`.

---

## 🐳 Docker Commands

From the root `CodeMonkeyG` directory:

```bash
# Start all services (nginx, php, blog) in the background
docker compose up -d

# View blog container logs
docker compose logs -f blog

# Rebuild container after updating dependencies
docker compose up -d --build blog
```

---

## 💻 Local Development Without Docker

```bash
cd blog
npm install
npm run dev
```

Visit [http://localhost:4321/blog](http://localhost:4321/blog).
