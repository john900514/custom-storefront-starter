const defaultTheme = require("tailwindcss/defaultTheme");
const plugin = require("tailwindcss/plugin");

const twColors = require("tailwindcss/colors");
const svgToDataUri = require("mini-svg-data-uri");

//add default to colors so we don't always need -500 for base shade
Object.entries(twColors).forEach(
    ([name, color]) => (color.DEFAULT = color[500])
);

const colors = {
    ...twColors,
    transparent: "transparent",
    primary: {
        DEFAULT: "#416ba9",
        50: "#98C4F9",
        100: "#7BB4F7",
        200: "#4193F4",
        300: "#0E73EA",
        400: "#0A56B0",
        500: "#073A76",
        600: "#052C59",
        700: "#041E3C",
        800: "#152633",
        900: "#000102",
    },
    secondary: {
        DEFAULT: "#29dff4",
        50: "#D0E2F0",
        100: "#95D2FF",
        200: "#62BDFF",
        300: "#2FA8FF",
        400: "#0092FB",
        500: "#0074C8",
        600: "#00599A",
        700: "#003F6C",
        800: "#00243E",
        900: "#000A10",
    },
    accent: {
        DEFAULT: "#b99fe0",
        50: "#D3FF8C",
        100: "#CBFF77",
        200: "#BBFF4E",
        300: "#ACFF26",
        400: "#9BFC00",
        500: "#82D300",
        600: "#6CAF00",
        700: "#568C00",
        800: "#406800",
        900: "#2A4400",
    },
};

module.exports = {
    experimental: {
        applyComplexClasses: true,
    },
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./vendor/laravel/jetstream/**/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./resources/js/**/*.vue",
    ],
    safelist: [/data-theme$/],
    theme: {
        extend: {
            colors,
            fontFamily: {
                sans: ["Proxima Nova", ...defaultTheme.fontFamily.sans],
            },
            fontSize: {
                "2xs": ["0.6rem", { lineHeight: "0.75rem" }],
            },
            screens: {
                // English Breakpoints
                watch: "100px",
                nano: "324px",
                micro: "368px",
                mini: "500px",
                small: "640px",
                normal: "768px",
                medium: "864px",
                big: "1024px",
                large: "1176px",
                // Height Breakpoints
                tall: { raw: "(min-width: 600px) and (max-width: 767px)" },
                grande: { raw: "(min-width: 768px) and (max-width: 863px)" },
                average: { raw: "(min-width: 864px) and (max-width: 1023px)" },
                short: { raw: "(min-height: 350px)" },
                derpy: { raw: "(min-height: 200px)" },
                // "Standard" Breakpoints
                "2xs": "300px",
                xs: "400px",
                "2sm": "500px",
                sm: "640px",
                md: "768px",
                "2md": "864px",
                lg: "1024px",
                "2lg": "1176px ",
                xl: "1280px",
                "1440p": "1440px",
                "2xl": "1536px",
                "3xl": "1920px",
            },
            backgroundImage: (theme) => ({
                "multiselect-caret": `url("${svgToDataUri(
                    `<svg viewBox="0 0 320 512" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path d="M31.3 192h257.3c17.8 0 26.7 21.5 14.1 34.1L174.1 354.8c-7.8 7.8-20.5 7.8-28.3 0L17.2 226.1C4.6 213.5 13.5 192 31.3 192z"></path></svg>`
                )}")`,
                "multiselect-spinner": `url("${svgToDataUri(
                    `<svg viewBox="0 0 512 512" fill="${theme(
                        "colors.green.500"
                    )}" xmlns="http://www.w3.org/2000/svg"><path d="M456.433 371.72l-27.79-16.045c-7.192-4.152-10.052-13.136-6.487-20.636 25.82-54.328 23.566-118.602-6.768-171.03-30.265-52.529-84.802-86.621-144.76-91.424C262.35 71.922 256 64.953 256 56.649V24.56c0-9.31 7.916-16.609 17.204-15.96 81.795 5.717 156.412 51.902 197.611 123.408 41.301 71.385 43.99 159.096 8.042 232.792-4.082 8.369-14.361 11.575-22.424 6.92z"></path></svg>`
                )}")`,
                "multiselect-remove": `url("${svgToDataUri(
                    `<svg viewBox="0 0 320 512" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path d="M207.6 256l107.72-107.72c6.23-6.23 6.23-16.34 0-22.58l-25.03-25.03c-6.23-6.23-16.34-6.23-22.58 0L160 208.4 52.28 100.68c-6.23-6.23-16.34-6.23-22.58 0L4.68 125.7c-6.23 6.23-6.23 16.34 0 22.58L112.4 256 4.68 363.72c-6.23 6.23-6.23 16.34 0 22.58l25.03 25.03c6.23 6.23 16.34 6.23 22.58 0L160 303.6l107.72 107.72c6.23 6.23 16.34 6.23 22.58 0l25.03-25.03c6.23-6.23 6.23-16.34 0-22.58L207.6 256z"></path></svg>`
                )}")`,
            }),
        },
    },

    plugins: [
        require("daisyui"),
        plugin(({ addUtilities }) => {
            const newUtilities = {
                ".position-unset": {
                    position: "unset !important",
                },
            };
            addUtilities(newUtilities);
        }),
        function ({ addBase, theme }) {
            function extractColorVars(colorObj, colorGroup = "") {
                return Object.keys(colorObj).reduce((vars, colorKey) => {
                    const value = colorObj[colorKey];

                    const newVars =
                        typeof value === "string"
                            ? { [`--color${colorGroup}-${colorKey}`]: value }
                            : extractColorVars(value, `-${colorKey}`);

                    return { ...vars, ...newVars };
                }, {});
            }

            addBase({
                ":root": extractColorVars(theme("colors")),
            });
        },
    ],
    daisyui: {
        themes: [
            {
                shopify: {
                    primary: "#416ba9",
                    secondary: "#29dff4",
                    accent: "#b99fe0",
                    neutral: "#898c8e",
                    "base-100": "#707070",
                    info: "#f637fd",
                    success: "#ff00f5",
                    warning: "#eb5757",
                    error: "#152633",
                },
            },
        ],
    },
};
