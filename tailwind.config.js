/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
  ],

  safelist: [
    // semua warna custom
    {
      pattern: /(bg|text|border|from|to|via|hover:bg)-\[#.*\]/,
    },

    // semua ukuran custom
    {
      pattern: /(w|h|left|right|top|bottom)-\[.*\]/,
    },

    // scale & transform
    {
      pattern: /(scale|rotate|translate|z)-.*/,
    },

    // utility umum yang sering hilang
    'opacity-70',
    'blur-3xl',
    'z-[10]',
    'drop-shadow-sm',
    'shadow-xl',
    'rounded-full',
    'line-clamp-1',
    'line-clamp-2',
  ],

  theme: {
    extend: {},
  },

  plugins: [],
}
content: [
  "./resources/**/*.{blade.php,js}",
  "./app/**/*.php",
]