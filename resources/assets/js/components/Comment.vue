<template>
	<div>
		<div class="line" style="margin-top: 17px;"></div>

		<button class="btn btn-xs ml-2" :class="{ 'btn-default': !commentarea, 'btn-warning': commentarea }" @click="commentarea = !commentarea" style="cursor: pointer; margin-left: 185px;" v-if="comments.data.length > 0">{{ commentarea ? 'Hide comments' : 'Load comments' }}
		</button>
		
	    <div class="post-comment">
	      <img :src="auth" alt="user" class="profile-photo-sm" />
	      <div class="row" style="width: 100%;">
	        <div class="form-group col-md-9">
	            <input type="text" v-model="newComment" class="form-control" style="box-shadow: none;" placeholder="Type your comment">
	        </div>
	        <div class="form-group col-md-3">
	            <button class="btn btn-success" @click="addComment()" type="button" style="margin-bottom: -14px; margin-left: -25px; padding: 5px 15px;">Add Comment</button>
	        </div>
	      </div>
    	</div>

    	<single-comment v-for="comment in comments.data" :key="comment.id" :comment="comment" v-if="commentarea"></single-comment>

    	<div class="text-center" v-if="commentarea">
    		<button class="btn btn-success btn-xs" v-if="comments.next_page_url" @click="fetchComments()">Load More</button>
    	</div>

    </div>
</template>

<script>

import axios from 'axios';
import SingleComment from './SingleComment.vue';

export default {

	mounted() {
		this.fetchComments()
	},

	components: {
	    SingleComment
	},

	data: () => ({
		comments: {
			data: []
		},
		newComment: '',
		commentarea: false
	}),

	props: ['auth', 'post'],

	methods: {
		fetchComments() {
			const url = this.comments.next_page_url ? this.comments.next_page_url : `/post/${this.post.id}/comments`

			axios.get(url).then(({ data }) => {

				this.comments = {
					...data,
					data: [
						...this.comments.data,
						...data.data
					]
				}

			})
		},

		addComment() {
			if(!this.newComment) return 

			axios.post(`/comment/${this.post.id}`, {
				body: this.newComment

			}).then(({data}) => {
				this.comments = {
					...this.comments,
					data: [
						data,
						...this.comments.data
					]
				}

				this.$store.commit('add_comments', {
					post_id: this.post.id,
					comment: this.comments.data
				})

				this.newComment = ''

				new Noty({ 
	                type:'success', 
	                layout:'bottomLeft', 
	                text: 'Comment added successfully !', 
	                timeout: 3000
	            }).show();

			})
		}
	},

}
</script>

<style>
	.line {
	    background: none;
	    height: 1px;
	    border-top: 1px dashed #e6e6e6;
	    margin-bottom: 13px;
	    width: 595px;
	    margin-left: -85px;
	}
</style>