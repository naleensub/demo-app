<template>
	<div>
		Components for photo for testing purpose
	</div>
</template>

<script>
	import {ref, onMounted} from 'vue';
	import axios from 'axios';

	export default{
		setup(){
			const photos = ref([]);

			const getPhotos = async() => {
				let res = await.get('api/photos')
				photos.value = res.data;
			}

			onMounted(getPhotos());

			return {
				photos
			}
		}
		
	}
</script>
