<template>

	<div class="panel panel-default" style="margin-bottom: 35px;">
		<div class="panel-heading"><span style="color: #6d6e71;">Create Post</span></div>
		<div class="create-post">
			<div class="row">
				<div class="col-md-12 col-sm-12">
					
					<div class="form-group">
						<img :src="user.avatar" alt="" class="profile-photo-md" />
						<textarea v-model.trim="content" id="exampleTextarea" cols="60" rows="4" class="form-control" placeholder="Write what you wish"></textarea>
					</div>

			    </div>

				<!-- <div class="col-md-5 col-sm-5">
						<div class="tools">
							<ul class="publishing-tools list-inline">
							  <li><a href="#"><i class="ion-compose"></i></a></li>
							  <li><a href="#"><i class="ion-ios-videocam"></i></a></li>
							  <li><a href="#"><i class="ion-map"></i></a></li>
							</ul>
						</div>
					</div> -->
			</div>

			<div class="row">
				<div class="col-md-12 col-sm-12">
					<div v-if="!image">
						<div class="file-upload"><label for="upload" class="file-upload__label"><i class="ion-images"></i> Select Photo</label>
	                        <input id="image" class="form-control input-group-lg file-upload__input" type="file" accept="image/*" title="Upload Photo" @change="onFileChange" />
	                    </div>
	                </div>
	                
	                <div v-else>
	                	<div>
							<img :src="image" style="width: 100px; height: 100px; margin-left: 60px; margin-top: 15px;" />
							<span class="badge" @click="removeImg()" style="background: #fa3e3e; position: relative; top: -40px; left: -15px; padding: 4px 6px;"> <i class="fa fa-close"></i> </span>
						</div>
						
					</div>	
				</div>
			</div>


			<div class="row">
				<div class="col-md-12 col-sm-12">
					<br>
					<div v-if="!image">
						<button class="btn btn-primary pull-right" :disabled="not_working" @click="create_post()" style="width: 90%;">Publish Post</button>
					</div>
					<div v-else>
						<button class="btn btn-primary pull-right" @click="uploadImg" style="width: 90%;"> Upload & Publish Post</button>
						
					</div>

				</div>
			</div>
		</div>
	</div>

</template>

<script>

import axios from 'axios';

export default {

	mounted() {

	},

	props : ['user'],

	data() {
		return {
			content: '',
			not_working: true,
			image: ''
		}
	},

	methods: {
		create_post() {
			axios.post('/create/post/new', { content: this.content })
				 .then((resp) => {
				 	this.content = ''
				 	new Noty({ 
                        type:'info', 
                        layout:'bottomLeft',
                        text: 'Your post has been published successfully !', 
                        timeout: 3000
                    }).show();

                    this.$store.commit('add_new_posts', resp.data);
                    this.$store.commit('add_new_feed_posts', resp.data);

                    document.getElementById("noty_audio").play();
                    //this.$store.commit('add_posts', resp.data);

				})
		},

		onFileChange(e){
			var files = e.target.files || e.dataTransfer.files;
			this.createImg(files[0]); // files the image/ file value to our function

		},

		createImg(file){
			// we will preview our image before upload
			var image = new Image;
			var reader = new FileReader;

			reader.onload = (e) =>{
			    this.image = e.target.result;
			};
			reader.readAsDataURL(file);
		},

		uploadImg() {
			axios.post('/post/image/save', { image: this.image, content: this.content })
				 .then((response) => {
				 	this.content = ''
				 	this.image = ''
				 	new Noty({ 
                        type:'info', 
                        layout:'bottomLeft', 
                        text: 'Your post has been published successfully !', 
                        timeout: 3000
                    }).show();

                    this.$store.commit('add_new_posts', response.data);
                    this.$store.commit('add_new_feed_posts', response.data);

                    document.getElementById("noty_audio").play();

			})
		},

		removeImg() {
			this.image = ''
		}

	},

	watch: {
		content() {
			if (this.content.length > 0) {
				this.not_working = false
			} else {
				this.not_working = true
			}
		}
	}

}
</script>

<style type="text/css">
	.panel-default > .panel-heading::before {
    	content: "";
	}

	.file-upload {
		margin-left: 60px;
		margin-top: 15px;
		position: relative;
		display: inline-block;
		width: 115px;
	}
  
  .file-upload__label {
	  display: block;
	  padding: 4px;
	  color: #666;
	  background: #eff0f1;
	  transition: background .3s;
	  cursor: pointer;
	  border-radius: 4px;
	  text-align: center;
	}

	.file-upload__input {
	  position: absolute;
	  left: 0;
	  top: 0;
	  right: 0;
	  bottom: 0;
	  
	  width: 0;
	  height: 100%;
	  opacity: 0;
	  cursor: pointer;
	}
</style>
