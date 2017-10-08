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
   .sass('resources/assets/sass/app.scss', 'public/css');


mix.js(['resources/assets/admin/js/admin.js'], 'public/build/admin/js')
	.webpackConfig({
		resolve: {
			modules: [
				path.resolve(__dirname, 'vendor/brackets/admin-ui/resources/assets/js'),
				path.resolve(__dirname, 'vendor/brackets/admin-auth/resources/assets/js'),
				path.resolve(__dirname, 'vendor/brackets/admin-translations/resources/assets/js'),
				// Do not delete this comment, it's used for auto-generation :)
				'node_modules'
			],
		}
	})
	.sass('resources/assets/admin/scss/app.scss', 'public/build/admin/css')
	// There is an issue in Laravel Mix, that does not allow to have multiple extracts, that's why we don't use it yet
	// .extract([
	// 	'vue',
	// 	'jquery',
	// 	'vee-validate',
	// 	'axios',
	// 	'vue-notification',
	// 	'vue-quill-editor',
	// 	'vue-flatpickr-component',
	// 	'moment',
	// 	'lodash'
	// ])
;

mix.copy('vendor/brackets/admin-ui/resources/assets/img/craftable.png', 'public/images/craftable.png');

if (mix.inProduction()) {
    mix.version();
}