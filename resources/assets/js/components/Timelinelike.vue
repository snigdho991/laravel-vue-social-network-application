<template>
	<div>
		<div v-if="newpost">
			<button class="btn btn-info btn-xs" v-if="!auth_user_likes_new_post" @click="like_new()"><i class="fa fa-thumbs-up"></i> Like <span class="badge" style="margin-top: -3px;">{{ newpost.likes.length }}</span></button> 

			<button class="btn btn-danger btn-xs" v-else @click="unlike_new()"><i class="fa fa-thumbs-down"></i> Unike <span class="badge" style="margin-top: -3px;">{{ newpost.likes.length }}</span></button> 

	        <div v-for="like in newpost.likes"> <!-- v-b-tooltip.hover -->
	        	<img :src="like.user.avatar" :title="like.user.firstname + ' ' + like.user.lastname" style="height: 30px; width: 30px; border: 1px solid #e4e2e5; margin-top: -26px; margin-right: 7px;" alt="user" class="profile-photo-sm pull-right" />
	        </div>
		</div>

		<div v-if="post">
			<button class="btn btn-info btn-xs" v-if="!auth_user_likes_post" @click="like()"><i class="fa fa-thumbs-up"></i> Like <span class="badge" style="margin-top: -3px;">{{ post.likes.length }}</span></button> 

			<button class="btn btn-danger btn-xs" v-else @click="unlike()"><i class="fa fa-thumbs-down"></i> Unike <span class="badge" style="margin-top: -3px;">{{ post.likes.length }}</span></button> 

	        <div v-for="like in post.likes"> <!-- v-b-tooltip.hover -->
	        	<img :src="like.user.avatar" :title="like.user.firstname + ' ' + like.user.lastname" style="height: 30px; width: 30px; border: 1px solid #e4e2e5; margin-top: -26px; margin-right: 7px;" alt="user" class="profile-photo-sm pull-right" />
	        </div>
		</div>
	</div>
</template>

<script>
	import axios from 'axios';
	
	export default {
		mounted() {

		},

		props: ['id'],

		methods: {
			like() {
				axios.get('/like/' + this.id)
					 .then((resp) => {
					 	this.$store.commit('update_feed_post_likes', {
					 		id: this.id,
					 		like: resp.data
					 	})
					 })

					 new Noty({ 
                        type:'success', 
                        layout:'bottomLeft',
                        text: 'Post liked successfully !', 
                        timeout: 3000
                    }).show();
			},

			like_new() {
				axios.get('/like/' + this.id)
					 .then((resp) => {
					 	this.$store.commit('update_new_feed_post_likes', {
					 		id: this.id,
					 		like: resp.data
					 	})
					 })

					 new Noty({ 
                        type:'success', 
                        layout:'bottomLeft',
                        text: 'Post liked successfully !', 
                        timeout: 3000
                    }).show();
			},

			unlike() {
				axios.get('/unlike/' + this.id)
					 .then((response) => {
						this.$store.commit('unlike_feed_post', {
							post_id: this.id,
							like_id: response.data
						})
					 })

					 new Noty({ 
                        type:'error', 
                        layout:'bottomLeft',
                        text: 'Post unliked successfully !', 
                        timeout: 3000
                    }).show();
			},

			unlike_new() {
				axios.get('/unlike/' + this.id)
					 .then((response) => {
						this.$store.commit('unlike_new_feed_post', {
							post_id: this.id,
							like_id: response.data
						})
					 })

					 new Noty({ 
                        type:'error', 
                        layout:'bottomLeft',
                        text: 'Post unliked successfully !', 
                        timeout: 3000
                    }).show();
			}
		},

		computed: {
			post() {
				return this.$store.state.feedposts.find( (post) => {
					return post.id === this.id
				})
			},

			newpost() {
				return this.$store.state.newfeedposts.find( (newpost) => {
					return newpost.id === this.id
				})
			},

			likers() {
				var likers = []

				this.post.likes.forEach((like) => {
					likers.push(like.user.id)
				})

				return likers;
			},

			newlikers() {
				var newlikers = []

				this.newpost.likes.forEach((like) => {
					newlikers.push(like.user.id)
				})

				return newlikers;
			},

			auth_user_likes_post() {
				var check_index = this.likers.indexOf(
					this.$store.state.auth_user.id
				)

				if (check_index === -1) {
					return false
				} else {
					return true
				}
			},

			auth_user_likes_new_post() {
				var check_index = this.newlikers.indexOf(
					this.$store.state.auth_user.id
				)

				if (check_index === -1) {
					return false
				} else {
					return true
				}
			}
		}
	}
</script>

<style lang="css" scoped>
</style>