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

mix.js('resources/js/app/app.js', 'public/js')
    .sass('resources/sass/app/app.scss', 'public/css')
// .js('resources/js/admin/sb-admin.js', 'public/js/admin')
// .js('resources/js/admin/app.js', 'public/js/admin')
// .sass('resources/sass/admin/sb-admin.scss', 'public/css/admin')
// .sass('resources/sass/admin/app.scss', 'public/css/admin');