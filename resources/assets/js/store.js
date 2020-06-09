import Vuex from 'vuex'
import Vue from 'vue'

Vue.use(Vuex)


export const store = new Vuex.Store({
	state: {
		nots: [],
		posts: []
	},

	getters: {
		json_nots(state) {
			return state.nots
		},

		all_nots(state) {
			return state.nots.map(element => {
				return element
			});
		},

		all_posts(state) {
			return state.posts
		},

		all_nots_count(state) {
			return state.nots.length
		}
	},

	mutations: {
		add_nots(state, not) {
			state.nots.push(not)
		},

		add_posts(state, post) {
			state.posts.push(post)
		}
	}
})