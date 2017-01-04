var elixir = require('laravel-elixir');


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

elixir(function(mix) {
   mix
       .copy('node_modules/dragula/dist/dragula.min.js', 'public/js/dragula.min.js')
       .copy('node_modules/dragula/dist/dragula.min.css', 'public/css/dragula.min.css')
    ;

    mix.sass('app.scss', './public/css/app.css');
});