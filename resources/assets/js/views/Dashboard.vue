<template>
	<div :user="user" :current-team="currentTeam">
		<div class="containerRouterLeft">
			<h2 aria-level="2" role="heading" class="dashboard__title">Bienvenue sur votre élevage, <span>{{ currentTeam.name }}</span> !</h2>

			<el-row class="el-bloc__margin" type="flex">
				<el-col :span="8" class="el-bloc__bloc mr25 dashboard__bloc">
					<h2 role="heading" aria-level="2" class="animal-title dashboard__subtitle">Nombre d'animaux en adoption(s)</h2>
					<span class="dashboard__number">66</span>
					<router-link :to="{ name: 'adoption' }">
						<el-button type="info" plain size="medium">Voir la liste</el-button>
					</router-link>
				</el-col>

				<el-col :span="8" class="el-bloc__bloc mr25 dashboard__bloc">
					<h2 role="heading" aria-level="2" class="animal-title dashboard__subtitle">Nombre d'animaux en élevages(s)</h2>
					<span class="dashboard__number">52</span>
					<router-link :to="{ name: 'breeding' }">
						<el-button type="info" plain size="medium">Voir la liste</el-button>
					</router-link>
				</el-col>

				<el-col :span="8" class="el-bloc__bloc mr25 dashboard__bloc">
					<h2 role="heading" aria-level="2" class="animal-title dashboard__subtitle">Nombre d'élevages(s)</h2>
					<span class="dashboard__number">4</span>
				</el-col>
			</el-row>
			
		</div>
	</div>
</template>


<script>
    export default {
        name: "dashboard",
        props: ['user', 'current-team'],
        data(){
            return {
				animals: [],
				adoption_result: []
    
            }
		},
		
		mounted() {

			this.getAnimalAdoption();
			
		},

		methods:{

			getAnimalAdoption(searchAnimalAdoption){
				axios.get('/v1#/dashboard/searchAnimalAdoption')
					.then(response => {
						this.adoption_result = response.data;
					});
			}
		}
    }
</script>
