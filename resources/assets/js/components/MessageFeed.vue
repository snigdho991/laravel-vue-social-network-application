<template>
	<div class="tab-content" ref="msgfeed">
		<div class="tab-pane active">
			<div class="chat-body">                       
				<ul class="chat-message" v-if="contact">
				  
				  <li :class="message.to === contact.id ? 'right' : 'left'" v-for="message in messages" :key="message.id">
				    <img :src="contact.avatar" alt="" :class="message.to === contact.id ? 'profile-photo-sm pull-right' : 'profile-photo-sm pull-left'" />
				    <div class="chat-item">
				      <div class="chat-item-header">
				        <h5>{{ message.to === contact.id ? 'You' : contact.firstname }}</h5>
				        <small class="text-muted" style="top: 9px;color: #77797C;">{{ message.created_at | msgTime }}</small>
				      </div>
				      <p><b>{{ message.text }}</b></p>
				    </div>
				  </li>
				  
				</ul>
			</div>
		</div>

	</div><!--Chat Messages in Right End-->
</template>

<script>
	export default {
		
		beforeMount() {
			Vue.filter('msgTime', function(value){
				return moment(value).utc(+6).fromNow();
			})
		},

		props: {
			contact: {
				type: Object
			},
			messages: {
				type: Array,
				required: true
			},
		},

		methods: {
			scrollToBottom() {
				setTimeout( () => {
					this.$refs.msgfeed.scrollTop = this.$refs.msgfeed.scrollHeight - this.$refs.msgfeed.clientHeight;
				}, 10);	
			},
		},

		watch: {
			contact(contact) {
				this.scrollToBottom();
			},

			messages(messages) {
				this.scrollToBottom();
			},
		}
	}
</script>

<style lang="css" scoped>
</style>