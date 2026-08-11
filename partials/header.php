<?php
$pageTitle = $pageTitle ?? 'CodeMonkeyG';
$pageDescription = $pageDescription ?? 'A simple profile website built with HTML and CSS.';
$activePage = $activePage ?? 'home';
$ogImage = $ogImage ?? '/images/monkey_3.gif';

$navItems = [
	'home' => ['label' => 'Home', 'href' => '/'],
	'about' => ['label' => 'About', 'href' => '/about.php'],
	'work-history' => ['label' => 'Work History', 'href' => '/work-history.php'],
	'contact' => ['label' => 'Contact', 'href' => '/contact.php'],
];
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php echo htmlspecialchars($pageTitle, ENT_QUOTES); ?></title>
	<meta name="description" content="<?php echo htmlspecialchars($pageDescription, ENT_QUOTES); ?>">
	<meta name="author" content="Giovanni Lee">
	<meta name="keywords" content="profile, website, html, css, php">
	<meta property="og:title" content="<?php echo htmlspecialchars($pageTitle, ENT_QUOTES); ?>">
	<meta property="og:description" content="<?php echo htmlspecialchars($pageDescription, ENT_QUOTES); ?>">
	<meta property="og:image" content="<?php echo htmlspecialchars($ogImage, ENT_QUOTES); ?>">
	<meta property="og:url" content="http://codemonkeyg.com">
	<meta name="twitter:title" content="<?php echo htmlspecialchars($pageTitle, ENT_QUOTES); ?>">
	<meta name="twitter:description" content="<?php echo htmlspecialchars($pageDescription, ENT_QUOTES); ?>">
	<meta name="twitter:image" content="<?php echo htmlspecialchars($ogImage, ENT_QUOTES); ?>">
	<link rel="stylesheet" href="/assets/styles.css">
</head>
<body class="site-body page-<?php echo htmlspecialchars($activePage, ENT_QUOTES); ?>">
	<div class="page-shell">
		<header class="site-header">
			<a class="brand" href="/">CodeMonkeyG</a>
			<nav class="site-nav" aria-label="Primary navigation">
				<?php foreach ($navItems as $key => $item) : ?>
					<a class="<?php echo $activePage === $key ? 'is-active' : ''; ?>" href="<?php echo htmlspecialchars($item['href'], ENT_QUOTES); ?>"<?php echo $activePage === $key ? ' aria-current="page"' : ''; ?>><?php echo htmlspecialchars($item['label'], ENT_QUOTES); ?></a>
				<?php endforeach; ?>
			</nav>
		</header>
		<main class="site-main">