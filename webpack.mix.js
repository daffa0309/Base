const mix = require('laravel-mix');
/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.options({
    fileLoaderDirs: {
        fonts: 'assets/fonts'
    },
    processCssUrls: false
})
    .copyDirectory('resources/js', 'public/assets/js')
    .copy('resources/js/vendors/sweetalert/*.js', 'public/vendor/sweetalert')
    .copyDirectory('resources/css', 'public/assets/css')
    .copyDirectory('resources/images', 'public/assets/images')
    .sass('resources/scss/app.scss', 'public/assets/css', {
        implementation: require('node-sass')
    })
