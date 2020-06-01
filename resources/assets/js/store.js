import Vuex from 'vuex'
import Vue from 'vue'

Vue.use(Vuex)


export const store = new Vuex.Store({
	state: {
		nots: []
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

		all_nots_count(state) {
			return state.nots.length
		}
	},

	mutations: {
		add_nots(state, not) {
			state.nots.push(not)
		}
	}
})