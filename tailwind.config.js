module.exports = {
  content: [
    "./resources/**/*.blade.php",
  ],
  theme: {
    extend: {
      backgroundImage: {
        hero: "url('/resources/static/images/hero.png')",
      },
      borderRadius: {
        10: '0.625rem',
        20: '1.25rem',
      }
    },
  },
  plugins: [],
}
