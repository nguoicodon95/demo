
/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */


var Vue = require('vue');

var VueValidator = require('vue-validator')

Vue.use(VueValidator);


Vue.component('login', {

	template: '#login-form',
	props: [],

	data: function () {
		return {}
	},
    methods: {}
});

const app = new Vue({
    el: 'body'
});
