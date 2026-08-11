<?php
$pageTitle = 'About | CodeMonkeyG';
$pageDescription = 'A short profile and background page for the CodeMonkeyG website.';
$activePage = 'about';

require __DIR__ . '/partials/header.php';
?>

<section class="page-header">
	<p class="eyebrow">About</p>
	<h1>A little more context.</h1>
	<p class="lede">This page is a placeholder for a proper bio. For now, it gives the site a more complete structure and leaves room for a real story, interests, or professional summary later.</p>
</section>

<section class="content-grid">
	<article class="card card-large">
		<h2>Background</h2>
		<p>Use this space to describe where the profile came from, what kind of work the person or brand does, and what makes the site worth visiting. A profile page works best when it feels direct and human.</p>
		<p>The current version keeps the writing intentionally light so it can be replaced without changing the layout. That makes it easy to update later without touching the design.</p>
	</article>
	<aside class="card">
		<h2>Quick facts</h2>
		<ul class="stack-list">
			<li>Independent profile site</li>
			<li>Built with HTML, CSS, and PHP</li>
			<li>Ready for real copy and links</li>
		</ul>
	</aside>
</section>

<?php require __DIR__ . '/partials/footer.php'; ?>