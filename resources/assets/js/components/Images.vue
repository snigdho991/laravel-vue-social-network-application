<template>
	<div>
		<ul class="album-photos">
		    <particular-image v-for="image in images.data" :key="image.id" :image="image" :user="user"></particular-image>
		</ul>
		<div class="text-center">
			<button class="btn btn-primary btn-xs" v-if="images.next_page_url" @click="fetchImages()">Load More</button>
		</div>
	</div>
</template>

<script>
	import ParticularImage from './ParticularImage.vue';

	export default {
		mounted() {
			this.fetchImages()
		},

		components: {
		    ParticularImage
		},

		data: () => ({
			images: {
				data: []
			},

		}),

		props: ['user'],

		methods: {
			fetchImages() {
				const url = this.images.next_page_url ? this.images.next_page_url : `/timeline/${this.user.slug}/getimages`

				axios.get(url).then(({ data }) => {

					this.images = {
						...data,
						data: [
							...this.images.data,
							...data.data
						]
					}

					//console.log(this.friends.total)
					
				})
			},
		}
	}
</script>

<style lang="css" scoped>
	ul.album-photos li {
	    
	}
</style>