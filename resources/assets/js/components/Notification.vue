<template>
      <div>

      </div>
</template>

<script>
      export default {
            mounted() {
                  this.listen()
            },
            props: ['id'],
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

                                  document.getElementById("noty_audio").play();
                                  //$('#noty_audio').play();
                                  //document.getElementById("noty_audio").muted = false;
                            })
                  }
            }
      }
</script>