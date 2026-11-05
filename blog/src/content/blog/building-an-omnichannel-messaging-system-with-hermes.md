---
title: "Building an Omnichannel Messaging System with Hermes"
description: "What it has been like building an internal Chat foundation for an omnichannel messaging system with Hermes as my coding agent."
pubDate: 2026-11-05
author: "Giovanni Alvarez"
tags: ["AI", "Hermes", "Agentic Systems", "Software Development", "Messaging", "SMS", "Email", "Architecture"]
draft: false
---

I have spent the last stretch of development building an omnichannel messaging system with Hermes as my coding agent, and I have genuinely enjoyed the experience. The project is still in progress, but it has already moved from a rough Conversations wireframe to a working internal Chat slice with real company users, real participant records, real message history, and a functioning thread view. That is a satisfying change from discussing architecture to seeing the system behave.

The biggest difference from other coding harnesses I have used is memory. A new session does not force me to restate every preference, architectural decision, and boundary. Hermes remembers that I prefer modular, swappable services, that I want existing repository conventions preserved, that I do not want unapproved cleanup, and that I want to review changes before anything is committed. That memory has helped the generated code stay closer to the way I would write it instead of slowly drifting toward a generic agent's preferred style.

The product itself is an omnichannel messaging system. Internal seat-to-seat Chat is the first proving ground, but it is not the final destination. The shared Conversation model is being designed to support SMS and email next, with provider-specific delivery records kept separate from canonical message history. I also hope to extend the system to social platforms as those integrations become practical. The goal is one conversation pipeline that can handle internal users and outside vendors without turning every channel into a separate product.

Hermes has been useful because it can hold the whole problem in view. We reconciled the new work with an existing Conversation model, kept the repository's numeric channel conventions, separated company seat membership from message history, seeded two real users into a development company, and then connected the data to the active Conversations page. When the first route and page assumptions were wrong, the work could be traced back through the server router, client service, build output, and database rather than patched blindly.

The memory also preserves the less glamorous decisions that matter later. I do not want a commit made before manual review. I want tests eventually, but not before the product behavior is understood well enough to test the right thing. I want Postman available while we develop, even if automation comes later. Those details are easy to lose in a long coding session. Keeping them available makes the collaboration feel more continuous and makes it easier to correct the agent when it starts heading in the wrong direction.

It is not hands-off development. Authentication and anti-bot behavior made API testing awkward. A router path once fell through to the SPA and returned HTML instead of JSON. A company-scoped request exposed a mismatch between the authenticated user's field name and the middleware's assumption. Those problems required logs, source inspection, database checks, and a willingness to say that a build passing was not the same as the feature working. Hermes helped investigate and repair them, but I still had to review the evidence and make the product decisions.

That is what I have enjoyed most. Hermes is not just generating isolated code snippets. It can carry context across architecture, implementation, debugging, and review while still leaving me in charge of the direction. The messaging system is not finished, and the SMS, email, and social adapters still have work ahead of them, but the foundation is becoming real. I am looking forward to seeing how far this collaboration can take it.
