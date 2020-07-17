<template>
	<div class="chat-app">
		<ContactsList :contacts="contacts" :messages="messages" @selected="startConversationWith"></ContactsList>
		<Conversation :contact="selectedContact" :messages="messages" @new="saveNewMessage"></Conversation>
	</div>
</template>

<script>
	import Conversation from './Conversation.vue';
	import ContactsList from './ContactsList.vue';

	export default {
		created() {
			Echo.private('App.User.' + this.auth.id)
				.listen('NewIncomingMessage', (e) => {
					this.handleIncomingMsg(e.message)
				});

			//listen() doesn't support mounted()

			axios.get('/authfriends')
				.then((response) => {
			 	this.contacts = response.data
			})
		},

		props: ["auth"],

		data() {
			return {
				selectedContact: null,
				messages: [],
				contacts: [],
			};
		},

		components: {
			Conversation, ContactsList
		},

		methods: {
			startConversationWith(contact) {
				this.updateUnreadCount(contact, true);
				
				axios.get(`/conversation/${contact.id}`)
					.then( (response) => {
						this.messages = response.data
						this.selectedContact = contact
					})
			},

			saveNewMessage(message) {
				this.messages.push(message);
			},

			handleIncomingMsg(message) {
				if (this.selectedContact && message.from == this.selectedContact.id) {

					this.saveNewMessage(message);
					new Noty({ 
						type:'success', 
						layout:'bottomLeft', 
						text: `Incoming message from ${message.from_contact.firstname + ' ' + message.from_contact.lastname} !`, 
						timeout: 5000
					}).show()

					document.getElementById("noty_audio").play();
					return;
				}

				console.log(message);
				this.updateUnreadCount(message.from_contact, false);
				
				new Noty({ 
					type:'success', 
					layout:'bottomLeft', 
					text: `Incoming message from ${message.from_contact.firstname + ' ' + message.from_contact.lastname} !`, 
					timeout: 5000
				}).show()

				document.getElementById("noty_audio").play();
				
			},

			updateUnreadCount(contact, reset) {
				this.contacts = this.contacts.map((single) => {
					if (single.id !== contact.id) {
						return single;
					}

					if (reset)
						single.unread = 0

					else 
						single.unread += 1
						
					return single;
				})
			},

		}
	}
</script>

<style lang="css" scoped>
</style>