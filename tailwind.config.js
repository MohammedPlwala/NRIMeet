/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",

    "./Modules/Frontend/resources/**/*.blade.php",
    "./Modules/Frontend/resources/**/*.js",
    "./Modules/Frontend/resources/**/*.vue",
  ],
  theme: {
    extend: {},
  },
  plugins: [],
}
