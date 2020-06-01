<!-- 
<template>
	<li class="dropdown">
		<a v-if="unreadNots.length === 0" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
			<i class="fa fa-bell fa-2x" style="color: #fff"></i>
		</a>

		<a v-else href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
			<i class="fa fa-bell fa-2x" style="color: #fff"></i>
			<span class="badge" style="background: #fa3e3e; position: relative; top: -16px; left: -11px;"> {{ unreadNots.length }} </span>
		</a>

		<ul class="dropdown-menu" style="min-width: 500px; margin-right: 37px;"> 
		    <span v-if="all_nots_count !== 0">
		    	<li v-for="all_not in all_nots" style="padding: 15px 0px; border-top: 1px solid rgba(255,255,255, 0.1); border-bottom: 0px; background: #222;"><a style="margin-left: 17px;text-decoration: none;" href="/notifications">{{ all_not.name + all_not.message }}</a>
		    	</li>
		    			</span>
		    
		    <span v-else><li style="padding: 15px 0px; border-top: 1px solid rgba(255,255,255, 0.1); border-bottom: 0px; background: #222;">
		      No unread notificationss.</li>
		    </span>
		    
		    			<li class="text-center" style="padding: 15px 0px; border-top: 1px solid rgba(255,255,255, 0.1); border-bottom: 0px;"><a href="/notifications" style="color: #27aae1;">
		      See all notifications</a></li>
		</ul>
	</li>
	
</template>

1st Step: Component calls mounted, then methods(get_unread_notification), store.js-> mutations, state. 2nd Step: getters, computed

<script>
	export default {
		
		data() {
			return {
				unreadNots: this.unreads
			}
		},

		mounted() {

		},

		methods: {
			get_unread_notification() {
				
			}
		},

		computed: {
			all_nots_count() {
				return this.$store.getters.all_nots_count
			}
		}
	}
</script> -->