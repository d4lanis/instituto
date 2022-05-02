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

mix.copy('resources/images','public/images')
   .copy('resources/font_awesome','public/font_awesome')
   .copy('resources/leaflet','public/leaflet')
   .copy('resources/MDB','public/MDB');