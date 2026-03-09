/** @type {import('tailwindcss').Config} */
export default {
  darkMode: "class", // Enables dark mode using a CSS class
  content: ["../*.php", "../**/*.php", "./src/**/*.{js,ts,jsx,tsx,html}"],
  theme: {
    extend: {
      colors: ({ colors }) => ({
        primary: colors.indigo,
        danger: colors.rose,
        warning: colors.yellow,
        success: colors.lime,
        info: colors.blue,
        gray: colors.zinc,
        gray: {
          950: "#191919", // Override gray-950 with #191919
          1000: "#474747",
          1050: "#909090",
        },
      }),
    },
  },
  plugins: [],
};
