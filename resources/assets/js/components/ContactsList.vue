<template>
	<div class="col-md-5">
	                  
		<!-- Contact List in Left-->
		<ul class="nav nav-tabs contact-list">

			<li class="active" v-for="contact in sortedContacts" :key="contact.id" @click="selectContact(contact)" :class="{ 'selected' : contact === selected }">
		      <a href="#contact-1" data-toggle="tab">
		        <div class="contact">
		          <img :src="contact.avatar" :alt="contact.firstname" class="profile-photo-sm pull-left"/>
		          <div class="msg-preview">
		            <h6 style="top: 13px;position: relative;">{{ contact.firstname + ' ' + contact.lastname }}</h6>

		            
			            <!-- <p class="text-muted"><b style="color: #555;" v-if="contact.msgunread">{{ contact.msgunread.substring(0, 15)+"..." }}</b><b style="color: #555;" v-else>No unread message.</b></p>
			            <small class="text-muted">{{ contact.msgunreadcreated | msgTime }}</small> -->
			            <div class="chat-alert" style="bottom: 28px;" v-if="contact.unread">{{ contact.unread }}</div>
			        
		          </div>
		        </div>
		      </a>
		    </li>

		</ul><!--Contact List in Left End-->

	</div>
</template>

<script>
	export default {

		beforeMount() {
			Vue.filter('msgTime', function(value){
				return moment(value).utc(+6).fromNow();
			})
		},

		mounted(){

		},

		props: ["contacts", "messages"],

		data() {
			return {
				selected: this.contacts.length ? this.contacts[0] : null
			}
		},

		methods: {
			selectContact(contact) {
				this.selected = contact;
				this.$emit('selected', contact);
			}
		},

		computed: {
			sortedContacts() {
				return _.sortBy(this.contacts, [(contact) => {
					if (contact == this.selected) {
						return Infinity;
					}
					return contact.unread;
					return contact.unreadMsg;
				}]).reverse();
			},
		}

	}
</script>

<style lang="css" scoped>
	.chat-room ul.contact-list li a {

	    border: none;
	        border-bottom-color: currentcolor;
	        border-bottom-style: none;
	        border-bottom-width: medium;
	    padding: 10px 0px 35px;
	    border-bottom: 1px solid rgba(39,164,231, .1) !important;

	}
</style>