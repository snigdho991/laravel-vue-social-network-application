<template>
	<!-- Post Content
    ================================================= -->
  <div>
    <div class="post-content" v-if="newposts.length === 0 && allposts.length === 0">
        <div class="post-container">
            <p>No update available in your newsfeed. <span style="color: #5bc0de;">Add friends</span> or <span style="color: #5bc0de;">Punblish a post</span> to explore the newsfeed.</p>
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
                <p class="text-muted">{{ post.created_at | postTime }} <i class="fa fa-globe" style="margin-left: 3px;"></i></p>
              </div>
              <!-- <div class="reaction">
                <a class="btn text-green"><i class="icon ion-thumbsup"></i> 13</a>
                <a class="btn text-red"><i class="fa fa-thumbs-down"></i> 0</a>
              </div> -->
              
                
                  <div class="post-text" v-if="post.content">
                    <div class="line"></div> <p>{{ post.content }} </p>
                    
                  </div>
              
                  <div class="line"></div>
                    
                  <like :id="post.id"></like>

                  <newcomment :auth="auth.avatar" :post="post"></newcomment>

            </div>
          
        </div>

    </div>
      
    <div class="post-content" v-if="allposts" v-for="post in posts.data">
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
              <p class="text-muted">{{ post.created_at | postTime}} <i class="fa fa-globe" style="margin-left: 3px;"></i></p>
            </div>
            <!-- <div class="reaction">
              <a class="btn text-green"><i class="icon ion-thumbsup"></i> 13</a>
              <a class="btn text-red"><i class="fa fa-thumbs-down"></i> 0</a>
            </div> -->
            
              
                <div class="post-text" v-if="post.content">
                  <div class="line"></div> <p>{{ post.content }} </p>
                  
                </div>
            
                <div class="line"></div>
                  
                <like :id="post.id"></like>

                <comment :auth="auth.avatar" :post="post"></comment>

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

    <!-- Video Content
    =================================================
    <div class="post-content">
      <div class="video-wrapper">
        <video class="post-video" controls> <source src="videos/8.mp4" type="video/mp4"> </video>
      </div>
      <div class="post-container">
        <img src="images/users/user-3.jpg" alt="user" class="profile-photo-md pull-left" />
        <div class="post-detail">
          <div class="user-info">
            <h5><a href="timeline.html" class="profile-link">Sophia Lee</a> <span class="following">following</span></h5>
            <p class="text-muted">Updated her status about 33 mins ago</p>
          </div>
          <div class="reaction">
            <a class="btn text-green"><i class="icon ion-thumbsup"></i> 75</a>
            <a class="btn text-red"><i class="fa fa-thumbs-down"></i> 8</a>
          </div>
          <div class="line-divider"></div>
          <div class="post-text">
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
          </div>
          <div class="line-divider"></div>
           <div class="post-comment">
            <img src="images/users/user-14.jpg" alt="" class="profile-photo-sm" />
            <p><a href="timeline.html" class="profile-link">Olivia </a> Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. <i class="em em-anguished"></i> Ut enim ad minim veniam, quis nostrud </p>
          </div>
          <div class="post-comment">
            <img src="images/users/user-1.jpg" alt="" class="profile-photo-sm" />
            <p><a href="timeline.html" class="profile-link">Sarah</a> Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</p>
          </div>
          <div class="post-comment">
            <img src="images/users/user-2.jpg" alt="" class="profile-photo-sm" />
            <p><a href="timeline.html" class="profile-link">Linda</a> Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
          </div>
          <div class="post-comment">
            <img src="images/users/user-1.jpg" alt="" class="profile-photo-sm" />
            <input type="text" class="form-control" placeholder="Post a comment">
          </div>
        </div>
      </div>
    </div>
    
    Map Content
    =================================================
    <div class="post-content">
      <div class="google-maps">
        <div id="map" class="map"></div>
      </div>
      <div class="post-container">
        <img src="images/users/user-3.jpg" alt="user" class="profile-photo-md pull-left" />
        <div class="post-detail">
          <div class="user-info">
            <h5><a href="timeline.html" class="profile-link">Sophia Lee</a> <span class="following">following</span></h5>
            <p class="text-muted"><i class="icon ion-ios-location"></i> Went to Niagara Falls today</p>
          </div>
          <div class="reaction">
            <a class="btn text-green"><i class="icon ion-thumbsup"></i> 17</a>
            <a class="btn text-red"><i class="fa fa-thumbs-down"></i> 0</a>
          </div>
          <div class="line-divider"></div>
          <div class="post-text">
            <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio.</p>
          </div>
          <div class="line-divider"></div>
          <div class="post-comment">
            <img src="images/users/user-1.jpg" alt="" class="profile-photo-sm" />
            <p><a href="timeline.html" class="profile-link">Sarah </a>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. <i class="em em-blush"></i> <i class="em em-blush"></i> </p>
          </div>
          <div class="post-comment">
            <img src="images/users/user-1.jpg" alt="" class="profile-photo-sm" />
            <input type="text" class="form-control" placeholder="Post a comment">
          </div>
        </div>
      </div>
    </div>
    -->
  </div>
</template>

<script>

import Like from './Like.vue';
import Comment from './Comment.vue';
import Newcomment from './Newcomment.vue';
import InfiniteLoading from 'vue-infinite-loading';

export default {
	mounted() {
		
  },

  beforeMount() {
      Vue.filter('postTime', function(value){
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
    /*per_page: '',
    total: '',
    page_count: '',
    loadMore: false*/
  }),

  components: {
      Like, Comment, Newcomment, InfiniteLoading,
  },

	methods: {
		get_feed($state) {
      const url2 = this.posts.next_page_url ? this.posts.next_page_url : '/collectfeed?page=' + this.current_page

      axios.get(url2).then(({ data }) => {

        data.data.forEach( (post) => {
            this.$store.commit('add_posts', post)
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
      return this.$store.getters.all_posts
    },

    newposts() {
      return this.$store.getters.new_posts
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
