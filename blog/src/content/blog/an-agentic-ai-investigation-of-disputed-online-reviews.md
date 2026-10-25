---
title: "An Agentic AI Investigation of Disputed Online Reviews"
description: "A real-world case study in tool orchestration, evidence management, computational analysis, and human oversight."
pubDate: 2026-10-15
author: "Giovanni Alvarez"
tags: ["AI", "Agentic Systems", "Architecture", "Python", "Case Study", "Engineering", "Integrations"]
draft: false
---

> **Publication note.** This case study has been deliberately de-identified. The business sector, location, names, dates, quotations, amounts, and case-specific URLs have been removed or generalized. Certain event descriptions have also been simplified to reduce the possibility of identifying individuals through searching. The workflow and technical methods are authentic to the project; the details retained are those necessary to explain the system rather than the parties.

## Executive summary

A local service business undergoing a management transition wanted to know whether several inherited negative online reviews might be fabricated, posted to the wrong location, or connected to competitors. The question looked like a straightforward web search. In practice, it required an investigation spanning conflicting narratives, multiple review platforms, public business information, platform moderation policies, unavailable primary sources, and missing private operational records.

We built a multi-agent research workflow rather than asking a language model to decide whether the reviews were fake. A coordinating agent developed a neutral investigation specification, delegated bounded work to specialist agents, evaluated their returns, and maintained an evidence trail. Browser and web-retrieval tools collected public information; Python performed reproducible text alignment; structured files linked claims to sources; and document-generation tools produced both a technical handoff and an owner-facing explanation.

The clearest result was a **greater-than-90% similarity in the wording of two reviews published on different platforms**. That showed substantial shared or derivative text, but did not prove a fabricated transaction, a common author, or a coordinated campaign. A narrow, conditional platform-policy question was identified. The other disputed experiences remained unverified without internal business records. No reviewers were contacted and no takedown requests were submitted.

The larger result was a repeatable approach to evidence-sensitive work: **AI accelerated the investigation without being delegated the authority to decide what had happened.**

## 1. Translating suspicion into testable questions

The initial business request was informal: could these negative reviews be fake? That framing carried an obvious risk of confirmation bias. The owner’s suspicion was a reason to investigate, not evidence supporting the conclusion.

We therefore separated three distinct questions:

1. **Text provenance:** Is the published narrative independently written, closely copied, or derived from another source?
2. **Underlying event:** Did a customer interaction occur, and are the factual allegations supported?
3. **Platform rules:** Does the review fall within a specific removable-content policy, regardless of whether the underlying event happened?

These are not interchangeable. A copied description can concern a real event. A genuine customer can make a factual mistake. A business can dispute a complaint without establishing a violation of a platform’s rules. The investigative specification required each case to state its evidence, its limitations, plausible alternatives, and its action threshold.

The final work products were defined at the outset: separate case assessments, a structured evidence register, a cross-platform comparison, a policy matrix, an action register, and an owner-facing report. Defining deliverables before delegating work made omissions and incomplete research more visible.

## 2. System architecture: coordinating agent and specialist workstreams

The project used a **coordinator-worker architecture**. The coordinating AI agent handled task planning, delegation, source reconciliation, interpretation, quality control, and final reporting. A first wave of specialist agents covered distinct review allegations, cross-platform history, and moderation/ownership context. Once more complete text became available, a second, narrower wave revisited the affected findings. Across the two waves, there were six specialist agent assignments; these were work assignments, not six independent confirmations.

The logical data flow was:

```
Human business question
        |
        v
Research specification and evidence standard
        |
        v
Coordinating AI agent
        |
        +--> Specialist: disputed service event ------+
        +--> Specialist: other disputed interaction --+--> Source/evidence register
        +--> Specialist: cross-platform text/history -+
        +--> Specialist: platform rules/context ------+
                                                      |
                          Human supplies fuller text  |
                                      |               v
                                      +--> Targeted second-pass agents
                                                      |
                                                      v
                                     Source reconciliation + Python analysis
                                                      |
                                                      v
                                Case findings + policy mapping + limitations
                                                      |
                                                      v
                                Owner report + technical evidence package
                                                      |
                                                      v
                                  Human authorization for any outside action
```

This was not a permanently deployed application with a unified database and custom APIs for every component. Coordination took place through structured agent instructions, browser results, files, and subsequent handoffs. That is still a meaningful agentic workflow: the system decomposed an objective, used external tools, examined the outputs, revised tasks, and assembled artifacts suitable for human decision-making.

A critical architectural distinction was that **agent agreement did not count as corroboration**. Several agents finding the same mirrored page still represented one underlying source. The coordinator was responsible for deduplicating evidence and evaluating provenance.

## 3. Integrating browser research and public sources

The first pass attempted to inspect the original online reviews on their publishing platforms. Those attempts encountered two types of access failure: a restricted map interface that omitted the relevant full reviews, and a review site that rejected page retrieval with an HTTP 403 response.

The access limitations changed what the system could claim. It had not obtained the complete platform originals, so it could not reliably establish edit history, exact publication metadata, account activity, or every word of the comments. Its first report should have made this limitation more prominent. When that weakness was challenged, the process explicitly acknowledged the missing originals rather than implying that an inaccessible expansion control had been used successfully.

The agents then searched lawful public alternatives: indexed search results, third-party review directories, public organizational information, general incident-record access routes, and official moderation-policy documentation. Searches used combinations of account information, business context, and distinctive concepts. They did not attempt to bypass access controls or access private accounts.

Each retrieved item was assigned an appropriate evidentiary role:

| Source category | What it could establish | What it could not establish alone |
| --- | --- | --- |
| Live platform capture | Displayed content and visible metadata at capture time | Truth of the event described |
| Human-supplied review extract | Exact content furnished to the investigation | Independent authenticity of the live page |
| Third-party mirror | Public circulation or listing association of text | Independent confirmation of the incident |
| Historical public comments | Context concerning prior operations | Personnel records or a particular transaction |
| Official platform policy | Relevant moderation rules and reporting process | Whether an individual review violates them |
| Authorized internal records, if supplied | Potentially stronger transaction or incident verification | Complete truth unless scope and completeness are evaluated |

A failed public-record search was recorded as a **non-result within the searched sources**, not as proof that no underlying event occurred. An unsuccessful court query, for example, could not establish that litigation never existed. A generic mechanical advisory could not diagnose an unidentified vehicle.

## 4. Human evidence changed the research trajectory

After the initial handoff, a human participant supplied fuller review text and business responses. The investigation preserved these extracts as supplied and labeled them accordingly. They expanded the available evidence, but were not silently promoted to authenticated live-platform originals.

This new material enabled a second wave of targeted research and a direct comparison of two previously incomplete narratives. One agent revisited the disputed operational incidents; another investigated the overlapping cross-platform reviews and historical context. The coordinator checked the claims made in those returns before merging them into the assessment.

A public directory was found carrying text corresponding to some supplied complaints. After normalization, the circulated wording matched the supplied material. This supported the presence of the narratives in a listing associated with the business; it did **not** independently verify the reported customer events.

Historical customer comments and secondary organizational records likewise helped explain why different management periods might matter. They did not supply a verified personnel roster or a definitive transfer date. These boundaries were retained in the report.

This is a concrete example of **human-in-the-loop correction**: the human supplied missing evidence, the AI re-ran scoped tasks, and the results were updated without concealing the prior limitations.

## 5. Python-based text comparison

The most substantive computational task was comparing two reviews on different platforms that appeared to describe the same experience. Their narratives were extremely similar, but the perspective of the speaker changed in places.

The analysis isolated the two review bodies, normalized casing and apostrophes, tokenized words, and aligned the sequences with Python’s standard-library `difflib.SequenceMatcher`, using `autojunk=False`. This avoided relying on a model’s impression that two texts “looked copied.”

A simplified version of the method is:

```
import re
from difflib import SequenceMatcher


def tokenize(text: str) -> list[str]:
    normalized = text.lower().replace("’", "'")
    return re.findall(r"[a-z0-9]+(?:'[a-z0-9]+)?", normalized)


a = tokenize(review_a)
b = tokenize(review_b)
comparison = SequenceMatcher(None, a, b, autojunk=False)

print(f"word-sequence similarity: {comparison.ratio():.1%}")
# Result in this investigation: over 90%
```

`SequenceMatcher.ratio()` is defined as twice the number of aligned matching sequence elements divided by the combined sequence lengths. It is sensitive to order, unlike a simple overlap of word sets. The working investigation also preserved matching blocks and manually checked changed pronouns, unusual phrasing, and narrative order.

**Interpretation was deliberately narrower than the number.** The greater-than-90% score measured wording similarity in the supplied transcriptions. It was not a probability of deception or common authorship. Both reviews might derive from one genuine incident, a shared draft, a repost, or another explanation. Neither the code nor the source material established which account posted first.

The computational step added reproducibility; the interpretive step protected against overclaiming.

## 6. Mapping findings to platform policy

The project included a separate research track for official review policies and reporting procedures. That prevented a common reasoning error: treating anything suspicious, inaccurate, or unfair as automatically removable.

The paired text raised a **qualified policy question** on the platform where the review appeared to discuss another person’s experience. But possible direct involvement by the reviewer meant that an automatic conclusion would have been premature. The recommendation was limited to considering a narrowly documented policy inquiry after obtaining authenticated full captures and reviewing the complete context.

The other disputed reviews did not have sufficient evidence to justify reporting them as fake. The business’s own repair, diagnostic, correspondence, and other operational records would be needed to test the underlying factual allegations more rigorously. The research specification included searches that could accommodate alternate customer names, other payers, older record systems, and different operators.

**No external action was automated.** No reviewer was contacted, no public accusation was made, and no platform complaint was filed. Preparing a possible report and deciding to submit it were explicitly different stages, separated by human authorization.

## 7. Evidence management, artifacts, and quality control

The process produced more than a chat response. It generated an agent-facing research specification, case-level handoffs, a machine-readable evidence register, an annotated cross-platform comparison, a policy/action matrix, draft owner reports, and packaged supporting files.

A structured evidence item connected an observation to a case identifier, source location, collection time, source type, supporting attachment, and limitation. This made it possible to distinguish between what agents found, what the human participant supplied, and what remained inferential.

Quality control included re-running the text comparison, checking preserved extracts, reviewing references and attachment paths, and testing archive readability. The supporting agent reported an evidence register with unique entries and verified links to the cases. During a later packaging handoff, a different visible CSV snapshot had a smaller record count. That discrepancy reinforces the need to **version and reconcile artifact inventories** rather than treating a count in a summary as automatically authoritative.

These checks establish internal consistency and traceability, not factual truth. A valid archive does not authenticate the reviews inside it; a precise similarity score does not resolve the customer transaction; and a citation confirms source attribution, not necessarily source accuracy.

The reporting stage also used AI to adapt one evidence base for different readers: technical handoff documents for investigators, a more formal decision report, and a direct, accessible explanation for the nontechnical business owner. The underlying conclusions remained the same even as the tone and structure changed.

## 8. What AI handled, and what remained with people

| AI- and tool-assisted | Human or authorized-record responsibility |
| --- | --- |
| Task decomposition and specialist-agent delegation | Define the objective and permitted investigation scope |
| Public searching, browsing, source discovery, and policy retrieval | Supply unavailable material and approve any private-record access |
| Text normalization, alignment, and reproducible comparison | Interpret authorship and real-world involvement |
| Evidence register, case files, and report generation | Review consequential statements and legal/privacy implications |
| Citation, attachment, and archive checks | Decide whether and when to pursue external platform action |

The separation was intentional. The value was not that the AI replaced an investigator or arbitrator. The value was that it performed much of the expensive organizational and analytical work while leaving sensitive access and consequential decisions with people.

## 9. What worked, what failed, and what changed

**What worked:** bounded delegation accelerated research; a neutral specification reduced confirmation bias; deterministic Python analysis made one important finding reproducible; and structured evidence artifacts enabled handoffs between agents, technical reviewers, and the business owner.

**What failed initially:** limitations in accessing the full primary-source reviews were not conspicuous enough in the initial presentation. That made the first report easier to overinterpret than it should have been. The subsequent user challenge revealed the problem.

**What changed:** fuller human-supplied extracts triggered a second agent wave. The research moved from a suspected textual relationship to a measured one, while maintaining the distinction between shared words and a genuine or fabricated experience.

**What remained unresolved:** direct authentication of the platform originals, complete reviewer histories, the underlying customer transactions, and some historical organizational details. These limitations were not repaired by adding more prose or more agents.

## 10. A reusable pattern for novel business workflows

The approach can generalize to vendor diligence, incident review, contract compliance, warranty disputes, customer escalations, procurement research, and other evidence-sensitive tasks.

A practical reusable design has six layers:

1. **Specification:** define claims, evidence standards, scope, output requirements, and prohibited actions.
2. **Orchestration:** decompose work into bounded specialist assignments and set rules for reconciling results.
3. **Retrieval:** use appropriate public or authorized data sources and preserve access failures.
4. **Processing:** normalize content, apply deterministic analysis when useful, and maintain provenance.
5. **Validation:** test alternative explanations, check artifacts, and map findings to decision thresholds.
6. **Delivery and authorization:** produce audience-specific reports and require human approval before consequential actions.

This is a more useful mental model than “adding AI” to a business process. It treats AI as part of an **operating workflow**, with explicit interfaces between probabilistic reasoning, deterministic tools, external information, and human accountability.

## Conclusion

A request to investigate online reviews became a small but substantial exercise in agentic system design. Multiple agents researched bounded problems; browser tools exposed real access constraints; public sources supplied partial corroboration; human-provided evidence corrected the initial analysis; Python quantified an important textual relationship; and structured artifacts carried the evidence into a decision report.

The investigation did not prove that the reviews were fabricated. It established a narrower technical finding, identified a limited policy question, and documented precisely what would be required to go further.

That is the central lesson: **effective AI integration is not about producing a confident answer to every question. It is about designing a workflow that can make useful progress, show its evidence, admit its limits, and stop before claiming authority it does not possess.**
