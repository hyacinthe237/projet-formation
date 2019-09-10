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

mix.js('resources/assets/js/app.js', 'public/assets/js')
.extract(['jquery', 'vue', 'lodash', 'moment', 'sweetalert2',
    'vuex', 'axios', 'moment-range', 'vee-validate', 'vue2-dropzone'
])
mix.sass('resources/assets/sass/app.scss', 'public/assets/css')
.mergeManifest();

if (mix.inProduction()) {
    mix.version();
}
