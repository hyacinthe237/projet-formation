let mix = require('laravel-mix');
require('laravel-mix-merge-manifest');

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

 mix.js('resources/assets/js/admin.js', 'public/backend/js')
 .scripts([
     'node_modules/charts.js/dist/Chart.js',
     'node_modules/hchs-vue-charts/dist/vue-charts.js',
     // 'node_modules/bootstrap-tokenfield/dist/bootstrap-tokenfield.js',
     // 'node_modules/bootstrap-datepicker/dist/js/bootstrap-datepicker.js',
     // 'node_modules/datatables.net/js/jquery.dataTables.js',
     // 'node_modules/datatables.net-bs/js/dataTables-bootstrap.js',
     // 'resources/assets/js/libs/select2.min.js'
 ], 'public/backend/js/scripts.js');
 //
 mix.sass('resources/assets/sass/admin.scss', 'public/backend/css')
 .mergeManifest()


 if (mix.inProduction()) {
     mix.version();
 }
