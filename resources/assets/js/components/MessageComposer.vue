<template>
	<div class="send-message" style="box-shadow: 0 -1px 5px 1px rgba(0, 0, 0, .1);">
		<div class="input-group">
			<textarea type="text" v-model.trim="message" class="form-control" @keydown.enter="send" style="height: 34px;" placeholder="Type your message"></textarea>
			<span class="input-group-btn">
				<button class="btn btn-default" @click="send">Send</button>
			</span>
		</div>
	</div>
</template>

<script>
	export default {
		data() {
			return {
				message: ''
			}
		},

		methods: {
			send(e) {
				e.preventDefault();

				if (this.message == '') {
					return;
				}

				this.$emit('send', this.message); //Notifies parent Conversation.vue's send method as props can only flow to parent to child.
				this.message = '';
			}
		}
	}
</script>

<style lang="css" scoped>
</style>