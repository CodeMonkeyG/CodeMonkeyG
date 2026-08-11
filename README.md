# CodeMonkeyG

A simple multi-page profile website built with plain HTML, CSS, and PHP includes.

## Pages

- Home: a short intro and a random monkey hero image.
- About: filler biography content and a quick facts panel.
- Work History: a simple placeholder timeline.
- Contact: placeholder contact details and social links.

## Project Structure

```
CodeMonkeyG/
├── assets/
│   └── styles.css      # Shared site styles
├── partials/
│   ├── header.php      # Shared document head and navigation
│   └── footer.php      # Shared footer and closing markup
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
