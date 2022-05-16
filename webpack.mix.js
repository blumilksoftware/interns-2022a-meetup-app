let mix = require('laravel-mix');

mix
    .js('resources/js/app.js', 'resources/static/js')
    .version()
    .setPublicPath('resources/static')
    .postCss('resources/css/app.css', 'resources/static/css', [
        require('tailwindcss'),
    ]);