<?php
$pageTitle = 'Home | CodeMonkeyG';
$pageDescription = 'A simple profile website with a few pages, a little personality, and room to grow.';
$activePage = 'home';
$heroMonkey = rand(1, 4);
$ogImage = '/images/monkey_' . $heroMonkey . '.gif';

require __DIR__ . '/partials/header.php';
?>

<section class="hero">
	<div class="hero-copy">
		<p class="eyebrow">Profile website</p>
		<h1>Simple, clean, and ready for more content.</h1>
		<p class="lede">This site now has separate pages for Home, About, Work History, and Contact. It stays lightweight, uses plain HTML and CSS, and keeps the playful monkey identity from the original landing page.</p>
		<div class="hero-actions">
			<a class="button" href="/about.php">About</a>
			<a class="button button-secondary" href="/contact.php">Contact</a>
		</div>
	</div>
	<div class="hero-visual">
		<a class="monkey-card" href="/" title="Click to load another monkey">
			<img src="/images/monkey_<?php echo htmlspecialchars((string) $heroMonkey, ENT_QUOTES); ?>.gif" alt="Random monkey illustration" />
		</a>
		<p class="caption">Click the monkey to reshuffle the home page mascot.</p>
	</div>
</section>

<section class="section">
	<div class="section-heading">
		<p class="eyebrow">What’s inside</p>
		<h2>A few focused pages, each with room for real content later.</h2>
	</div>
	<div class="card-grid">
		<article class="card">
			<h3>About</h3>
			<p>Use this page for a short biography, background summary, or a more personal introduction.</p>
		</article>
		<article class="card">
			<h3>Work History</h3>
			<p>Add past roles, projects, achievements, or a timeline that shows how the work has evolved.</p>
		</article>
		<article class="card">
			<h3>Contact</h3>
			<p>Keep it simple with an email address, a couple of links, or a short contact form later on.</p>
		</article>
	</div>
</section>

<?php require __DIR__ . '/partials/footer.php'; ?>
