let mix = require('laravel-mix');
let eslint = require('eslint-webpack-plugin');

mix
    .js('resources/js/app.js', 'resources/static/js')
    .setPublicPath('resources/static')
    .postCss('resources/css/app.css', 'resources/static/css', [
        require('tailwindcss'),
    ]);

mix.browserSync('127.0.0.1');
mix.disableSuccessNotifications();

module.exports = {
    plugins: [new eslint(options)],
};
