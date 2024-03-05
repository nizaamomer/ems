module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
    "./node_modules/flowbite/**/*.js"
  ],
  theme: {
    extend: {
      fontFamily: {
        kurdish : ['Vazirmatn']
      }
    },
  },
  plugins: [
      require('flowbite/plugin')
  ],
  darkMode: 'class',
}