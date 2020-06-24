<template>
	<div class="col-md-6 col-sm-6">
		<div class="friend-card">
	      <img :src="friend.cover" alt="profile-cover" class="img-responsive cover" />
	      <div class="card-info" style="background: #fff;">
	        <img :src="friend.avatar" alt="user" class="profile-photo-lg" />
	        <div class="friend-info">
	        	<div v-if="authuser.id !== user.id">
					<a class="pull-right text-green" v-if="status === 'friends'">
						Mutual Friend
					</a>
		        </div>

		        <div v-else-if="authuser.id === user.id">
					<p class="pull-right text-muted">
						<i class="fa fa-hand-o-right"></i> {{ friend.created_at | friendTime }}
					</p>
		        </div>

				<h5><a :href="'/timeline/' + friend.firstname + '-' + friend.lastname" class="profile-link">{{ friend.firstname + ' ' + friend.lastname }}</a></h5>
				<p>Student</p>
	        </div>
	      </div>
	    </div>
	</div>
</template>

<script>
export default {

	mounted() {
		this.is_friends_with()
            		
	},

	beforeMount() {
		Vue.filter('friendTime', function(value){
			return moment(value).utc(+6).fromNow();
		})
	},

	props: ['friend', 'user'],

	data() {
    	return {
    		status: "",
    	}
    },

	methods: {
		is_friends_with() {
			axios.get('/check_status/' + this.friend.id )
            	.then( (resp) => {
            		this.status = resp.data.status
            		
            	})
		},
	},

	computed: {
	    authuser() {
	    	return this.$store.state.auth_user
	    }
	}

}
</script>

<style lang="css" scoped>
</style>