<template>
	<div class="friend-list">
        <div class="row">
        
        <particularfri-list v-for="friend in friends.data" :key="friend.id" :friend="friend" :user="user"></particularfri-list>
        
        <div class="text-center">
    		<button class="btn btn-primary btn-xs" v-if="friends.next_page_url" @click="fetchFriends()">Load More</button>
    	</div>
        
        </div>
    </div>
</template>

<script>

import ParticularfriList from './ParticularfriList.vue';

export default {
	mounted() {
		this.fetchFriends()
	},

	components: {
	    ParticularfriList
	},

	data: () => ({
		friends: {
			data: []
		},

	}),

	props: ['user'],

	methods: {
		fetchFriends() {
			const url = this.friends.next_page_url ? this.friends.next_page_url : `/timeline/${this.user.slug}/friendlist`

			axios.get(url).then(({ data }) => {

				this.friends = {
					...data,
					data: [
						...this.friends.data,
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
</style>