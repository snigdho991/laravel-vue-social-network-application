import Vuex from 'vuex'
import Vue from 'vue'

Vue.use(Vuex)


export const store = new Vuex.Store({
	state: {
		nots: [],
		posts: [],
		newposts: [],
		auth_user: {}
	},

	getters: {
		all_nots(state) {
			return state.nots.map(element => {
				return element
			});
		},

		all_posts(state) {
			return state.posts
		},

		new_posts(state) {
			return state.newposts
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
			//state.posts.splice(0, 0, post)
			state.posts.push(post)
		},

		add_new_posts(state, newpost) {
			//state.posts.splice(0, 0, post)
			state.newposts.push(newpost)
		},

		add_comments(state, payload) {
			var post = state.posts.find((p) => {
				return p.id === payload.post_id
			})

			post.comments.push(payload.comment)
		},

		auth_user_data(state, user) {
			state.auth_user = user
		},

		update_post_likes(state, payload) {
			var post = state.posts.find((p) => {
				return p.id === payload.id
			})

			post.likes.push(payload.like)
		},

		update_new_post_likes(state, payload) {
			var post = state.newposts.find((p) => {
				return p.id === payload.id
			})

			post.likes.push(payload.like)
		},

		unlike_post(state, payload) {
			var post = state.posts.find((p) => {
				return p.id === payload.post_id
			})

			var like = post.likes.find((l) => {
				return l.id === payload.like_id
			})

			var index = post.likes.indexOf(like)

			post.likes.splice(index, 1)
		},

		unlike_new_post(state, payload) {
			var post = state.newposts.find((p) => {
				return p.id === payload.post_id
			})

			var like = post.likes.find((l) => {
				return l.id === payload.like_id
			})

			var index = post.likes.indexOf(like)

			post.likes.splice(index, 1)
		}
	}
})