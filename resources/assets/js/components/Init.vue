<template>
</template>

<script>
	import axios from 'axios';

	export default {
		mounted() {
			this.get_auth_user_data()
		},

		methods: {
			get_auth_user_data() {
				axios.get('/get_auth_user_data')
					 .then((resp) => {
					 	this.$store.commit('auth_user_data', resp.data)
					})
			}
		}
	}
</script>