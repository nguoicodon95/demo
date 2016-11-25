const elixir = require('laravel-elixir');

require('laravel-elixir-vue');

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
    mix.sass('app.scss')
    	// .styles(['style.css', 'animate.css', 'font-awesome.css', 'rangeSlider.css', 'rangeSlider.skinFlat.css', 'nivo-lightbox.css'])
    	/*.scripts('maps.js')
    	.scripts('makerwithlabel.js')
    	.scripts('jquery.grids.js')
        .scripts('jquery.mapit.js')
        .scripts('carosel.js')
        .scripts('single-room.js')
    	.scripts('jquery.barrating.js')
        .scripts(['main.js', 'slide.js', 'rangeSlider.js'])
    	.scripts('location.js')*/
       .webpack('auth.js')
       .webpack('app.js');
});
