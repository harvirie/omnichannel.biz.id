/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    '../**/*.php',
    '../**/*.html',
  ],
  safelist: [
    // Colors used dynamically in PHP (get_theme_mod, esc_attr, etc.)
    { pattern: /bg-omni-(.+)/ },
    { pattern: /text-omni-(.+)/ },
    { pattern: /border-omni-(.+)/ },
    { pattern: /hover:bg-omni-(.+)/ },
    { pattern: /hover:text-omni-(.+)/ },
    { pattern: /hover:border-omni-(.+)/ },
    // Translate utilities used in JS/PHP dynamic classes
    { pattern: /translate-(.+)/ },
    { pattern: /-translate-(.+)/ },
    { pattern: /opacity-(.+)/ },
    { pattern: /pointer-events-(.+)/ },
    // Animation classes
    'animate-spin', 'animate-pulse', 'animate-bounce',
  ],
  theme: {
    extend: {
      fontFamily: {
        sans: ['Outfit', 'sans-serif'],
        serif: ['Playfair Display', 'serif'],
      },
      colors: {
        omni: {
          dark: '#1C2C1F',
          light: '#EBF4E3',
          accent: '#FDB854',
          secondary: '#7A9E7E',
          button: '#567558',
          'button-hover': '#415B45',
          'accent-hover': '#e89e3a',
          'text-muted': '#4F6854',
          border: '#d2e3c9',
          'dark-border': '#2C4131',
          'dark-hover': '#2A3E2F',
        }
      }
    }
  },
  plugins: [],
}
