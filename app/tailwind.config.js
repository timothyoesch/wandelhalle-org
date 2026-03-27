import colors from 'tailwindcss/colors'

export default {
    theme: {
        fontFamily: {
            sans: ['Inter', 'sans-serif']
        },
        extend: {
            colors: {
                primary: {
                    '50': '#eff9ff',
                    '100': '#dff3ff',
                    '200': '#b8e8ff',
                    '300': '#78d5ff',
                    '400': '#31c2ff',
                    '500': '#06abf1',
                    '600': '#008bce',
                    '700': '#006ea7',
                    '800': '#025c8a',
                    '900': '#084c72',
                    DEFAULT: '#052b43',
                },
                accent: {
                    '50': '#f2fbf9',
                    '100': '#d3f4ec',
                    '200': '#a7e8da',
                    '300': '#74d4c2',
                    '400': '#47baa8',
                    DEFAULT: '#2fa494',
                    '600': '#227f74',
                    '700': '#1f665f',
                    '800': '#1d524d',
                    '900': '#1c4541',
                    '950': '#0b2827',
                }
            }
        }
    }
}
