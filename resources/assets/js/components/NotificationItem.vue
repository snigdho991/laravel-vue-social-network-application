<template>
	<li style="padding: 15px 0px; border-top: 1px solid rgba(255,255,255, 0.1); border-bottom: 0px; background: #222;"> <a style="margin-left: 17px;text-decoration: none;" href="/notifications">{{ unread.data.user }} {{ unread.data.thread }}</a> </li>
</template>

<script>
export default {
	props: ['unread'],

	mounted() {
		console.log('working')
	}

}
</script>