module.exports = {
  content: [
    "./resources/**/*.blade.php",
  ],
  theme: {
    extend: {
      borderRadius: {
        10: '0.625rem',
        20: '1.25rem',
      },
      dropShadow: {
        filter: '0px 4px 4px rgba(0, 0, 0, 0.25)',
      },
    },
  },
  plugins: [require('@tailwindcss/forms')],
}
