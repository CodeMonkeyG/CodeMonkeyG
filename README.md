# CodeMonkeyG

A simple single-page profile website styled with Tailwind CSS, utilizing local relative paths for scripts and stylesheets.

## Features

- **Single-Page Website**: Clean, responsive layout in `index.html`.
- **Local Tailwind CSS**: Styled with Tailwind CSS without external CDN dependencies (`assets/js/tailwind.js` and `assets/css/tailwind.min.css`).
- **Structured Content Archive**: Complete archive of all previous site copy preserved in markdown format under [`site-text/`](site-text/README.md).
- **Easter Egg**: Preserved Konami code (`↑ ↑ ↓ ↓ ← → ← → B A`) celebration.

## Project Structure

```
CodeMonkeyG/
├── index.html            # Main site landing page
├── assets/
│   ├── css/
│   │   ├── style.css
│   │   └── tailwind.min.css
│   └── js/
│       └── tailwind.js
├── site-text/            # Structured Markdown archive of previous site text
│   ├── README.md
│   ├── home.md
│   ├── about.md
│   ├── work-history.md
│   ├── contact.md
│   └── shared-elements.md
├── images/               # Media assets
└── sounds/               # Audio assets
```

## Running Locally

Serve using any local static file server:

```bash
# Python
python3 -m http.server 8000

# or Node / npx
npx serve .
```

Or via Docker Compose if running the existing Nginx container setup.
