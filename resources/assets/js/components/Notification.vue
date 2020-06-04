<template>
  
  <ul class="nav navbar-nav navbar-right main-menu">
              
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Timeline <span><img src="public/app/images/down-arrow.png" alt="" /></span></a>
        <ul class="dropdown-menu login">
          <li><a href="">Timeline</a></li>
          <li><a href="timeline-about.html">Timeline About</a></li>
          <li><a href="timeline-album.html">Timeline Album</a></li>
          <li><a href="timeline-friends.html">Timeline Friends</a></li>
          <li><a href="">Basic Info</a></li>
          
          <li><a href="edit-profile-work-edu.html">Edit: Work</a></li>
          <li><a href="edit-profile-interests.html">Edit: Interests</a></li>
          <li><a href="edit-profile-settings.html">Account Settings</a></li>
          <li><a href="edit-profile-password.html">Change Password</a></li>
        </ul>
      </li>

      <li class="dropdown">
          <a v-if="Object.keys(unreadReqs).length === 0" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-users fa-2x" style="color: #fff"></i>
          </a>

          <a v-else href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-users fa-2x" style="color: #fff"></i>
            <span class="badge" style="background: #fa3e3e; position: relative; top: -16px; left: -11px;"> {{ Object.keys(unreadReqs).length }} </span>
          </a>

        <!-- <ul class="dropdown-menu" style="min-width: 500px; margin-right: 27px;"> 
            <span v-if="unreadNots.length !== 0">
                <friend-item v-for="unreads in unreadNots" :unreads="unreads" :key="unreads.id"></friend-item>          
            </span>
            
            <span v-else>
                <li style="padding: 15px 0px; border-top: 1px solid rgba(255,255,255, 0.1); border-bottom: 0px; background: #222;">
                    <span style="color: #fff; margin-left: 17px;">No unread notifications.</span>
                </li>          
            </span>
            
                  <li class="text-center" style="padding: 15px 0px; border-top: 1px solid rgba(255,255,255, 0.1); border-bottom: 0px;"><a href="/requests" style="color: #27aae1;">
              See all notifications</a></li>
        </ul> -->
      </li>

      <li class="dropdown" @click="mark_notification_as_read()" >
          <a v-if="unreadNots.length === 0" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-bell fa-2x" style="color: #fff"></i>
          </a>

          <a v-else href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-bell fa-2x" style="color: #fff"></i>
            <span class="badge" style="background: #fa3e3e; position: relative; top: -16px; left: -11px;"> {{ unreadNots.length }} </span>
          </a>

          <ul class="dropdown-menu" style="min-width: 500px; margin-right: 27px;"> 
              <span v-if="unreadNots.length !== 0">
                  <notification-item v-for="unreads in unreadNots" :unreads="unreads" :key="unreads.id"></notification-item>          
              </span>
              
              <span v-else>
                  <li style="padding: 15px 0px; border-top: 1px solid rgba(255,255,255, 0.1); border-bottom: 0px; background: #222;">
                      <span style="color: #fff; margin-left: 17px;">No unread notifications.</span>
                  </li>          
              </span>
              
                    <li class="text-center" style="padding: 15px 0px; border-top: 1px solid rgba(255,255,255, 0.1); border-bottom: 0px;"><a href="/notifications" style="color: #27aae1;">
                See all notifications</a></li>
          </ul>
      </li>

      <li class="dropdown"><a href="/logout">Logout</a></li>

  </ul>
  
</template>

<script>
      import NotificationItem from './NotificationItem.vue';

      export default {
            mounted() {
                  this.listen()
            },
            props: ['id', 'unreads', 'unseen'],
            components: {NotificationItem},
            data() {
              return {
                unreadNots: this.unreads,
                unreadReqs: this.unseen,
                
              }
            },

            methods: {
              listen() {
                        Echo.private('App.User.' + this.id)
                            .notification( (notification) => {
                                new Noty({ 
                                      type:'success', 
                                      layout:'bottomLeft', 
                                      text: notification.name + notification.message, 
                                      timeout: 5000
                                  }).show()
                                  
                                  this.$store.commit('add_nots', notification);

                                  document.getElementById("noty_audio").play();
                                  //$('#noty_audio').play();
                                  //document.getElementById("noty_audio").muted = false;
                                  let newUnreadNotifications = {data: { name: notification.name, message: notification.message } };
                                  this.unreadNots.push(newUnreadNotifications);

                                  if (notification.message === " has just sent a friend request to you.") {
                                      let newUnreadRequests = {data: { name: notification.name, message: notification.message } };
                                      this.unreadReqs.push(Object.assign({}, this.newUnreadRequests));
                                    
                                  }
                        })
                  },

                  mark_notification_as_read() {
                      if (this.unreadNots.length) {
                          axios.get('/mark_notification_as_read');
                      }
                  }
            }
      }
</script>