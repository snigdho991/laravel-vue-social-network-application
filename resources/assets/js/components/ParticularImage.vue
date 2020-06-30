<template>
	<li>
      <div class="img-wrapper" data-toggle="modal" :data-target="'#myModel' + image.id">
        <img :src="image.image" style="height: 192px;width: 192px;" alt="photo" />
      </div>

      <div class="modal fade" :id="'myModel' + image.id" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <img :src="image.image" style="height: 600px; width: 600px;" alt="photo" />
          </div>
        </div>
      </div>
    </li>
	    
</template>

<script>
	export default {
		mounted() {
			
		},

		props: ['image', 'user'],

		data() {
	    	return {
	    		
	    	}
	    },

		methods: {
			
		}
	}
</script>

<style lang="css" scoped>
</style>