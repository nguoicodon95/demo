
/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

var Vue = require('vue');

var VueValidator = require('vue-validator');
var VueResource = require('vue-resource');

Vue.use(VueValidator);
Vue.use(VueResource);

Vue.component('rooms', {
	template: '#room-choose',

	props: [
		'link',
		'back'
	],

	data: function () {
		return {
			roomtype: ''
		}
	},
	
	computed: {
		success: function () {
			var roomtype = this.roomtype;
			
			if(roomtype == '') {
				return false;
			} else {
				return true;
			}
		}
	}
});

Vue.component('bedrooms', {
	template: '#bedroom-choose',

	props: [
		'link',
		'back',
		'count_bed',
		'count_guest',
	],

	data: function () {
		return {
		}
	},
	
	computed: {

		oneBed: function () {
			if( this.count_bed == 1 ) {
				return true;
			} else {
				return false;
			}
		},
		
		diasableMax: function () {
			if( this.count_bed >= 16 ) {
				return true;
			} else {
				return false;
			}
		},

		diasableMin: function () {
			if( this.count_bed <= 1 ) {
				return true;
			} else {
				return false;
			}
		},
		
		diasableGuestMax: function () {
			if( this.count_guest >= 16 ) {
				return true;
			} else {
				return false;
			}
		},

		diasableGuestMin: function () {
			if( this.count_guest <= 1 ) {
				return true;
			} else {
				return false;
			}
		}
	},

	methods: {
		updateBedIncrement: function (event) {
			this.count_bed = parseInt(this.count_bed) + 1;

			if(this.count_bed >= 16) {
				this.count_bed = 16;
			}
		},

		updateBedDecrement: function (event) {
			this.count_bed -= 1;

			if(this.count_bed <= 1) {
				this.count_bed = 1;
			}
		},

		updateGuestIncrement: function (event) {
			this.count_guest = parseInt(this.count_guest) + 1;

			if(this.count_guest >= 16) {
				this.count_guest = 16;
			}
		},

		updateGuestDecrement: function (event) {
			this.count_guest -= 1;

			if(this.count_guest <= 1) {
				this.count_guest = 1;
			}
		}
	}
});

Vue.component('bathrooms', {
	template: '#bathroom-choose',

	props: [
		'link',
		'back',
		'count_bathroom'
	],

	data: function () {
		return {
			// count_bathroom: 1,
		}
	},
	
	computed: {

		diasableMax: function () {
			if( this.count_bathroom >= 8 ) {
				return true;
			} else {
				return false;
			}
		},

		diasableMin: function () {
			if( this.count_bathroom <= 1 ) {
				return true;
			} else {
				return false;
			}
		},
	},

	methods: {
		updateBathroomIncrement: function (event) {
			this.count_bathroom = parseInt(this.count_bathroom) + 1;

			if(this.count_bathroom >= 16) {
				this.count_bathroom = 16;
			}
		},

		updateBathroomDecrement: function (event) {
			this.count_bathroom = parseInt(this.count_bathroom) - 1;
			
			if(this.count_bathroom <= 1) {
				this.count_bathroom = 1;
			}
		}
	}
});


Vue.component('locations', {

	template: '#location-find',
	props: ['link', 'back'],

	data: function () {
		return {
		}
	},
	
	computed: {
		
	}

});

Vue.component('amenities', {

	template: '#amenities-choose',
	props: ['link', 'back'],

	data: function () {
		return {
		}
	}

});


Vue.component('spaces', {

	template: '#spaces-choose',
	props: ['link', 'back'],

	data: function () {
		return {
		}
	}

});

Vue.component('slug', {
	template: '#property_tp',

	data: function () {
		return {
			name: ''
		}
	}

});

Vue.component('kind', {
	template: '#kind_tp',

	data: function () {
		return {
			name: ''
		}
	}

});

Vue.component('bed_type', {
	template: '#bed_type_tp',

	data: function () {
		return {
			name: ''
		}
	}

});

Vue.component('highlights', {
	template: '#highlights_tp',
	props: ['link', 'back'],
	
	data: function () {
		return {
		}
	}

});

Vue.component('description', {
	template: '#description_tp',
	props: ['link', 'back'],

	data: function () {
		return {
		}
	}

});

Vue.component('titles', {
	template: '#titles_tp',
	props: ['link', 'back'],

	data: function () {
		return {
		}
	}

});

Vue.component('photos', {
	template: '#photos_tp',
	props: ['back', 'image-src', 'post_link', 'room-id'],

	data: function () {
		return {
			formdata: new FormData(),
			list: [],
			error: ''
		}
	},

	created: function() {
		this.fetchPhotoList(this.roomId);
	},
	
	methods: {
		fetchPhotoList: function (room_id) {
			this.$http.get('/admin/become-a-host/api/photos/' + room_id).then(response => {
				this.list = response.data;
			});
		},

		previewThumbnail: function(event) {
			var input = event.target;
			if (input.files && input.files[0]) {
				this.formdata.append('image', input.files[0]);
				this.$http.post(this.post_link, this.formdata).then(response => {
	                this.fetchPhotoList(this.roomId);
	            }).catch( function (response) {
	            	this.error = response.data.error;
	            	Vue.set(this.$data, 'errors', response.data);
	            });
			}
		},

		updateCaption: function(id) {
            var caption_val = $('input#caption-'+id).val();
            this.formdata = { caption: caption_val }
			var data = this.formdata;
			this.$http.put('/admin/become-a-host/api/photos/' + id + '/' + this.roomId, data).then(response => {
				this.fetchPhotoList(this.roomId);
			}).catch( function (response) {
				this.error = response.data.error;
			});
		},

		deletePhoto: function(id) {
			var confirmBox = confirm('Bạn muốn xóa hình ảnh này');
			if(confirmBox) this.$http.delete('/admin/become-a-host/api/photos/' + id + '/' + this.roomId);
			this.fetchPhotoList(this.roomId);
		}
	}
});


Vue.component('question', {
	template: '#experience-question',

	props: [
		'link',
		'back'
	],

	data: function () {
		return {
			answer: ''
		}
	},
	
	computed: {
		success: function () {
			var answer = this.answer;
			
			if(answer == '') {
				return false;
			} else {
				return true;
			}
		}
	}
});

Vue.component('triplength', {
	template: '#trip-length',

	props: [
		'link',
		'back',
		'count_min',
		'count_max'
	],

	data: function () {
		return {
			error: ''
		}
	},

	computed: {
		/// Min
		diasableMaxofMin: function () {
			if( this.count_min >= 4000000000) {
				return true;
			} else {
				return false;
			}
		},
		diasableMin: function () {
			if( this.count_min < 1 ) {
				return true;
			} else {
				return false;
			}
		},
		/// Max
		diasableMax: function () {
			if( this.count_max >= 4000000000) {
				return true;
			} else {
				return false;
			}
		},
		diasableMinofMax: function () {
			if( this.count_max < 1 ) {
				return true;
			} else {
				return false;
			}
		},

		success: function () {
			if(this.count_max < this.count_min) {
				this.error = 'Hãy điều chỉnh số lượng phù hợp.';
				return false;
			}
			return true;
		}
	},

	methods: {
		updateMinNightIncrement: function (event) {
			this.count_min = parseInt(this.count_min) + 1;
			if(this.count_min >= 4000000000) {
				this.count_min = 4000000000;
			}
		},

		updateMinNightDecrement: function (event) {
			this.count_min = parseInt(this.count_min) - 1;
			if(this.count_min < 1) {
				this.count_min = 0;
			}
		},

		updateMaxNightIncrement: function (event) {
			this.count_max = parseInt(this.count_max) + 1;
			if(this.count_max >= 4000000000) {
				this.count_max = 4000000000;
			}
		},

		updateMaxNightDecrement: function (event) {
			this.count_max = parseInt(this.count_max) - 1;
			if(this.count_max < 1) {
				this.count_max = 0;
			}
		}
	}
	
});


Vue.component('availability', {
	template: '#availability_tp',

	props: [
		'link',
	],

	data: function () {
		return {
			booking_window: 0,
			advance_notice: 0,
		}
	},
	
	computed: {
		booking_window_label: function () {
			var booking_window = this.booking_window;
			if(booking_window == 0) {
				return true;
			} else {
				return false;
			}
		},
		advance_notice_label: function () {
			var advance_notice = this.advance_notice;
			if(advance_notice == 0) {
				return false;
			} else {
				return true;
			}
		}
	}
});

Vue.component('price', {

	template: '#price_tp',
	props: ['link', 'back', 'minPrice', 'maxPrice'],

	data: function () {
		return {
		}
	},
	
	computed: {
		success: function () {
			var minPrice = this.minPrice;
			var maxPrice = this.maxPrice;
			if( minPrice > maxPrice ) {
				return false
			} else {
				return true
			}
		}
	}

});

Vue.component('sales', {

	template: '#sales_tp',
	props: ['link', 'back', 'weeklyDiscount', 'monthlyDiscount'],

	data: function () {
		return {
		}
	},
	
	computed: {
	}

});


Vue.component('locations-around', {
	template: '#locations_around',
	props: ['room-id'],
	data: function () {
		return {
			form: new FormData(),
			list: [],
			error: ''
		}
	},
	created: function() {
		this.fetchLocationsList(this.roomId);
	},
	methods: {
		fetchLocationsList: function (room_id) {
			this.$http.get('/admin/become-a-host/api/locations-around/' + room_id).then(response => {
				this.list = response.data;
			});
		},
		createLocations: function(event) {
			this.form.append( 'location_name', $('input[name=location_name]').val());
			this.form.append( 'street', $('input[name=street]').val());
			this.form.append( 'street_number', $('input[name=street_number]').val());
			this.form.append( 'route', $('input[name=route]').val());
			this.form.append( 'locality', $('input[name=locality]').val());
			this.form.append( 'city', $('input[name=city]').val());
			this.form.append( 'state', $('input[name=state]').val());
			this.form.append( 'country', $('input[name=country]').val());
			this.form.append( 'latitude', $('input[name=latitude]').val());
			this.form.append( 'longitude', $('input[name=longitude]').val());
			this.form.append( 'zipcode', $('input[name=zipcode]').val());
			this.form.append( 'marker_icon', $('input[name=marker_icon]')[0].files[0]);
			var data = this.form;
			this.$http.post('/admin/become-a-host/locations-around/' + this.roomId, data).then(response => {
				this.fetchLocationsList(this.roomId);
				$('input').val('');
			}).catch( function (response) {
				this.error = response.data.error;
			});
		},
		deleteLocations: function(id) {
			var confirmBox = confirm('Bạn muốn xóa hình ảnh này');
			if(confirmBox) this.$http.delete('/admin/become-a-host/api/locations-around/' + id + '/' + this.roomId);
			this.fetchLocationsList(this.roomId);
		}
	}
});

Vue.component('checkin', {
	template: '#checkin_tp',
	props: ['selectTime', 'selectEndsTime'],
	data: function () {
		return {
		}
	},
	computed: {
	},
	methods: {
	}
});


Vue.component('locations-index', {
	template: '#locations_index',
	data: function () {
		return {
			name: ''
		}
	},
});


// Vue.component('interfaces', {
// 	template: '#interfaces',
// 	data: function () {
// 		return {
// 			list: [],
// 		}
// 	},
// 	created: function() {
// 		this.fetchLocationsList();
// 	},
// 	methods: {
// 		fetchLocationsList: function () {
// 			this.$http.post('/admin/settings/get-locations').then(response => {
// 				this.list = response.data;
// 			});
// 		},
// 	}
// });

Vue.filter('slugify', function(value) {
	var slug = "";
	slug = slug.replace(/^\s+|\s+$/g, '');
	var titleLower = value.toLowerCase();
	slug = titleLower.replace(/e|é|è|ẽ|ẻ|ẹ|ê|ế|ề|ễ|ể|ệ/gi, 'e');
	slug = slug.replace(/a|á|à|ã|ả|ạ|ă|ắ|ằ|ẵ|ẳ|ặ|â|ấ|ầ|ẫ|ẩ|ậ/gi, 'a');
	slug = slug.replace(/o|ó|ò|õ|ỏ|ọ|ô|ố|ồ|ỗ|ổ|ộ|ơ|ớ|ờ|ỡ|ở|ợ/gi, 'o');
	slug = slug.replace(/u|ú|ù|ũ|ủ|ụ|ư|ứ|ừ|ữ|ử|ự/gi, 'u');
	slug = slug.replace(/i|í|ĩ|ỉ|ì|ị/gi, 'i');
	slug = slug.replace(/y|ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
	slug = slug.replace(/đ/gi, 'd');
	slug = slug.replace(/\s*$/g, '');
	slug = slug.replace(/\s+/g, '-');
	slug = slug.replace(/[^a-z0-9 -]/g, '').replace(/\s+/g, '-').replace(/-+/g, '-');

	return slug;
});

const app = new Vue({
    el: 'body'
});
