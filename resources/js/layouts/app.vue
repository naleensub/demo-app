<template>
	<div class="container">
		<div class="row">
			<div class="col alert alert-secondary"><h3>Search Images</h3> </div>
		</div>

		<div if="error != ''" class="row mt-3">
			<p class="text-danger"><small>{{ error[0] }}</small></p>
		</div>
		

		<div class="row mt-3">
			<div class="col-2">
				Select Color
			</div>
			<div class="col-3">
				<select id="favcolor" name="favcolor" class="form-select" v-model="form.favcolor">
					<option selected>All</option>
					<option id="1" value="black_and_white">Black and White</option>
					<option id="2" value="black">Black</option>
					<option id="3" value="white">White</option>
					<option id="4" value="yellow">Yellow</option>
					<option id="5" value="orange">Orange</option>
					<option id="6" value="red">Red</option>
					<option id="7" value="purple">Purple</option>
					<option id="8" value="magenta">Magenta</option>
					<option id="9" value="green">Green</option>
					<option id="10" value="teal">Teal</option>
					<option id="11" value="blue">Blue</option>
				</select>
			</div>
		</div>

		<div class="row mt-3">
			<div class="col-1">Logo </div>
			<div class="col-11 form-check"><input type="checkbox" id="chk_logo" name="chk_logo" class="form-check-input" v-model="form.chk_logo" /></div>
		</div>

		<div class="row mt-3">
			<div class="col-2">Heading Text</div> 
			<div class="col-3"><input type="text"  id="heading" name="heading" class="form-control" v-model="form.heading" /></div>
		</div>

		<div class="row mt-3">
			<div class="col-2">Website and Social Links</div>
			<div class="col-3"><input type="text"  id="ws" name="ws" class="form-control" v-model="form.ws" /> </div>
		</div>

		<div class="row mt-3">
			<div class="col"><button type="button" name="submit" id="submit" @click="checkPhotos" class="btn btn-primary"> Display</button></div>
		</div>
	

		<div class="row mt-3" v-for="photo in photos.results" :key="photo.id">
			<div class="col"><img v-bind:src="photo.urls.regular" v-bind:alt="photo.alt_description"/></div>
		</div>

		<!--pagination-->
		<!--<Bootstrap5Pagination
		      :data="photos"
		      @pagination-change-page="checkPhotos"
		  />-->
  		<!--ends-->	

	</div>
	

</template>

<script>
	import { ref, reactive, onMounted } from 'vue';
	import axios from 'axios';
	//import { Bootstrap5Pagination } from 'laravel-vue-pagination';

	export default{
		setup() {
			const photos = ref([]);
			const error = ref([]);

			const form = reactive({
				favcolor:'',
				chk_logo: '',
				heading: '',
				ws: ''
			});

			const checkPhotos = async() => {
				try{
					let res = await axios.post('/api/photos', form);
					if(res.status==200){
						photos.value = res.data;
						error.value = '';

						if(res.data.total == 0){
							var nodata =[];
							nodata.push('No Data found, Please try another search option');
							error.value = nodata;
						}
					}
					console.log('try');				
				} catch(e) {
					if(e.response.status == 422){
						console.log('catch');
						console.log(e.response.data.error);
						var data =[];
						//for(const key in e.response.data.errors){
							//data.push(e.response.data.errors[key][0]);
						//}

						data.push(e.response.data.error);
						error.value = data;
					}
				}
			}

			//onMounted(checkPhotos());

			return {
				photos,
				form,
				checkPhotos,
				error,
			}
		}		
	}
</script>