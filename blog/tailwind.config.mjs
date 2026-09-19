import typography from '@tailwindcss/typography';

/** @type {import('tailwindcss').Config} */
export default {
  content: ['./src/**/*.{astro,html,js,jsx,md,mdx,svelte,ts,tsx,vue}'],
  darkMode: 'class',
  theme: {
    extend: {
      colors: {
        primary: '#0099ff',
        secondary: '#ff9900',
        darkgrey: '#181818',
        card: '#202022',
      },
      typography: {
        DEFAULT: {
          css: {
            color: '#d4d4d4',
            a: {
              color: '#0099ff',
              textDecoration: 'underline',
              '&:hover': {
                color: '#ff9900',
              },
            },
            h1: {
              color: '#ffffff',
              fontWeight: '800',
            },
            h2: {
              color: '#ffffff',
              fontWeight: '700',
            },
            h3: {
              color: '#ffffff',
              fontWeight: '600',
            },
            h4: {
              color: '#ffffff',
              fontWeight: '600',
            },
            code: {
              color: '#ff9900',
              backgroundColor: '#181818',
              paddingLeft: '0.375rem',
              paddingRight: '0.375rem',
              paddingTop: '0.125rem',
              paddingBottom: '0.125rem',
              borderRadius: '0.375rem',
              border: '1px solid rgba(255, 255, 255, 0.1)',
              fontWeight: '400',
            },
            'code::before': {
              content: '""',
            },
            'code::after': {
              content: '""',
            },
            blockquote: {
              borderLeftColor: '#ff9900',
              backgroundColor: 'rgba(24, 24, 24, 0.6)',
              padding: '0.75rem 1rem',
              borderRadius: '0 0.5rem 0.5rem 0',
              color: '#a3a3a3',
              fontStyle: 'italic',
            },
            hr: {
              borderColor: '#262626',
            },
            strong: {
              color: '#ffffff',
            },
            thead: {
              borderBottomColor: '#404040',
            },
            'thead th': {
              color: '#ffffff',
            },
            'tbody tr': {
              borderBottomColor: '#262626',
            },
          },
        },
      },
    },
  },
  plugins: [typography],
};
