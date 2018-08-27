<template>
	<div class="">
        <div class="btn-view__container-title">
            <h2 role="heading" aria-level="2" class="animal-title">Carte d'identité</h2>
            <el-dropdown>
				<button class="btn-view-more">
					<i class="el-icon-more"></i>
				</button>
				<el-dropdown-menu slot="dropdown">
					<el-dropdown-item>Modifier</el-dropdown-item>
				</el-dropdown-menu>
			</el-dropdown>
        </div>
        <table class="animal-profile__table">
            <tr>
                <td>
                     <!-- Name full -->
                    <div class="animal__row-bloc">
                        <span class="animal__label">{{this.$t('labels.name_full')}}</span>
                        <span class="animal__input">{{ animal.name_full }}</span>
                    </div>
                </td>
                <td>
                    <!-- Name domestic -->
                    <div class="animal__row-bloc">
                        <span class="animal__label">{{this.$t('labels.name_domestic')}}</span>
                        <span class="animal__input">{{ animal.name_domestic }}</span>
                    </div>
                </td>
            </tr>

            <tr>
                <td>
                    <!-- Date of birth -->
                    <div class="animal__row-bloc">
                        <span class="animal__label">{{this.$t('labels.date_of_birth')}}</span>
                        <span class="animal__input">{{ this.filterDateLocale(animal.date_of_birth) }}</span>
                    </div>
                </td>
                <td>
                    <!-- Date of death -->
                    <div v-if="animal.date_of_death !== null" class="animal__row-bloc">
                        <span class="animal__label">{{this.$t('labels.date_of_death')}}</span>
                        <span class="animal__input">{{ this.filterDateLocale(animal.date_of_death) }}</span>
                    </div>

                    <!-- Sterilized -->
                    <div v-else class="animal__row-bloc">
                        <span class="animal__label">{{this.$t('labels.sterilized')}}</span>
                        <span class="animal__input">{{ this.formatSterilized() }}</span>
                    </div>  
                </td>
            </tr>

            <tr>
                <td>
                    <!-- Identification number -->
                    <div class="animal__row-bloc">
                        <span class="animal__label">{{this.$t('labels.id_number')}}</span>
                        <span class="animal__input">{{ animal.id_number }}</span>
                    </div>
                </td>
                <td>   
                    <!-- Identification number 2 -->
                    <div v-if="animal.id_number_2 !== null" class="animal__row-bloc">
                        <span class="animal__label">{{this.$t('labels.id_number_2')}}</span>
                        <span class="animal__input">{{ animal.id_number_2 }}</span>
                    </div>
                </td>
            </tr>
        </table>
	</div>
</template>

<script>
    export default {
        name: "infosAdoption",
        props: ['animal'],
        data(){
            return {
    
            }
        },
        
        methods: {
            filterDateLocale(date) {
					if (Laravel.locale == 'fr') {
						return moment(date).format('LL');
					} else {
						return moment(date).format('LL');
					}
            },

            formatSterilized(){
                if(this.animal.sterilized == 0) {
                    return this.$t('Non')
                }else{
                    return this.$t('Oui')
                }
            }
        }
    }
</script>

<style scoped>

</style>
