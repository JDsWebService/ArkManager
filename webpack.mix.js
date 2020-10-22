const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.sass('resources/sass/fontawesome/fontawesome.scss', 'public/css')
    // App Layout
    .sass('resources/sass/app.scss', 'public/css')
    .js('resources/js/app.js', 'public/js')
    // User Layout
    .sass('resources/sass/user.scss', 'public/css')
    .js('resources/js/user.js', 'public/js')
    .version();

mix.browserSync({
    proxy: 'localhost:8000'
});
