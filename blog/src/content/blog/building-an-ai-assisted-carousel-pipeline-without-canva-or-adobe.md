---
title: "Building an AI-Assisted Carousel Pipeline Without Canva or Adobe"
description: "A case study in turning marketing ideas into editable SVGs and Instagram images with Hermes Agent, Python, and Inkscape, without a proprietary design service."
pubDate: 2026-10-17
author: "Giovanni Alvarez"
tags: ["AI", "Agentic Systems", "Python", "Open Source", "Case Study"]
draft: false
---

## Executive summary

I wanted a repeatable way to create Instagram marketing carousels for Hercules Tech Solutions. I had campaign ideas, SVG templates, and JPG backgrounds. I wanted to keep control of those assets, improve the writing through review, and produce images without depending on Adobe, Canva, or a hosted design editor.

Working with Hermes Agent, we built a file-based pipeline: source notes became reviewable Markdown, Markdown became JSONL, and Python placed the approved text into SVG templates. Inkscape rendered the SVGs into PNGs. The finished batch contained 14 campaigns and 69 slides, with an editable SVG and a flattened PNG for each slide.

Getting there required more than connecting a model to a renderer. Early versions pulled from the wrong source directory, treated production labels as copy, shortened sentences badly, and produced slides that passed layout checks but did not read well together. A later template revision exposed another mistake: the renderer treated example bullet lines as a hard capacity limit.

Those failures helped define the architecture. AI handles editorial reasoning and task coordination. Python performs mechanical transformations. Templates define the visual design. People approve the message and decide what to publish.

The rendering path runs locally and does not call a language model or image-generation service. The editorial workflow is designed to be portable across models, although model quality and tool support still matter. Running the entire agent workflow with a local model would require configuration and validation; that was not established by this project.

## 1. The requirement was ownership, not another image generator

The images in this project are composed from existing artwork and text. We did not ask a diffusion model to invent a new picture for each slide.

That choice matters for business content. A supplied SVG can preserve the brand's typography, colors, text positions, shadows, background crop, and footer across an entire campaign. The writing can change without asking an image model to reproduce a logo or spell a headline correctly.

I also wanted files I could keep using outside the original workflow. The outputs needed to include editable masters, not just images exported from an account I might later stop paying for.

The working materials were ordinary files:

| Material | Purpose |
| --- | --- |
| Campaign notes | Source ideas, practical advice, and business context |
| SVG templates | Layout, typography, branding, and editable text layers |
| JPG backgrounds | Supplied visual assets |
| Compiled Markdown | Human-readable campaign copy for review |
| JSONL | Structured input to the renderer, one campaign per line |
| Generated SVGs | Editable slide masters |
| PNGs | Flattened images for posting |

The source notes lived in Obsidian, but the pipeline used their Markdown files. Obsidian was a convenient writing environment, not a required rendering service.

## 2. Separating writing from rendering

The final data flow was:

```text
Campaign idea or source note + supplied SVG/JPG assets
                         |
                         v
              AI-assisted editorial draft
                         |
                         v
             Human-reviewable Markdown
                         |
                  Review and revision
                         |
                         v
             Mechanical Python compiler
                         |
                         v
          JSONL: one campaign object per line
                         |
                         v
             Mechanical Python renderer
                         |
                Editable SVG masters
                         |
                         v
                  Inkscape export
                         |
                         v
                     PNG slides
                         |
                         v
         Technical checks + visual/editorial review
                         |
              Revise upstream if needed
```

Each boundary has a different responsibility. The SVG defines appearance. The Markdown defines what the audience reads. JSONL carries that content into the renderer. Python should not decide whether a sentence sounds persuasive.

A follow slide's Markdown uses three explicit fields:

```markdown
## Slide 03

### Title

Google may already list you

### Details

You may not control what locals see there.

### Bullet Points

- Photos may not show your storefront.
- The category may not fit your shop.
- Service areas may be missing or wrong.
- The listing may still appear in a search.
```

The corresponding JSONL record contains campaign metadata and an ordered `slides` array. Each slide has a number, title, details, and an array of bullet sentences. This gives the renderer a predictable input without asking it to interpret a loosely formatted brief.

It also makes changes traceable. If a sentence needs work, I can read and edit the Markdown rather than hunt through SVG markup or modify a finished image.

## 3. The early failures were useful specifications

The initial source selection was wrong. The agent read a broader Instagram folder instead of the direct campaign notes for Hercules Tech Solutions. That produced work outside the intended scope. Correcting the directory narrowed the set to 14 campaigns.

Other failures happened inside the content. Source notes mixed headings, design instructions, and actual audience copy. Labels such as "The Pitfalls" and "How to do it" sometimes became bullets. Long text was shortened into incomplete or awkward phrases.

The tempting response was to add more Python rules: detect a bad phrase, replace it, remove another label, shorten another sentence. I pushed back on that approach. The compiler was accumulating editorial decisions that belonged in the writing stage.

We moved those decisions upstream. The agent had to prepare finished, reviewable copy before conversion. The scripts could reject invalid structure or text that did not fit, but they were not supposed to repair weak writing.

This was our garbage-in, garbage-out rule in practical terms. A parser should not conceal a bad draft by substituting generic advice. If the input is wrong, fix the input.

## 4. Passing a layout check did not make the carousel good

One batch passed technical checks and visual layout review, yet the slides still felt disconnected. The titles, explanatory text, and bullets concerned similar subjects without consistently building one argument.

I had also asked for five bullets per follow slide. That made the output look consistent, but encouraged filler and checklist writing. We changed the editorial rule to two to five complete, concise bullets when the slide needed them.

We then revised one campaign before applying the style to the others. Campaign 1 compared fiber and cable internet through familiar situations: streaming shows, frozen video calls, upload speed, and Wi-Fi dead zones. Rather than declaring one service universally better, it helped a reader distinguish different problems and consider what their household needed.

The revised progression was:

1. Ask which plan fits the home.
2. Explain download and upload speed.
3. Connect upload speed to a video call that freezes.
4. Acknowledge when cable may already be sufficient.
5. Separate Wi-Fi coverage from the speed of the purchased plan.
6. Check availability at the actual address.
7. Invite a specific conversation about the reader's situation.

That pilot became the approved reference for the remaining campaigns. We delegated bounded groups of campaign rewrites, then checked the files and rebuilt the outputs. Delegation spread the work; it did not remove the need to reconcile the results.

The important improvement was editorial. Each slide had to carry one thought, and the next slide had to give the reader a reason to keep going.

## 5. The renderer preserved the design instead of inventing one

The Python renderer reads the structured content, chooses the title or follow template, inserts text, assigns the background, and calls Inkscape to export the PNG.

The templates included separate visible and shadow text elements. Replacing only the visible title would leave the old words in its shadow. The renderer therefore updates the paired elements together, using their exact IDs and preserving their styling and placement.

Unused bullet lines remain empty. XML-sensitive characters are escaped. The generated SVG retains editable text rather than flattening the entire slide into a bitmap.

In this project's templates, the scripts also used explicit line-length and wrapping limits. Those limits were implementation choices for this design, not universal rules for Instagram. A different font, text box, or canvas requires inspecting the new template and checking its actual render.

The scripts were kept directly on the Desktop for inspection and editing. They were small project tools, not a hosted application or a service that needed an account to produce each image.

## 6. A one-word wrap showed why the loop matters

Visual review found a heading in the Google Business Profile campaign that wrapped poorly:

```text
A listing can exist without
you
```

Every word was visible. The copy matched the structured data. The heading still looked unbalanced because "you" sat alone on the second line.

Under the review rules at that point, the agent reported the issue rather than silently changing the slide. I then authorized a revision through the full process.

We returned to the source context and compiled Markdown, changed the headline to "Google may already list you," regenerated JSONL, and rerendered all seven slides in that campaign. The revised headline fit on one line. We visually checked the campaign again.

We did not patch the PNG or change the generated SVG alone. Doing that would leave the underlying copy out of sync and allow the defect to return on the next run.

That small correction demonstrated why the intermediate files were worth keeping. The same workflow handled both initial production and a targeted editorial revision.

## 7. The template revision exposed an overly rigid assumption

Later, I changed text from point text to area text in the design editor to define its boundaries, then asked for Campaign 1 to be rendered again without changing its copy.

The title slide rendered, but the next slide failed. The exported follow template contained three example bullet spans. The renderer expected five and refused the mismatch.

The initial diagnosis treated those three lines as the template's capacity. That was too literal. They were examples, not a request to reduce the campaign's bullet count.

Inspection of the exported SVG showed positioned `<text>` and `<tspan>` elements. The relevant text did not expose `shape-inside` or `inline-size` boundaries. Whatever the editor displayed as area text, the file presented to this renderer still required handling explicit line positions.

We corrected the mechanical assumption. For this template, the renderer can clone additional bullet spans using the measured vertical spacing of the example lines, preserving their attributes and doing the same for the shadow layer. It rejects spacing it cannot safely derive rather than guessing.

A regression test covered two through five data bullets against the three-line example template. The tests passed, and the campaign rendered successfully. Subsequent checks compared output text with JSONL, checked main/shadow agreement, and inspected the PNGs.

This fix supports the template structure we inspected. It is not a claim that the renderer understands every SVG area-text implementation or automatically respects arbitrary text-box boundaries. Export formats still need inspection and testing.

## 8. Model portability comes from the interfaces

The workflow does not encode a particular model's private output format into the production files. Its working contracts are Markdown, JSON, SVG, and image files. The Python scripts do not call a model at all.

That makes the production pipeline largely independent of which model helps write the copy or coordinate the tools. A model capable of following the schema can prepare the same inputs; a person can also edit those inputs directly.

This does not make models interchangeable in practice. Writing quality, context handling, tool use, and image inspection can vary. During the work, image-analysis calls also failed with service errors. A failed visual check is a missing check, not a pass, even when the files render successfully.

A fully local version is a reasonable deployment option, with work still required:

- Configure the agent to use a suitable local model and tool interface.
- Provide local image inspection capability if automated visual review is required, or have a person inspect the PNGs.
- Check hardware capacity and validate the model against the actual writing and tool tasks.
- Adapt the project-specific paths, fonts, assets, and renderer assumptions to that installation.

We demonstrated local file processing and image rendering. We did not benchmark a fully local model deployment or establish equal results across all models. The portable interfaces make that deployment possible to pursue without replacing the entire content pipeline.

## 9. No required Adobe or Canva account

The image-production path uses Python, SVG files, JPG assets, fonts, and Inkscape. It does not require an Adobe subscription, a Canva workspace, a proprietary template API, or a cloud image-generation endpoint.

This is the independence I wanted. I can keep the source copy, change the code, move the files, use another SVG editor, and regenerate outputs locally. The editable master is a file I possess rather than an object available only inside a vendor's service.

That independence has limits worth stating. Fonts and background artwork still have licenses. Software still has maintainers. Hosted models remain external dependencies when I choose to use them. Publishing to Instagram still depends on Instagram.

The narrower, defensible claim is that creating these images does not require a proprietary design platform. That removes a specific dependency without pretending the whole workflow exists outside the software ecosystem.

## 10. Verification and the resulting artifacts

We used several checks because each catches different failures:

| Check | What it establishes | What it does not establish |
| --- | --- | --- |
| Markdown validation | Required fields, numbering, bullet counts, and configured fit limits | Whether the copy is engaging or accurate |
| JSONL parsing and count reconciliation | Structured data is readable and accounts for the expected campaigns and slides | Whether every claim is justified |
| SVG text and shadow comparison | Rendered text matches the intended content and paired layers | Whether the typography looks balanced |
| PNG dimensions and text bounds | Files have expected dimensions and text stays within checked margins | Whether contrast or wording works for a reader |
| Individual visual and editorial review | Visible layout defects and narrative problems can be identified | Guaranteed quality or marketing performance |

The completed campaign set contained 69 slides across 14 campaigns, producing 69 SVGs and 69 PNGs. We later deleted and regenerated the slide outputs from the retained inputs. For that final bulk rerender, I explicitly requested that visual inspection be skipped. The successful render and file counts established regeneration, not a fresh visual approval of every image.

We also distilled the procedure into a standalone Hermes skill. It describes asset inspection, campaign writing, the Markdown-to-JSONL boundary, mechanical rendering, verification, and source-level revision. It avoids assuming this machine's paths or a particular business's contact details so another agent can use it with a new set of assets and a different idea.

There are no measured conversion results in this case study. The carousels were written to generate leads, but producing them does not prove they generated engagement or customers. We also did not run a controlled cost or time comparison against a design subscription.

## Conclusion

This project began as a request for marketing images and became a practical exercise in separating judgment from execution.

The agent was useful for drafting, revising, coordinating batches, and working through tools. It also made mistakes that needed human correction. Python became more reliable as we removed editorial guesswork from it. The SVG templates gave the design a stable form, while Markdown and JSONL let us revise the message without rebuilding the artwork manually.

I now have campaign copy, editable masters, posting images, local rendering tools, and a documented process I can move to another agent. The workflow still needs editorial judgment and honest verification. It does not need a proprietary design service to turn approved words and supplied assets into images.

For a related case study on evidence handling and human oversight, see [An Agentic AI Investigation of Disputed Online Reviews](/blog/posts/an-agentic-ai-investigation-of-disputed-online-reviews).
