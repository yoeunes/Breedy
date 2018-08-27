<template>
	<div class="animal-profile__bloc" v-if="animal">
		<div class="btn-view__container">
			<el-dropdown>
				<button class="btn-view-more">
					<i class="el-icon-more"></i>
				</button>
				<el-dropdown-menu slot="dropdown">
					<el-dropdown-item>Modifier</el-dropdown-item>
				</el-dropdown-menu>
			</el-dropdown>
		</div>
		<el-upload
			class="avatar-uploader"
			action="https://jsonplaceholder.typicode.com/posts/"
			:show-file-list="false">
			<img v-if="animal.owner" :src="animal.owner" class="avatar animal-profile__img">
			<img v-else-if="animal.sex == 'female'" class="animal-profile__img" src="img/default-photo-profile-female.png" srcset="img/default-photo-profile-female@2x.png 2x">
		</el-upload>
		<p v-if="animal.name_full" class="animal-profile__name">{{ animal.name_full }}</p>
		<p v-if="animal.race.name_race" class="animal-profile__race">{{ animal.race.name_race }}</p>
		<p v-if="animal.color.name_color" class="animal-profile__color">{{ animal.color.name_color }}</p>
		<p v-if="animal.date_of_death == null">{{ this.filterDateToAge() }}</p>
		<p v-else>Décédé</p>
		<img v-if="animal.sex == 'male'" src="icons/male-icon.svg" class="animal-profile__sex-svg">
		<img v-else class="animal-profile__sex-svg" src="icons/female-icon.svg">

		
	</div>
</template>

<script>
    export default {
        name: "profileAdoption",
		props: ['animal'],


		methods: {
			filterDateToAge(){
				return this.displayAge(this.animal.date_of_birth, moment())
			}
		}
    }
</script>

<style scoped>

</style>
