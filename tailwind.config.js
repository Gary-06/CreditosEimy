/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./public/*/.{html,js,php}"], // Corregido doble barra para asterisco
  theme: {
    extend: {
      fontFamily: {
        'source-code': ['"Source Code Pro"', 'monospace']
      },
      colors: {
        'custom-teal': {
          50: '#E6FFFA',
          100: '#B2F5EA',
          200: '#81E6D9',
          300: '#4FD1C5',
          400: '#38B2AC',
          500: '#319795',
          600: '#2C7A7B',
          700: '#285E61',
          800: '#234E52',
          900: '#1D4044',
        },
        'custom-gray': {
          50: '#F7FAFC',
          100: '#EDF2F7',
          200: '#E2E8F0',
          300: '#CBD5E0',
          400: '#A0AEC0',
          500: '#718096',
          600: '#4A5568',
          700: '#2D3748',
          800: '#1A202C',
          900: '#171923',
        },
      },
    },
  },
  plugins: [
    require('@tailwindcss/typography'),
    require('@tailwindcss/forms'),
  ],
};