<template>
	<div>
		<div class="post-comment">
	      <img :src="comment.user.avatar" :title="comment.user.firstname + ' ' + comment.user.lastname" alt="" class="profile-photo-sm" />
	      <p><a :href="'/timeline/' + comment.user.firstname + '-' + comment.user.lastname" class="profile-link">{{ comment.user.firstname + ' ' + comment.user.lastname }} </a> ({{ comment.created_at | replyTime }})<!-- <i class="em em-laughing"></i> --> <b>-</b> {{ comment.body }} </p>
	    </div>
    </div>
</template>

<script>
export default {
	mounted() {
		Vue.filter('replyTime', function(value){
          	return moment(value).utc(+6).fromNow();
      	})
	},

	props: ['comment'],

}
</script>

<style lang="css" scoped>
</style>