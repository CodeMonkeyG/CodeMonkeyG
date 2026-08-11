# CodeMonkeyG

A solo-led, multi-page profile website built with plain HTML, CSS, and PHP includes.

The site presents a clear, founder-driven narrative focused on practical technology solutions for small and medium local businesses.

## Pages

- Home: an intro and executive summary with core capabilities and platform coverage.
- About: founder background, approach, and quick facts.
- Work History: experience timeline, key wins, industries, and major platforms.
- Contact: approachable outreach flow, response expectations, and resume download.

## Features

- Shared layout: `partials/header.php` and `partials/footer.php` provide reusable structure and navigation.
- Single stylesheet: `assets/styles.css` drives all page styling and responsive behavior.
- Konami code easter egg: available site-wide, with confetti animation and sound.
- Resume download section: available on Contact via `/assets/CodeMonkeyG-Resume.pdf`.

## Project Structure

```
CodeMonkeyG/
├── assets/
│   └── styles.css      # Shared site styles
├── partials/
│   ├── header.php      # Shared document head and navigation
│   └── footer.php      # Shared footer, closing markup, and Konami script
├── about.php           # About page
├── contact.php         # Contact page
├── index.php           # Home page
├── work-history.php    # Work history page
├── images/
│   ├── monkey_1.gif
│   ├── monkey_2.gif
│   ├── monkey_3.gif
│   └── monkey_4.gif
└── sounds/
    └── noise.wav
```

## Running Locally

You can serve this project using PHP's built-in development server:

```bash
php -S localhost:8000
```

Then navigate to `http://localhost:8000` in your browser.

If you are using Docker, the existing compose setup still exposes the site through the nginx container.

## Notes

- The site copy is intentionally written in a single-speaker, founder-led voice.
- If the resume file is missing, add it at `assets/CodeMonkeyG-Resume.pdf` to enable the download button.
