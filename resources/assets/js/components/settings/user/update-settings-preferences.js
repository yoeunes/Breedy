Vue.component('update-settings-preferences', {
    props: ['user'],

    data() {
        return {
            form: new SparkForm({
                language: ''
            }),

            languageList: [{
                value: 'fr',
                label: 'Français'
            }, {
                value: 'en',
                label: 'English'
            }]
        }
    },

    mounted() {
        this.form.language = this.user.language
    },

    methods: {
        update() {
            Spark.put('/settings/user/preferences', this.form)
                .then(response => {
                    Bus.$emit('updateSettingsPreferences');
                });
        }
    }
})
