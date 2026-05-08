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
          dark: '#0F172A',
          light: '#F8FAFC',
          accent: '#D4AF37',
          secondary: '#CBD5E1',
          button: '#1E3A8A',
          'button-hover': '#1E40AF',
          'accent-hover': '#B8972D',
          'text-muted': '#64748B',
          border: '#E2E8F0',
          'dark-border': '#1E293B',
          'dark-hover': '#1E293B',
        }
      }
    }
  },
  plugins: [],
}
