# CodeMonkeyG.com

A lightweight, interactive landing page for **CodeMonkeyG.com**.

## Features

- **Random Monkey GIFs**: Dynamically serves one of four animated monkey GIFs on each page load. Clicking the monkey reloads the page to show another variant.
- **Konami Code Easter Egg**: Typing the Konami Code (`↑ ↑ ↓ ↓ ← → ← → B A`) triggers a full-screen confetti animation and plays an airhorn sound effect.

## Project Structure

```
CodeMonkeyG/
├── README.md           # Project documentation
├── index.php           # Page markup, CSS styling, and Easter Egg logic
├── images/
│   ├── confetti.gif    # Easter egg confetti animation
│   ├── monkey_1.gif    # Monkey GIF variant 1
│   ├── monkey_2.gif    # Monkey GIF variant 2
│   ├── monkey_3.gif    # Monkey GIF variant 3
│   └── monkey_4.gif    # Monkey GIF variant 4
└── sounds/
    └── noise.wav       # Airhorn audio clip
```

## Running Locally

You can serve this project using PHP's built-in development server:

```bash
php -S localhost:8000
```

Then navigate to `http://localhost:8000` in your browser.
