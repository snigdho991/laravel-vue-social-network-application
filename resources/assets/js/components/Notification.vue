<template>
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
              <notification-item v-for="unread in unreadNots" :unread="unread" :key="unread.id"></notification-item>          
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
</template>

<script>
      import NotificationItem from './NotificationItem.vue';

      export default {
            mounted() {
                  this.listen()
            },
            props: ['id', 'unreads'],
            components: {NotificationItem},
            data() {
              return {
                unreadNots: this.unreads
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
                                  let newUnreadNotifications = {data: { thread: notification.message, user: notification.name } };
                                  this.unreadNots.push(newUnreadNotifications);
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