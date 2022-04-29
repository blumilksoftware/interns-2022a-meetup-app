let mix = require('laravel-mix');

mix.browserSync('127.0.0.1');
mix.disableSuccessNotifications()
  .js('resources/js/app.js', 'resources/static/js')
  .setPublicPath('resources/static')
  .postCss('resources/css/app.css', 'resources/static/css', [
    require('tailwindcss'),
  ]);
