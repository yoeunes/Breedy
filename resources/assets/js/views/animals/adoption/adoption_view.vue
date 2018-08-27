<template>
	<div>
		<div class="breadcrumb__container">
			<el-breadcrumb separator="/">
				<el-breadcrumb-item :to="{ name: 'dashboard' }">
					{{ $t('Dashboard') }}
				</el-breadcrumb-item>
				<el-breadcrumb-item :to="{ name: 'adoption'}">
					{{ $t('Animaux à l’adoption')}}
				</el-breadcrumb-item>
				<el-breadcrumb-item>
					{{ animal.name_full }}
				</el-breadcrumb-item>
			</el-breadcrumb>
		</div>
		
		<div class="containerRouterLeft">
			
			<el-row class="el-bloc__margin" type="flex">
				<el-col :span="7" class="el-bloc__bloc mr25">
					<Profile :animal="animal"></Profile>
				</el-col>
				<el-col :span="10" class="el-bloc__bloc mr25">
					<Infos :animal="animal"></Infos>
				</el-col>
				<el-col :span="7" type="flex">
					<el-row :span="24" class="el-bloc__bloc mb25">
						<Status :animal="animal"></Status>
					</el-row>
					<el-row :span="24" class="el-bloc__bloc">
						<Organisation :animal="animal"></Organisation>
					</el-row>
				</el-col>
			</el-row>

			<el-row class="el-bloc__margin" type="flex">
				<el-col class="el-bloc__bloc mr25" :span="6">
					<Father :animal="animal"></Father>
				</el-col>
				<el-col class="el-bloc__bloc mr25" :span="6">
					<Mother :animal="animal"></Mother>
				</el-col>
				<el-col class="el-bloc__bloc mr25" :span="6">
					<Spending :animal="animal"></Spending>
				</el-col>
				<el-col class="el-bloc__bloc" :span="6">
					<Earning :animal="animal"></Earning>
				</el-col>
			</el-row>
			</div>
		
	</div>
</template>

<script>
	import Profile from '../../../components/animals/adoption/profile';
	import Infos from '../../../components/animals/adoption/infos';
	import Status from '../../../components/animals/adoption/status';
	import Organisation from '../../../components/animals/adoption/organisation';
	import Father from '../../../components/animals/adoption/father';
	import Mother from '../../../components/animals/adoption/mother';
	import Spending from '../../../components/animals/adoption/spending';
	import Earning from '../../../components/animals/adoption/earning';
	export default  {
	    name: 'AdoptionView',
	    components: {
		  'Profile': Profile,
		  'Infos': Infos,
		  'Status': Status,
		  'Organisation': Organisation,
		  'Father': Father,
		  'Mother': Mother,
		  'Spending': Spending,
		  'Earning': Earning
			},
			data() {
			    return {
			        animal: [],
							loading: false
					}
			},
			
			mounted() {
				this.getAnimal();
			},
			
			methods: {
				getAnimal() {
				this.loading = true;
				axios.get(`/animals/adoptions/${this.$route.params.id}`)
										.then(response => {
										this.animal = response.data;
										})
					.catch(error => {
						console.log(error)
						this.errored = true
					})
					.finally(() => this.loading = false);
				}
			}
	}
</script>

<style lang="stylus" scoped>

</style>
