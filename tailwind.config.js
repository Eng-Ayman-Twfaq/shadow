/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.{blade.php,js}",
    "./app/View/Components/**/*.{php,blade.php}",
    "./app/Livewire/**/*.{php,blade.php}",
  ],
  darkMode: 'class',
  theme: {
    extend: {
      spacing: {
        // إضافة قيم مسافات إضافية لدعم فئات الحجم
        '3.5': '0.875rem',
        '4.5': '1.125rem',
        '5.5': '1.375rem',
        '6.5': '1.625rem',
        '7.5': '1.875rem',
        '8.5': '2.125rem',
      },
      colors: {
        primary: {
          50: '#f0f9ff',
          100: '#e0f2fe',
          500: '#0ea5e9',
          600: '#0284c7',
          700: '#0369a1',
        }
      }
    },
  },
  plugins: [],
}