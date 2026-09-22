---
title: "Why I Still Start With Monoliths"
description: "Why the monolith remains the fastest, most secure, and most pragmatic starting point for new software projects."
pubDate: 2026-09-22
author: "Giovanni Alvarez"
tags: ["Architecture", "Monolith", "Laravel", "DevOps"]
draft: false
---

Nowadays, everyone with access to AI can build an app. Which is basically everyone at this point. But what happens when your brilliant idea that you vibe coded in a couple of hours needs to get deployed? How will you handle real network traffic? How will you make sure things are secure? This is where an actual software engineer has to step in and take over.

When it's my turn to start a new project, sure, I prompt along with the rest but if it's more than just a couple of scripts, I always set the start point as a monolith. 

I understand that it is a controversial opinion in a world where everything is about micro services and moving as quickly as possible. However, I argue that if the goal is to build something useful as quickly as possible that the monolith will get you there first and much more securely than a mesh of microservices that each require its own management, deployment, and maintenance. 

## When Microservices Make Sense
Microservices still have a place. If you look around at what the big tech companies are doing you will see that if they haven't already moved to a microservices-based architecture, it is likely because they are still in the process of doing so or because they tried it, got burned by the complexity, and pulled back toward something more modular but still unified. Startups and big companies aren't optimizing for the same thing, and pretending they are is how people get into trouble.

## How The Monolith Wins
But just as Alphabet and Meta got their start, when the team is small (or even just one person) the monolith lets everyone work and test together with a much smaller iteration cycle. While the most time consuming part may be to make sure your local repository is up to date, you also don't have to worry about multiple repositories, multiple orchestrations with environments or containers. You don't even have to wait for someone else to fix a bug that is blocking you because everything is in the monolith and you can go fix the bug yourself. The monolith provides the grounding point that allows the team to explore and move quickly.

As an example, my current go-to is Laravel. One battle tested and hardened framework with the support of an entire community of software engineers and the backing from businesses that depend on it. One framework providing all the authentication, authorization, database modeling, API endpoints, front-end interface, testing harness, etc. It's all there when you take the monolith out of the box. This means a team from one to many can get to work on their idea right away and know that they are standing on the shoulders of giants. They can focus on building their best airplane instead of having to discover flight all over again.

As the project scales the monolith is deployed to a group of auto-scaling servers. Each server handles whole transactions and network requests. As more machines are added, the monolith is duplicated in its entirety so newly added machines can handle more network traffic without needing autoscaling configurations for various services within your application, leading to dev-ops complexity. That simplicity has limits, though. The trade-off is that you can't split the load the way a microservice mesh can: if a single hot endpoint starts eating resources, you still have to put the whole thing on bigger machines. That's fine until it isn't. And when it stops being fine, you'll know, because the pain will be concrete instead of hypothetical.

## What a Monolith Leaves on the Table
Of course, as with anything in software, there is a cost to every decision. In order to reap the benefits of building with a monolith you will be giving up some other things. One thing you will have to set aside for later is the hyper-optimization of various services within the app. When you deploy the monolith to a new server you deploy the whole thing. This means, for example, if the CRUD endpoints for "user_comments" are getting hammered and eating up system resources you can't deploy new machines just big enough for just the "user_comments". You have to deploy on machines big enough to support the whole monolith. Something else you may leave on the table is easily swapping small modules when a new framework or piece of tech is available. With a monolith, you have to commit. Lean in to what you have until you have something that generates enough financial or human resources on its own that you can decide later to update, upgrade, or carve up the monolith into its respective microservices.

The flip side of all that commitment is that the boundaries between pieces of your code get blurry over time. A change in one place can have effects somewhere else, and the person who wrote the original feature may not be around to know which wire you're about to cross. That's the part people often forget when they talk about monoliths being "easy". Easy to deploy, yes, but the mental model of the whole thing has to fit in one team's head, and that only works up to a point. When it stops working, you'll feel it as a slowdown in how fast you can move without breaking something. That slowdown is the real signal that it's time to think about carving things apart.

## Where Can You Deploy the Monolith
One of the advantages of the monolith is also deploy-ability. Because it is all one single asset to be deployed, you can choose. Do you want to run on the bare metal of the machine? No big deal since the machine doesn't have anything else to worry about, you can install all necessary dependencies, update the code on the machine and `sudo service start`. Feel like you would prefer to take advantage of containerization? That's just as easy, because the same run list applies to your containers and now you have a deploy-able package you can take to any server. No large orchestration required. A microservice might be a single container too, but with a monolith there's only one of them to worry about instead of a whole mesh.

## Who Cares?
Anybody getting started on a new project. If it's an internal project for your company that has any chance of being spun off into a standalone tool or product. Frankly, in my experience the monolith has served me well. I have been part of several successful start-ups using monoliths (including one I built the tech for from the ground up). If you are looking to get serious and you are looking to actually push for real growth, nothing beats the maintainability, stability, and flexibility of the monolith.


