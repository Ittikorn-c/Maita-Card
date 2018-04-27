let mix = require('laravel-mix');

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

mix.js('resources/assets/js/app.js', 'public/js')
    .js('resources/assets/js/register.js', 'public/js')
    .js('resources/assets/js/del.js', 'public/js')
    .sass('resources/assets/sass/maitahome.scss', 'public/css')
    .sass('resources/assets/sass/app.scss', 'public/css');

// owner/report



mix.js('resources/assets/js/owner/reports/exchanges/age.js', 'public/js/owner/reports/exchanges')
    .js('resources/assets/js/owner/reports/exchanges/gender.js', 'public/js/owner/reports/exchanges')
    .js('resources/assets/js/owner/reports/exchanges/promotion.js', 'public/js/owner/reports/exchanges')
    .js('resources/assets/js/owner/reports/pointReceive/age.js', 'public/js/owner/reports/pointReceive')
    .js('resources/assets/js/owner/reports/pointReceive/gender.js', 'public/js/owner/reports/pointReceive')
    .js('resources/assets/js/owner/reports/pointReceive/time.js', 'public/js/owner/reports/pointReceive')
    .js('resources/assets/js/owner/reports/pointAvailable/age.js', 'public/js/owner/reports/pointAvailable')
    .js('resources/assets/js/owner/reports/pointAvailable/gender.js', 'public/js/owner/reports/pointAvailable')
    .js('resources/assets/js/owner/reports/home.js', 'public/js/owner/reports')
    .sass('resources/assets/sass/report.scss', 'public/css');
