var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Less
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    mix.less('bootstrap.less');
    // mix.scriptsIn('resources/assets/js/', 'public/js/main.js');
    mix.scripts([
    	'jquery.js', 
    	'bootstrap.js',
    	'jquery.dataTables.js',
    	'dataTables.bootstrap.js',
    	'bootstrap-datetimepicker.js',
    	'select2.js',
    	],'public/js/allscripts.js');
});
