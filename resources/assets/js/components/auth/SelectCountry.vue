<template>
	<li>
		<el-option
						required
						v-for="country in countries"
						:key="country.name"
						:value="country.name"
						:label="country.translations[locale]">
		</el-option>
	</li>
</template>

<script>
    export default {
        data() {
            return {
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                countries: [],
								locale: document.querySelector('html').getAttribute('lang')
						}
        },
        methods: {
            getCountriesList: function() {
              	// https://restcountries.eu/rest/v2/all?fields=name;translations
              		delete axios.defaults.headers.common["X-CSRF-TOKEN"];
                 	axios.get('https://restcountries.eu/rest/v2/all?fields=name;translations')
										.then(response => {
                    		this.countries = JSON.parse(JSON.stringify(response.data))
									})
                    .catch(function (error) {
                        console.log(error);
                    });
            }
				},
        created: function() {
            this.getCountriesList()
        }
    }
</script>


