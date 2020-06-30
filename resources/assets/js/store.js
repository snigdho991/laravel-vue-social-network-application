import Vuex from 'vuex'
import Vue from 'vue'
import VModal from 'vue-js-modal'

Vue.use(Vuex)

Vue.use(VModal)


export const store = new Vuex.Store({
	state: {
		nots: [],
		posts: [],
		newposts: [],
		feedposts: [],
		newfeedposts:[],
		mutualfriends: [],
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

		all_feed_posts(state) {
			return state.feedposts
		},

		/*all_mutual(state) {
			return state.mutualfriends
		},*/

		new_posts(state) {
			return state.newposts
		},

		feed_new_posts(state) {
			return state.newfeedposts
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

		add_feed_posts(state, feedpost) {
			state.feedposts.push(feedpost)
		},

		add_mutual(state, mutual) {
			state.mutualfriends.push(mutual)
		},

		add_new_posts(state, newpost) {
			state.newposts.push(newpost)
		},

		add_new_feed_posts(state, feednewpost) {
			state.newfeedposts.push(feednewpost)
		},

		add_comments(state, payload) {
			var post = state.posts.find((p) => {
				return p.id === payload.post_id
			})

			post.comments.push(payload.comment)
		},

		add_new_comments(state, payload) {
			var post = state.newposts.find((p) => {
				return p.id === payload.post_id
			})

			post.comments.push(payload.comment)
		},

		add_feed_comments(state, payload) {
			var feedpost = state.feedposts.find((po) => {
				return po.id === payload.post_id
			})

			feedpost.comments.push(payload.comment)
		},

		add_new_feed_comments(state, payload) {
			var feedpost = state.newfeedposts.find((po) => {
				return po.id === payload.post_id
			})

			feedpost.comments.push(payload.comment)
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

		update_feed_post_likes(state, payload) {
			var post = state.feedposts.find((p) => {
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

		update_new_feed_post_likes(state, payload) {
			var post = state.newfeedposts.find((p) => {
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

		unlike_feed_post(state, payload) {
			var post = state.feedposts.find((p) => {
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
		},

		unlike_new_feed_post(state, payload) {
			var post = state.newfeedposts.find((p) => {
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