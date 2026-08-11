<?php
$pageTitle = 'Work History | CodeMonkeyG';
$pageDescription = 'A simple work history page with placeholder experience entries.';
$activePage = 'work-history';

require __DIR__ . '/partials/header.php';
?>

<section class="page-header">
	<p class="eyebrow">Work History</p>
	<h1>Experience, presented as a simple timeline.</h1>
	<p class="lede">This page is intentionally lightweight. It shows how the structure can support past roles, freelance projects, or milestones without needing any CMS features.</p>
</section>

<section class="timeline">
	<article class="timeline-item card">
		<p class="timeline-date">2025 - Present</p>
		<h2>Independent Web Projects</h2>
		<p>Placeholder entry for ongoing work, personal experiments, and small builds that help shape the portfolio.</p>
	</article>
	<article class="timeline-item card">
		<p class="timeline-date">2023 - 2025</p>
		<h2>Digital Studio Support</h2>
		<p>Placeholder entry for collaborative production work, website updates, content changes, and day-to-day problem solving.</p>
	</article>
	<article class="timeline-item card">
		<p class="timeline-date">Earlier</p>
		<h2>Foundational Experience</h2>
		<p>Placeholder entry for early roles, internships, or the first round of hands-on web and design experience.</p>
	</article>
</section>

<?php require __DIR__ . '/partials/footer.php'; ?>