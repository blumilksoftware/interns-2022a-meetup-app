let mix = require('laravel-mix');

mix
    .js('resources/js/app.js', 'resources/static/js')
    .setPublicPath('resources/static');

mix.browserSync('127.0.0.1');
mix.disableSuccessNotifications();
