let mix = require('laravel-mix');

mix
    .js('resources/js/app.js', 'resources/static/js')
    .setPublicPath('resources/static')
    .postCss('resources/css/app.css', 'resources/static/css', [
        require('tailwindcss'),
    ]);

mix.browserSync('127.0.0.1');
mix.disableSuccessNotifications();

mix.webpackConfig({
    module: {
        rules: [
            {
                enforce: 'pre',
                exclude: /node_modules/,
                loader: 'eslint-loader',
                test: /\.(js)?$/
            },
        ]
    }
})
