<template>
	<li style="padding: 15px 0px; border-top: 1px solid rgba(255,255,255, 0.1); border-bottom: 0px; background: #222;"> <a style="margin-left: 17px;text-decoration: none;" href="/notifications">{{ unreads.data.name }} {{ unreads.data.message }}</a> </li>
</template>

<script>
export default {
	props: ['unreads'],

	mounted() {
		
	}

}
</script>