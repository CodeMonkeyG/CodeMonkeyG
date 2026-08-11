<?php
$pageTitle = 'Home | CodeMonkeyG';
$pageDescription = 'Technology solutions for local businesses with enterprise-level execution and practical delivery.';
$activePage = 'home';
$heroMonkey = rand(1, 4);
$ogImage = '/images/monkey_' . $heroMonkey . '.gif';

require __DIR__ . '/partials/header.php';
?>

<section class="hero">
	<div class="hero-copy">
		<p class="eyebrow">CodeMonkeyG</p>
		<h1>Technology that helps local businesses run better.</h1>
		<p class="lede">CodeMonkeyG brings enterprise-grade architecture, integration experience, and operational discipline to small and medium local businesses that need smarter systems without unnecessary complexity.</p>
		<div class="hero-actions">
			<a class="button" href="/about.php">About</a>
			<a class="button button-secondary" href="/work-history.php">Work History</a>
		</div>
	</div>
	<div class="hero-visual">
		<a class="monkey-card" href="/" title="Click to load another monkey">
			<img src="/images/monkey_<?php echo htmlspecialchars((string) $heroMonkey, ENT_QUOTES); ?>.gif" alt="Random monkey illustration" />
		</a>
		<p class="caption">Click the monkey to reshuffle the mascot. Konami code still works site-wide.</p>
	</div>
</section>

<section class="section">
	<div class="section-heading">
		<p class="eyebrow">Executive Summary</p>
		<h2>Built for practical outcomes, informed by enterprise and luxury-service standards.</h2>
	</div>
	<div class="card-grid">
		<article class="card">
			<h3>What CodeMonkeyG Delivers</h3>
			<p>Focused technical solutions for local operators: cleaner workflows, connected systems, better visibility, and dependable customer-facing experiences.</p>
		</article>
		<article class="card">
			<h3>Experience That Transfers</h3>
			<p>12+ years across SaaS engineering, integrations, and technical consulting with exposure to organizations such as Hilton, SAP, Formula 1, BBC, KLM, Turner, and Scripps.</p>
		</article>
		<article class="card">
			<h3>Execution Style</h3>
			<p>Independent, hands-on delivery with strong attention to detail, direct communication, and a bias toward scalable decisions that stay practical for real-world budgets.</p>
		</article>
	</div>
	<div class="industry-platform-grid">
		<article class="card">
			<h3>Core Capabilities</h3>
			<ul class="stack-list">
				<li>Systems integration and process automation</li>
				<li>Technical architecture and implementation planning</li>
				<li>API-driven development and vendor coordination</li>
				<li>Operational troubleshooting and production support</li>
			</ul>
		</article>
		<article class="card">
			<h3>Platform Coverage</h3>
			<ul class="stack-list">
				<li>Laravel, Docker, AWS, PostgreSQL</li>
				<li>REST APIs and OpenAPI documentation</li>
				<li>Identity standards including OAuth 2.0, SAML, and OIDC</li>
				<li>Hospitality and operations integrations including HTNG-based workflows</li>
			</ul>
		</article>
	</div>
</section>

<?php require __DIR__ . '/partials/footer.php'; ?>
