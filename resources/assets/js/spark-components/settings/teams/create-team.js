var base = require('settings/teams/create-team');

Vue.component('spark-create-team', {
    mixins: [base],
    data() {
        return {
            form: new SparkForm({
                name: '',
                street1: '',
                street2: '',
                city: '',
                state: '',
                zip: '',
                country: '',
                companyName: '',
                companyNumber: '',
                vat: '',
                bankAccount: '',
                bicSwift: '',
                addInfos: '',
                race: '',
                type: '',
                dialogCreateTeamVisible: false,
                formCreateTeamVisible: false
            })
        }
    },

    methods: {
        create() {
            Spark.post('/settings/' + Spark.teamsPrefix, this.form)
                .then(() => {
                    this.form.name = '';
                    this.form.slug = '';
                    this.form.dialogCreateTeamVisible = false;

                    Bus.$emit('updateUser');
                    Bus.$emit('updateTeams');

                    this.$message({
                        message: 'Votre élevage a été créé avec succès.',
                        type: 'success'
                    });

                    this.form.formCreateTeamVisible = false;

                    if(window.location.href.indexOf("missing") > -1) {
                        setTimeout(function () {
                            window.location.replace(Laravel.homeUrl);
                        }, 1500);
                    }

                }).catch(error => {
                    this.form.dialogCreateTeamVisible = true;
                });
        },

        resetForm: function() {
            this.form.name = "",
            this.form.street1 = "",
            this.form.street2 = "",
            this.form.city = "",
            this.form.state = "",
            this.form.zip = "",
            this.form.country = ""
        }
    }
});
