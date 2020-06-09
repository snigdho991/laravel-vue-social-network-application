
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

/*import Friend from './components/Friend'
import Notification from './components/Notification'
import Unreadnotification from './components/Unreadnotification'
*/

var friend = Vue.component('friend', require('./components/Friend.vue'))
var notification = Vue.component('notification', require('./components/Notification.vue'))
var post = Vue.component('post', require('./components/Post.vue'))
var feed = Vue.component('feed', require('./components/Feed.vue'))


/*var unreadnots = Vue.component('unreadnots', require('./components/Unreadnotification.vue'))
var limited = Vue.component('limited', require('./components/Limitedunnots.vue'))*/


import { store } from './store'

const app = new Vue({
	el: '#app',
	store,
	components: {
	    'friend': friend,
	    'notification': notification,
	    'post': post,
	    'feed': feed
	    /*'unreadnots': unreadnots,
	    'limited': limited*/
	}

});
