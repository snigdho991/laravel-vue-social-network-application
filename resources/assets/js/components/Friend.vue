<template>
    <div>
        <div v-if="loading" class="loader">
    		<div class="loader-text" style="font-weight: bold; font-size: 33px;"></div>
        </div>

        <div v-if="!loading">
            <button class="btn-primary" v-if="status == 0" @click="add_friend">Add Friend</button>
            <button class="btn btn-success" v-if="status == 'pending'" @click="accept_friend">Confirm Friend</button>
            <button class="btn btn-warning" style="margin-left: 10px;" v-if="status == 'pending'" @click="decline_request">Decline Request</button>
            <span class="btn btn-info" v-if="status == 'responsing'"><span class="badge"><i class="fa fa-check"></i></span> Friend Request Sent</span>
            <span class="btn btn-default" v-if="status == 'friends'"><span class="badge"><i class="fa fa-address-book"></i></span> Friends</span>
        </div>
    </div>
</template>

<style type="text/css">
    
    .loader {
      width: 60px;
    }

    .loader-wheel {
      animation: spin 1s infinite linear;
      border: 2px solid rgba(30, 30, 30, 0.5);
      border-left: 4px solid #fff;
      border-radius: 50%;
      height: 20px;
      margin-bottom: 2px;
      width: 20px;
    }

    .loader-text {
      color: #fff;
      font-family: arial, sans-serif;
    }

    .loader-text:after {
      content: 'Loading';
      animation: load 2s linear infinite;
    }

    @keyframes spin {
      0% {
        transform: rotate(0deg);
      }
      100% {
        transform: rotate(360deg);
      }
    }

    @keyframes load {
      0% {
        content: '.';
      }
      33% {
        content: '..';
      }
      67% {
        content: '...';
      }
      100% {
        content: '....';
      }
    }

</style>

<script>
    import axios from 'axios';
	export default {
        mounted() {
            axios.get('/check_status/' + this.get_user_id )
            	.then( (resp) => {
            		console.log(resp)
            		this.status = resp.data.status
                    this.loading = false
                })
        },

        props: ['get_user_id'],
        
        data() {
        	return {
        		status: "",
                loading: true
        	}
        },
        
        methods: {
            add_friend() {
                this.loading = true
                axios.get('/add_friend/' + this.get_user_id)
                    .then( (resp) => {
                        if (resp.data == 1) {
                            this.status = 'responsing'
                            new Noty({ 
                                type:'warning', 
                                layout:'bottomLeft', 
                                text: 'Friend Request Sent !', 
                                timeout: 3000
                            }).show();
                            this.loading = false
                        }
                    })
            },

            accept_friend() {
                this.loading = true
                axios.get('/accept_friend/' + this.get_user_id)
                    .then( (resp) => {
                        if (resp.data == 1) {
                            this.status = 'friends'
                            new Noty({ 
                                type:'success', 
                                layout:'bottomLeft', 
                                text: 'Request Accepted. You are now friends !', 
                                timeout: 3000
                            }).show();
                            this.loading = false
                        }
                    })
            },

            decline_request() {
                this.loading = true
                axios.get('/decline_request/' + this.get_user_id)
                    .then( (resp) => {
                        if (!resp.data) {
                            this.status = '0'
                            new Noty({ 
                                type:'error', 
                                layout:'bottomLeft', 
                                text: 'Request Deleted !', 
                                timeout: 3000
                            }).show();
                            this.loading = false
                        }
                    })
            }
        }
    }
</script>
