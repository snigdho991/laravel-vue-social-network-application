<template>
	<!-- Post Content
    ================================================= -->
  <div>
    <div class="post-content" v-if="newposts.length === 0 && allposts.length === 0">
        <div class="post-container">
            <p>No update available in your timeline. <span style="color: #5bc0de;">Punblish a post</span> to get started with the timeline.</p>
        </div>
    </div>

    <div class="post-content" v-if="newposts" v-for="post in newposts">
        <div v-if="post.image">
          <img :src="post.image" style="height: 300px;" alt="post-image" class="img-responsive post-image" />
        </div>

        <div class="post-container">
          
            <img :src="post.user.avatar" :title="post.user.firstname + ' ' + post.user.lastname" alt="user" class="profile-photo-md pull-left" />
            <div class="post-detail">
              <div class="user-info">
                <h5><a :href="'/timeline/' + post.user.firstname + '-' + post.user.lastname" class="profile-link">{{ post.user.firstname + ' ' + post.user.lastname }}</a>    
                  <span class="following pull-right"><b>{{ post.comments.length }} comments</b></span>
                </h5>
                <p class="text-muted">{{ post.created_at | feedpostTime }} <i class="fa fa-globe" style="margin-left: 3px;"></i></p>
              </div>
              <!-- <div class="reaction">
                <a class="btn text-green"><i class="icon ion-thumbsup"></i> 13</a>
                <a class="btn text-red"><i class="fa fa-thumbs-down"></i> 0</a>
              </div> -->
              
                
                  <div class="post-text" v-if="post.content">
                    <div class="line"></div> <p>{{ post.content }} </p>
                    
                  </div>
              
                  <div class="line"></div>
                    
                  <timelinelike :id="post.id"></timelinelike>

                  <timelinenewcomment :auth="auth.avatar" :post="post"></timelinenewcomment>

            </div>
          
        </div>

    </div>
      
    <div class="post-content" v-if="allposts" v-for="post in posts.data">

      <div class="post-date hidden-xs hidden-sm">
        <!-- <h5></h5>
        <p class="text-grey"></p> -->
      </div>

      <div v-if="post.image">
        <img :src="post.image" style="height: 300px;" alt="post-image" class="img-responsive post-image" />
      </div>

      <div class="post-container">
        
          <img :src="post.user.avatar" :title="post.user.firstname + ' ' + post.user.lastname" alt="user" class="profile-photo-md pull-left" />
          <div class="post-detail">
            <div class="user-info">
              <h5><a :href="'/timeline/' + post.user.firstname + '-' + post.user.lastname" class="profile-link">{{ post.user.firstname + ' ' + post.user.lastname }}</a>    
                <span class="following pull-right"><b>{{ post.comments.length }} comments</b></span>
              </h5>
              <p class="text-muted">{{ post.created_at | feedpostTime }} <i class="fa fa-globe" style="margin-left: 3px;"></i></p>
            </div>
            <!-- <div class="reaction">
              <a class="btn text-green"><i class="icon ion-thumbsup"></i> 13</a>
              <a class="btn text-red"><i class="fa fa-thumbs-down"></i> 0</a>
            </div> -->
            
              
                <div class="post-text" v-if="post.content">
                  <div class="line"></div> <p>{{ post.content }} </p>
                  
                </div>
            
                <div class="line"></div>
                  
                <timelinelike :id="post.id"></timelinelike>

                <timelinecomment :auth="auth.avatar" :post="post"></timelinecomment>

          </div>
        
      </div>

    </div>

    <div class="text-center">
      <!-- <div ref="infinitescrolltriger" id="scroll_trigger"></div>
      <span class="btn btn-primary" v-if="loadMore"></span> -->
        <infinite-loading @infinite="get_feed">
          <span slot="no-more"></span>
          <span slot="no-results"></span>
        </infinite-loading>
        <span class="btn btn-primary" v-if="loadMore">More Posts Loading...</span>
    </div>

    <div class="post-content" v-if="endfeed" style="margin-top: 45px;">
        <div class="post-container" v-if="newposts.length > 0 || allposts.length > 0">
            <p>No further post is available in your newsfeed. You can refresh the <a href="/newsfeed">newsfeed</a> to get more updates.</p>
        </div>
    </div>
  </div>
</template>

<script>

import Timelinelike from './Timelinelike.vue';
import Timelinecomment from './Timelinecomment.vue';
import Timelinenewcomment from './Timelinenewcomment.vue';
import InfiniteLoading from 'vue-infinite-loading';

export default {
	mounted() {
		
  },

  beforeMount() {
      Vue.filter('feedpostTime', function(value){
          return moment(value).utc(+6).fromNow();
      })
  },

  props : ['auth'],

  data: () => ({
    posts: {
      data: []
    },
    current_page: 1,
    loadMore: false,
    endfeed: false
  }),

  components: {
      Timelinelike, Timelinecomment, Timelinenewcomment, InfiniteLoading,
  },

	methods: {
		get_feed($state) {
      const url3 = this.posts.next_page_url ? this.posts.next_page_url : '/timelinefeed?page=' + this.current_page

      axios.get(url3).then(({ data }) => {

        data.data.forEach( (post) => {
            this.$store.commit('add_feed_posts', post)
        })

        /*this.current_page = data.current_page*/
        if (data.data.length) {
            this.loadMore = true
            this.current_page += 1;
            this.posts = {
              ...data,
              data: [
                ...this.posts.data,
                ...data.data,
              ]
            }
            $state.loaded();
        } else {
            this.loadMore = false
            $state.complete();
            this.endfeed = true
        }

      })
		},
    
	},

  computed: {
    allposts() {
      return this.$store.getters.all_feed_posts
    },

    newposts() {
      return this.$store.getters.feed_new_posts
    },
  }
  
}
</script>

<style type="text/css">
  .line {
    background: none;
    height: 1px;
    border-top: 1px dashed #e6e6e6;
    margin-bottom: 13px;
    width: 595px;
    margin-left: -85px;
  }
</style>
