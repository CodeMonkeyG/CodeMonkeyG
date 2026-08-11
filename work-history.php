<?php
$pageTitle = 'Work History | CodeMonkeyG';
$pageDescription = 'A focused timeline of technical leadership, enterprise integrations, and client-facing solutions work.';
$activePage = 'work-history';

require __DIR__ . '/partials/header.php';
?>

<section class="page-header">
	<p class="eyebrow">Work History</p>
	<h1>12+ years building high-impact technical solutions.</h1>
	<p class="lede">From Fortune 500 integrations to Bay Area startup execution, my work history reflects a hands-on path through architecture, operations, pre-sales engineering, and customer-facing product delivery.</p>
</section>

<section class="section key-wins">
	<div class="section-heading">
		<p class="eyebrow">Key Wins</p>
		<h2>Metrics, industries, and platforms delivered in production.</h2>
	</div>
	<div class="key-wins-grid">
		<article class="card key-win-card">
			<p class="metric">35+</p>
			<h3>Legacy systems consolidated</h3>
			<p>Replaced fragmented operational tools with one unified platform for hospitality operations and guest engagement.</p>
		</article>
		<article class="card key-win-card">
			<p class="metric">&lt;500ms</p>
			<h3>API latency target at scale</h3>
			<p>Maintained high-concurrency AWS and PostgreSQL workloads serving millions of daily REST and IoT requests.</p>
		</article>
		<article class="card key-win-card">
			<p class="metric">12+ years</p>
			<h3>Hands-on delivery</h3>
			<p>Delivery experience spans architecture, integration engineering, technical sales support, platform operations, and incident response.</p>
		</article>
	</div>
	<div class="industry-platform-grid">
		<article class="card">
			<h3>Industries</h3>
			<ul class="stack-list">
				<li>Luxury hospitality and hotels</li>
				<li>Identity and access management</li>
				<li>Media, publishing, and travel</li>
				<li>Retail and logistics operations</li>
			</ul>
		</article>
		<article class="card">
			<h3>Major Platforms and Standards</h3>
			<ul class="stack-list">
				<li>Laravel, AWS, Docker, PostgreSQL</li>
				<li>REST and OpenAPI ecosystems</li>
				<li>OAuth 2.0, SAML, OIDC, SSO</li>
				<li>Infor HMS (HTNG), Opera, FOSSE</li>
			</ul>
		</article>
	</div>
</section>

<section class="timeline">
	<article class="timeline-item card">
		<p class="timeline-date">2016 - 2026</p>
		<h2>Founding Engineer and Tech Lead, KYC Hospitality</h2>
		<p>Served as founding engineer and primary technical partner to executive leadership, helping scale the platform into a brand standard for luxury hospitality groups while staying deeply involved in day-to-day product delivery.</p>
		<ul class="stack-list">
			<li>Built real-time, bi-directional PMS integrations including Infor HMS using HTNG standards, Oracle Opera (FIAS/OXI), and FOSSE.</li>
			<li>Designed and shipped multichannel guest messaging across SMS, WhatsApp, Instagram, Facebook, and web channels, including smart routing and two-way translation.</li>
			<li>Architected and maintained a unified operations platform that replaced 35+ fragmented systems across complaints, requests, reservations, housekeeping, engineering, concierge, inventory, surveys, and reporting.</li>
			<li>Delivered mobile and offline-first workflows for room attendants and engineering teams, reducing desk-bound administrative work from hours to minutes.</li>
			<li>Supported enterprise sales cycles with live demos and technical consulting, contributing to wins tied to brands such as Hilton, Starwood, Taj, Marriott, Intercontinental, and Hyatt.</li>
			<li>Owned infrastructure and reliability efforts across AWS environments, release pipelines, backups, and production support while maintaining aggressive response standards during critical incidents.</li>
		</ul>
	</article>
	<article class="timeline-item card">
		<p class="timeline-date">2017 - 2018</p>
		<h2>Tier 2 Client Services Engineer, SAP</h2>
		<p>Joined post-acquisition support engineering for high-value Gigya accounts, bridging customer-facing consulting with deep technical debugging.</p>
		<ul class="stack-list">
			<li>Advised enterprise clients on CIAM integrations, data architecture, and security implementation strategy.</li>
			<li>Inspected client codebases across multiple stacks to isolate and resolve production integration bottlenecks quickly.</li>
			<li>Built and maintained demo applications across Android, iOS, JavaScript, and PHP for global sales enablement.</li>
		</ul>
	</article>
	<article class="timeline-item card">
		<p class="timeline-date">2014 - 2017</p>
		<h2>Professional Services Engineer, Gigya</h2>
		<p>Led integration architecture and technical account strategy for major media, travel, and publishing organizations.</p>
		<ul class="stack-list">
			<li>Owned technical relationships and delivery strategy for global accounts including Formula 1, BBC, Forbes, The Guardian, KLM, Turner, and Scripps.</li>
			<li>Guided engineering teams on OAuth 2.0, SAML, OIDC, SSO, privacy controls, and customer profile data design.</li>
			<li>Developed SDK extensions and integration references to accelerate enterprise onboarding and reduce implementation risk.</li>
		</ul>
	</article>
	<article class="timeline-item card">
		<p class="timeline-date">2012 - 2014</p>
		<h2>Senior Software Engineer, AVRS and StopTheHacker</h2>
		<p>Delivered product modernization, stability improvements, and customer-facing enhancements during high-change growth periods.</p>
		<ul class="stack-list">
			<li>Helped migrate legacy processing systems into a modern SPA approach for California DMV-related workflows.</li>
			<li>Implemented automated testing and stronger release practices to reduce regressions during rapid delivery cycles.</li>
			<li>Redesigned key dashboard workflows, expanded localization foundations, and integrated operational alerting tools.</li>
		</ul>
	</article>
	<article class="timeline-item card">
		<p class="timeline-date">2007 - 2011</p>
		<h2>Co-Founder and Lead Developer, Dynamic Duo Designs / CodeMonkeyG</h2>
		<p>Built and delivered custom web applications, ecommerce experiences, and digital solutions for 100+ clients while developing the technical and client-service model that still guides work today.</p>
	</article>
</section>

<?php require __DIR__ . '/partials/footer.php'; ?>