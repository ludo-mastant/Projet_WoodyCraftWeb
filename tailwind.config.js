import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
          colors: {
            wc: {
              primary: "#1e3b57",
              accent:  "#3aa3e3",
              sand1:   "#f7ede2",
              sand2:   "#e4d7c3",
              sand3:   "#c9b39b",
            }
          },
          boxShadow: {
            card: "0 20px 40px -20px rgba(0,0,0,.25)",
          },
          borderColor: {
            glass: "rgba(255,255,255,.3)"
          }
        }
      },
      plugins: [],
};
