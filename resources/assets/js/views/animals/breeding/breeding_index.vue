<template>
  <div>
    <div class="breadcrumb__container">
			<el-breadcrumb separator="/">
				<el-breadcrumb-item :to="{ name: 'dashboard' }">
					{{ $t('Dashboard') }}
				</el-breadcrumb-item>
				<el-breadcrumb-item>{{ $t('Animaux à l’élevage')}}</el-breadcrumb-item>
			</el-breadcrumb>
		</div>

		<div class="containerRouterLeft">
			<div class="blocTitle">
				<div class="blocTitle__wrapperTitle">
					<h2 class="blocTitle__title">{{$t('Liste des animaux destinés à l\'élevage')}}</h2>
					<span class="blocTitle__count"><strong>{{ animals.total }}</strong> {{$t('results')}}</span>
				</div>
				<div class="blocTitle__wrapperBtns">
					<el-button type="primary"
										 @click="dialogCreateAnimalBreeding = true"
										 icon="el-icon-plus">
						{{ $t('Add a animal')}}
					</el-button>
				</div>
			</div>

			<el-row v-if="types.length >= 0 && races.length >= 0 && colors.length >= 0" style="margin-top: 20px;">
				<el-col :span="3" v-if="types.length > 1" style="margin-right: 10px;">
					<el-select clearable
										 style="width: 100%"
										 placeholder="Type"
										 v-model="filterByType"
										 @change="getAnimals" filterable default-first-option>
						<el-option v-for="type in types"
											 :key="type.id"
											 :value="type.id"
											 :label="type.name">
						</el-option>
					</el-select>
				</el-col>
				<el-col :span="3" v-if="races.length > 1" style="margin-right: 10px;">
					<el-select clearable
										 style="width: 100%"
										 placeholder="Race"
										 v-model="filterByRace"
										 @change="getAnimals" filterable default-first-option>
						<el-option v-for="race in races"
											 :key="race.id"
											 :value="race.id"
											 :label="race.name_race">
						</el-option>
					</el-select>
				</el-col>
				<el-col :span="3" v-if="colors.length > 1">
					<el-select clearable
										 style="width: 100%"
										 placeholder="Couleur"
										 v-model="filterByColor"
										 @change="getAnimals" filterable default-first-option>
						<el-option v-for="color in colors"
											 :key="color.id"
											 :value="color.id"
											 :label="color.name_color">
						</el-option>
					</el-select>
				</el-col>
			</el-row>

			<el-table 	:data="animals.data"
									v-loading="loading"
									style="width: 100%;">
				
				<el-table-column prop="id_number" label="N° d’identification">
				</el-table-column>

				<el-table-column prop="name_full" label="Nom d’élevage">
				</el-table-column>
				
				<el-table-column prop="type.name" v-if="types.length > 1" label="Type">
				</el-table-column>
				
				<el-table-column prop="race.name_race" v-if="races.length > 1" label="Race">
				</el-table-column>
				
				<el-table-column prop="color.name_color" v-if="colors.length > 1" label="Couleur">
				</el-table-column>

				<el-table-column prop="date_of_birth" :formatter="filterDateToAge" label="Âge">
				</el-table-column>
				
				<el-table-column prop="sex" label="Sexe">
				</el-table-column>
				
				<el-table-column label="Opérations" width="120px">
					<template slot-scope="scope">
						<el-button icon="el-icon-view" size="mini"></el-button>
					</template>
				</el-table-column>
			</el-table>

			<div class="pagination">
				<el-pagination
								prop="animals"
								v-if="animals.total > 20"
								layout="prev, pager, next"
								:disabled="this.loading"
								:page-size="animals.per_page"
								@current-change="handleCurrentChange"
								:current-page="animals.current_page"
								background
								:total="animals.total">
				</el-pagination>
			</div>
		</div>
		<el-dialog :visible.sync="dialogCreateAnimalBreeding"
							 custom-class="createAnimal"
							 :lock-scroll="true">
			
			<span slot="title" class="el-dialog__title">
				Créer un animal destiné à l’élevage
			</span>
			
			<el-form label-position="top">
								<el-row :gutter="20">
					<!-- N° d’identification 1 -->
					<el-col :span="12">
						<el-form-item label="temp"
													prop="id_number"
													:rules="{ required: true, message: this.$t('validation.required', {attribute: this.$t('id_number')}), trigger: ['blur'] }"
													:error="createForm.errors.get('id_number')">
							<span slot="label">{{ $t('labels.id_number') }}
								<el-popover class="item"
														width="300"
														content="Le numéro d’identification correspond au numéro de puce, de tatouage,… Si l’animal n’en possède pas, vous pouvez le générer."
														trigger="hover"
														placement="top">
									<i class="el-icon-question" slot="reference"></i>
								</el-popover>
							</span>
							<div class="el-input__container">
								<el-input v-model="createForm.id_number" name="id_number" id="id_number"></el-input>
								<el-button icon="el-icon-refresh" @click="generateNumber" class="generateNumberBtn" size="mini"
													 circle></el-button>
							</div>
						</el-form-item>
					</el-col>
					<!-- Nom d’élevage -->
					<el-col :span="12">
						<el-form-item label="temp"
													prop="name_full"
													:error="createForm.errors.get('name_full')" required>
							
							<!-- Tooltip + Label -->
							<span slot="label">{{$t('labels.name_full')}}
								<el-popover class="item"
														width="300"
														content="Si l’animal n’a pas de nom, donnez-lui un nom que vous pourrez facilement reconnaître. C’est utile pour pouvoir le retrouver facilement."
														trigger="hover"
														placement="top">
									<i class="el-icon-question" slot="reference"></i>
								</el-popover>
							</span>
							
							<el-input v-model="createForm.name_full" name="name_full" id="name_full"></el-input>
						</el-form-item>
					</el-col>
					<!-- Père -->
					<el-col :span="12">
						<el-form-item label="temp">
							<span slot="label">{{$t('labels.father_id')}}
								<el-popover class="item"
														width="300"
														content="Vous pouvez rechercher le père de cet animal par nom ou numéro d’identification."
														trigger="hover"
														placement="top">
									<i class="el-icon-question" slot="reference"></i>
								</el-popover>
							</span>
							<el-select
											v-model="createForm.father_id"
											filterable
											remote
											clearable
											placeholder="Entrez un nom, un numéro,…"
											:remote-method="getFathers"
											:loading="loading"
											style="width: 100%;">
								<el-option
												v-for="item in father_results"
												style="height: auto;"
												:label="item.name_full"
												:value="item.id"
												:key="item.id">
									<span style="display: inline-block; float: left;">{{ item.name_full }}</span>
									<div style="color: #8492a6; font-size: 13px;">&nbsp;-&nbsp;{{ item.id_number }}</div>
								</el-option>
							</el-select>
						</el-form-item>
					</el-col>
					<!-- Mère -->
					<el-col :span="12">
						<el-form-item label="temp">
							<span slot="label">{{$t('labels.mother_id')}}
								<el-popover class="item"
														width="300"
														content="Vous pouvez rechercher la mère de cet animal par nom ou numéro d’identification."
														trigger="hover"
														placement="top">
									<i class="el-icon-question" slot="reference"></i>
								</el-popover>
							</span>
							<el-select
											v-model="createForm.mother_id"
											filterable
											remote
											clearable
											placeholder="Entrez un nom, un numéro,…"
											:remote-method="getMothers"
											:loading="loading"
											style="width: 100%;">
								<el-option
												v-for="item in mother_results"
												:label="item.name_full"
												:value="item.id"
												:key="item.id">
									<span style="float: left;">{{ item.name_full }}</span>
									<span style="float: right; color: #8492a6; font-size: 13px;">{{ item.id_number }}</span>
								</el-option>
							</el-select>
						</el-form-item>
					</el-col>
					<!-- Type d’animal -->
					<el-col :span="12" v-if="types.length > 1">
						<el-form-item label="Type"
													prop="type_id"
													:error="createForm.errors.get('type_id')" required>
							
							<el-select
											v-model="createForm.type_id"
											name="type_id"
											id="type_id"
											placeholder="Sélectionnez un type"
											style="width: 100%;"
											filterable>
								<el-option v-for="type in types"
													 :label="type.name"
													 :value="type.id"
													 :key="type.id">
								</el-option>
							</el-select>
						</el-form-item>
					</el-col>
					<!-- Race -->
					<el-col :span="12">
						<el-form-item label="Race"
													prop="race_id"
													:error="createForm.errors.get('race_id')" required>
							<el-select v-model="createForm.race_id"
												 allow-create
												 default-first-option
												 placeholder="Sélectionnez ou créez une race"
												 style="width: 100%;"
												 filterable>
								<el-option v-for="race in races"
													 :label="race.name_race"
													 :value="race.id"
													 :key="race.id">
								</el-option>
							</el-select>
						</el-form-item>
					</el-col>
					<!-- Couleur -->
					<el-col :span="12">
						<el-form-item label="temp">
							<span slot="label">
								{{$t('labels.name_color')}}
								<el-select v-model="createForm.color_id"
													 placeholder="Sélectionnez ou créez une couleur/robe"
													 style="width: 100%;"
													 allow-create
													 default-first-option
													 clearable
													 filterable>
									<el-option v-for="color in colors"
														 :label="color.name_color"
														 :value="color.id"
														 :key="color.id">
									</el-option>
								</el-select>
							</span>
						</el-form-item>
					</el-col>
					<!-- Sexe -->
					<el-col :span="12">
						<el-form-item label="temp"
													prop="sex"
													:error="createForm.errors.get('sex')" required>
							<span slot="label">
								{{$t('labels.sex')}}
								<el-select v-model="createForm.sex"
													 name="sex"
													 id="sex"
													 placeholder="Sélectionnez le sexe"
													 style="width: 100%;"
													 filterable>
									<el-option v-for="sex in sexe"
														 :label="sex.label"
														 :value="sex.value"
														 :key="sex.value">
									</el-option>
								</el-select>
							</span>
						</el-form-item>
					</el-col>
					<!-- Date de naissance -->
					<el-col :span="12">
						<el-form-item label="temp"
													prop="date_of_birth"
													:error="createForm.errors.get('date_of_birth')" required>
							<span slot="label">{{$t('labels.date_of_birth')}}
								<el-date-picker
												type="date"
												v-model="createForm.date_of_birth"
												:picker-options="{firstDayOfWeek: 1}"
												format="dd/MM/yyyy"
												value-format="yyyy/MM/dd"
												style="width: 100%;"
												placeholder="Choisissez un jour">
								</el-date-picker>
							</span>
						</el-form-item>
					</el-col>
				</el-row>

				<!--Informations complémentaires -->
				<el-row :gutter="20" v-if="createForm.dialogMoreFieldsBreedingIsVisible == true">
					<h3 class="title__subtitle">{{$t('Fill in additional informations')}} de {{animals.name_full}}</h3>
					<!-- Nom domestique -->
					<el-col :span="12">
						<el-form-item label="temp"
													prop="name_domestic"
													:error="createForm.errors.get('name_domestic')">
							<span slot="label">
								{{$t('labels.name_domestic')}}
							</span>
							<el-input v-model="createForm.name_domestic" name="name_domestic" id="name_domestic"></el-input>
						</el-form-item>
					</el-col>
					<!-- N° d’identification 2 -->
					<el-col :span="12">
						<el-form-item label="temp"
													prop="id_number_2"
													:error="createForm.errors.get('id_number_2')">
							<span slot="label">{{$t('labels.id_number_2')}}
								<el-popover class="item"
														width="300"
														content="N° d’identification supplémentaire. Le numéro peut correspondre au numéro de puce, de tatouage,…"
														trigger="hover"
														placement="top">
									<i class="el-icon-question" slot="reference"></i>
								</el-popover>
							</span>
							<el-input v-model="createForm.id_number_2" name="id_number_2" id="id_number_2"></el-input>
						</el-form-item>
					</el-col>
					<!-- Date de décès -->
					<el-col :span="12">
						<el-form-item label="temp"
													prop="date_of_death"
													:error="createForm.errors.get('date_of_death')">
							<span slot="label">
								{{$t('labels.date_of_death')}}
								<el-date-picker
												type="date"
												v-model="createForm.date_of_death"
												:picker-options="{firstDayOfWeek: 1}"
												format="dd/MM/yyyy"
												value-format="yyyy/MM/dd"
												style="width: 100%;"
												placeholder="Choisissez un jour">
								</el-date-picker>
							</span>
						</el-form-item>
					</el-col>
					<!-- Stezilized -->
					<el-col :span="12">
						<el-form-item label="temp"
													prop="sterilized"
													:error="createForm.errors.get('sterilized')">
							<span slot="label">
								{{$t('labels.sterilized')}}
								<el-select v-model="createForm.sterilized"
													 name="sterilized"
													 id="sterilized"
													 placeholder="Sélectionnez la réponse"
													 style="width: 100%;"
													 filterable>
									<el-option v-for="sterilized in sterilizeds"
														 :label="sterilized.label"
														 :value="sterilized.value"
														 :key="sterilized.value">
									</el-option>
								</el-select>
							</span>
						</el-form-item>
					</el-col>
					<!-- Notes -->
					<el-col :span="24">
						<el-form-item label="Notes">
							<el-input type="textarea"
												v-model="createForm.notes"
												placeholder="Informations supplémentaires,..."
												rows="5"></el-input>
						</el-form-item>
					</el-col>
				</el-row>
				<el-button
								type="primary"
								:loading="createForm.busy"
								@click.prevent="store"
								class="center">
					<span v-if="createForm.busy">{{$t('Creation in progress')}}</span>
					<span v-else>{{$t('Create')}}</span>
				</el-button>
				<el-button
						v-if="createForm.dialogMoreFieldsBreedingIsVisible == false"
						type="text"
						size="small"
						:disabled="createForm.busy"
						@click="createForm.dialogMoreFieldsBreedingIsVisible = true">
				<span>{{$t('Fill in additional informations')}}</span>
				</el-button>
			</el-form>
		
		
		</el-dialog>
  </div>
</template>

<script>

  export default{
	props: ['currentTeam'],
	data() {
		return {
			animals: [],
			createForm: new SparkForm({
				id_number: '',
				id_number_2: '',
				name_full: '',
				name_domestic: '',
				category: '',
				date_of_birth: '',
				date_of_death: '',
				sex: '',
				color: '',
				father_id: '',
				mother_id: '',
				type_id: '',
				race_id: '',
				color_id: '',
				dialogMoreFieldsBreedingIsVisible: false
			}),
			types: [],
			races: [],
			colors: [],
			mother_results: [],
			father_results: [],
			sexe: [
				{value: 'male', label: 'Male'},
				{value: 'female', label: 'Female'},
				{value: 'unknown', label: 'Unknown'}
			],
			sterilizeds: [
				{value: '0', label: 'Non'},
				{value: '1', label: 'Oui'}
			],
			loading: true,
			errored: false,
			dialogCreateAnimalBreeding: false,
							filterByType: "",
							filterByRace: "",
							filterByColor: ""

			}
		},

		mounted () {
			 var self = this;

						this.getTypes();
						this.getRaces();
						this.getColors();

            this.getAnimals();
            this.$on('updateListAnimalsBreeding', () => {
                self.getAnimals()
            })
		},

		methods: {

			/**Get List of Animals **/
			getAnimals() {
				axios.get('/animals/breedings',
					{params:
						{
							color: this.filterByColor,
							race: this.filterByRace,
							type: this.filterByType
						},
					})
				.then(response => {
					this.animals = response.data;
				})
				.catch(error => {
					console.log(error)
					this.errored = true
				})
				.finally(() => this.loading = false)
				},
			
			getTypes() {
                axios.get(`/settings/team/create-type`)
                    .then(response => {
                        this.types = response.data;
                    });
            },

            getRaces() {
                axios.get(`/settings/${Spark.teamsPrefix}/races`)
                    .then(response => {
                        this.races = response.data;
                    });
            },

            getColors() {
                axios.get(`/settings/${Spark.teamsPrefix}/colors`)
                    .then(response => {
                        this.colors = response.data;
                    });
			},
			
			/**
             * Store a new animal
             */
            store() {
                // If team has only one type
                if (this.types.length == 1) {
                    this.createForm.type_id = this.types[0].id
                }

                Spark.post('animals/breedings', this.createForm)
                    .then(response => {
                        this.dialogCreateAnimalBreeding = false;
                        this.$message({message: 'L’animal a été correctement ajouté.', type: 'success'});
                        this.$emit('updateListAnimalsBreeding');

                        // Reset form
                        this.createForm.id_number = '';
                        this.createForm.id_number_2 = '';
                        this.createForm.name_full = '';
                        this.createForm.name_domestic = '';
                        this.createForm.date_of_birth = '';
                        this.createForm.date_of_death = '';
                        this.createForm.sex = '';
                        this.createForm.color = '';
                        this.createForm.father_id = '';
                        this.createForm.mother_id = '';
                        this.createForm.type_id = '';
                        this.createForm.race_id = '';
                        this.createForm.color_id = '';

                        this.getRaces();
                        this.getColors();

                    });
			},

			/**
             * Handle change page for pagination
             * @param val
             */
            handleCurrentChange(val) {
                this.loading = true;
                axios.get(`animals/breedings?page=${val}&color=${this.filterByColor}&race=${this.filterByRace}&type=${this.filterByType}`)
                    .then(response => {
                        this.animals = response.data
                    })
                    .catch(error => {
                        console.log(error);
                        this.errored = true;
                    })
                    .finally(() => {
                        this.loading = false;
                        window.scrollTo(0, 0);
                    })
            },
			
			/* Convert current date to locale format date*/
            filterDateLocale(row, column) {
                if (Laravel.locale == 'fr') {
                    return moment(row.date_of_birth).format('DD/MM/YYYY');
                } else {
                    return moment(row.date_of_birth).format('YYYY/MM/DD');
                }
            },

				
			/** Convert date_of_birth to Age **/
        	filterDateToAge(row, column) {
                return this.displayAge(row.date_of_birth, moment())
			},
			/**
             * Get mothers for select create animal
             */

            getMothers(searchmother) {
                if (searchmother.length > 2) {
                    this.loading = true;
                    setTimeout(() => {
                        this.loading = false;
                        axios.get('animals/searchMothers', {params: {searchmother: searchmother}})
                            .then(response => {
                                this.mother_results = response.data;
                            });
                    }, 300);
                }
            },

            /**
             * Get fathers for select create animal
             */

            getFathers(searchfather) {
                if (searchfather.length > 2) {
                    this.loading = true;
                    setTimeout(() => {
                        this.loading = false;
                        axios.get('animals/searchFathers', {params: {searchfather: searchfather}})
                            .then(response => {
                                this.father_results = response.data;
                            });
                    }, 300);
                }
			},
			
			/**
             * Generate a id_number aleatory
             */
            generateNumber() {
                // Get current team name
                let teamName = this.currentTeam.name;
                // Get all first letters of teamName
                let acronym = teamName.split(/\s/).reduce((response, word) => response += word.slice(0, 1), '');
                // Remove all accents of acronym teamName
                let removeAllAccents = acronym.normalize('NFD').replace(/[\u0300-\u036f]/g, "");
                // Uppercase teamName formatted
                let teamNameFormatted = removeAllAccents.toUpperCase();

                // Create random number with 5 digits
                let randomNumber = Math.floor(Math.random() * 90000) + 10000;

                this.createForm.id_number = teamNameFormatted + '-' + randomNumber;
            }
		}
  }
</script>

