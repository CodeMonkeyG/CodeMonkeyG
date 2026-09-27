---
author: "Giovanni Alvarez"
canonical_url: https://codemonkeyg.com/blog/posts/welcome-to-the-blog/
date: 2026-09-18 00:00:00 UTC
description: "Welcome to my engineering notebook. Here is why I built this markdown-powered blog with Astro, containerized it in Docker, and what topics to expect."
draft: false
pubDate: 2026-09-18
published: true
tags: ["Astro", "WebDev", "Docker"]
title: "Launching the CodeMonkeyG Tech Blog"
---

Welcome to the **CodeMonkeyG** blog!

For years, my web home at [codemonkeyg.com](https://codemonkeyg.com) has served as an interactive resume and showcase of my work as a Systems Architect and Founding Engineer. But as systems grow and architectures evolve, having a dedicated space to write in-depth technical breakdowns, share architectural post-mortems, and document hard-earned lessons has become essential. So I spun up [codemonkeyg.com/blog](https://codemonkeyg.com/blog) It will also be place where I share some life philosophies that I feel influence the way I do what I do.

## Why Astro for Markdown Blogging?

When deciding how to build this blog, I evaluated several static site generators and frameworks. I chose **Astro** for several key reasons:

1. **Zero-JS by Default**: Astro renders pure HTML/CSS by default. For content-heavy technical blogs, this yields unbeatable lighthouse scores, sub-second load times, and minimal resource usage.
2. **First-Class Markdown & Content Collections**: Content collections provide strict TypeScript type safety for Markdown frontmatter at compile time, eliminating broken links or malformed metadata.
3. **Seamless Design Integration**: By utilizing Tailwind CSS configured with the same color palette as the main CodeMonkeyG resume (`#0099ff`, `#ff9900`, and `#181818`), the blog feels like an organic extension of the primary site.
4. **Clean Subpath Routing**: With Astro's `base: '/blog'` configuration, the blog lives cleanly under the `/blog` subdirectory.

This lines up with my philosophy of using the right tools for the right job. With Astro I can connect to my server and write an article as markdown file. No need for whole admin panel. I can keep everything versioned in a git repository and back it up as easy as git push.

While it may not be a tool for everyone, it was the right one for me to set up this blog.

## Docker Architecture

Just like the main CodeMonkeyG site, the Astro blog runs inside Docker. An Nginx reverse proxy terminates SSL on the frontend and handles upstream traffic delegation:

- Root `/` &rarr; Served by containerized Nginx.
- Subpath `/blog` &rarr; Reverse-proxied to the Astro container running on port `4321`.

> "Simplicity is prerequisite for reliability." - Edsger W. Dijkstra

## What to Expect Next

Upcoming articles will dive into:
- Architectural patterns for high-concurrency systems
- Docker and container orchestration strategies
- Practical database optimization and caching layers
- Modernizing legacy enterprise software

Stay tuned, and feel free to reach out via [LinkedIn](https://www.linkedin.com/in/codemonkeyg/) or [GitHub](https://github.com/CodeMonkeyG)!
