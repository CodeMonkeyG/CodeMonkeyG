<?php
$pageTitle = 'Contact | CodeMonkeyG';
$pageDescription = 'Contact details and simple placeholders for getting in touch.';
$activePage = 'contact';

require __DIR__ . '/partials/header.php';
?>

<section class="page-header">
	<p class="eyebrow">Contact</p>
	<h1>Make it easy to say hello.</h1>
	<p class="lede">This page can stay simple until real contact details are ready. Use it for email, social links, or a short form once the rest of the profile copy is finalized.</p>
</section>

<section class="contact-grid">
	<article class="card">
		<h2>Email</h2>
		<p><a href="mailto:hello@example.com">hello@example.com</a></p>
		<p>Replace this with the preferred public email address when you are ready.</p>
	</article>
	<article class="card">
		<h2>Social</h2>
		<ul class="stack-list">
			<li><a href="https://www.linkedin.com/">LinkedIn</a></li>
			<li><a href="https://github.com/">GitHub</a></li>
			<li><a href="https://www.instagram.com/">Instagram</a></li>
		</ul>
	</article>
	<article class="card">
		<h2>Availability</h2>
		<p>Open to new conversations, updates, and future opportunities.</p>
		<p>A short response window and a clear call to action keep this page useful even before the final copy is written.</p>
	</article>
</section>

<?php require __DIR__ . '/partials/footer.php'; ?>