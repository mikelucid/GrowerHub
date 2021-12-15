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
mix.webpackConfig({
	devtool: 'source-map'
});
mix.sourceMaps()
mix.js('resources/assets/js/app.js', 'public/js')
   .vue({ version: 2 })
   //.sourceMaps()
   .sass('resources/assets/sass/app.scss', 'public/css').options({
		resourceRoot: 'rootbound.test/'
	});
