const elixir = require('laravel-elixir');

    require('laravel-elixir-vue-2');

    /*
     |--------------------------------------------------------------------------
     | Elixir Asset Management
     |--------------------------------------------------------------------------
     |
     | Elixir provides a clean, fluent API for defining some basic Gulp tasks
     | for your Laravel application. By default, we are compiling the Sass
     | file for our application, as well as publishing vendor resources.
     |
     */

    elixir(mix => {
        mix.sass('admin.scss')
           .webpack('admin.js');  // we just need to require 'hchs-vue-charts' in this file or somewhere else
    });
