<template>
	<div class="col-md-7">
                  
		<!--Chat Messages in Right-->
		<div class="panel panel-default" style="margin-bottom: 35px; border-bottom: 0px;">
			<div class="panel-heading">
			    <span style="color: #6d6e71;">{{ contact ? contact.firstname + ' ' + contact.lastname : "Select any user" }}</span>
			</div>
		</div>

		<MessageFeed :contact="contact" :messages="messages"></MessageFeed>
		<MessageComposer @send="sendMessage"></MessageComposer>

	</div>
</template>

<script>
	import MessageFeed from './MessageFeed.vue';
	import MessageComposer from './MessageComposer.vue';

	export default {
		mounted() {

		},

		props: ["messages", "contact"],

		components: {
			MessageFeed, MessageComposer
		},

		methods: {
			sendMessage(text) {
				if (!this.contact) {
					return;
				}
				
				axios.post('/conversation/send', {
					contact_id: this.contact.id,
					text: text
				}).then((response) => {
					this.$emit('new', response.data)
				})
			}
		}
	}
</script>

<style lang="css" scoped>
</style>