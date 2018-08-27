Vue.component('race-team-configuration', {
    props: ['team', 'user'],

    data() {
        return {
            form: new SparkForm({
                name_race: null
            }),
            updateRaceForm: new SparkForm({
                name_race: null
            }),
            deleteRaceForm: new SparkForm({}),
            races: [],
            loading: true,
            errored: false,
            dialogUpdateRaceVisible: false,
            dialogDeleteRaceVisible: false,
            updatingRace: null,
            deletingRace: null
        };
    },

    created() {

        var self = this;

        this.getRaces();

        this.$on('updateRacesConfiguration', function() {
            self.getRaces();
        });

    },

    computed: {

        /**
         * Get the URL for updating a type.
         */
        urlForUpdating: function() {
            return `/settings/${Spark.teamsPrefix}/${this.team.id}/races/${this.updatingRace.id}`
        },

        urlForDeleting: function() {
            return `/settings/${Spark.teamsPrefix}/${this.team.id}/races/${this.deletingRace.id}`
        }
    },

    methods: {
        getRaces() {
            axios.get(`/settings/${Spark.teamsPrefix}/races`, this.form)
                .then(response => {
                    this.races = response.data;
                })
                .catch(error => {
                    console.log(error)
                    this.errored = true;
                })
                .finally(() => this.loading = false);
        },

        /**
         * Store a new type
         */
        store() {
            Spark.post(`/settings/${Spark.teamsPrefix}/${this.team.id}/races/`, this.form)
                .then(response => {
                    this.form.name_race = null;
                    this.$emit('updateRacesConfiguration')
                });
        },

        /**
         * Edit the given type
         */
        editRace(race) {
            this.updatingRace = race;
            this.updateRaceForm.name_race = race.name_race;

            this.dialogUpdateRaceVisible = true;
        },

        /**
         * Update the type
         */
        update() {
            Spark.put(this.urlForUpdating, this.updateRaceForm)
                .then(response => {
                    this.$emit('updateRacesConfiguration');
                    this.dialogUpdateRaceVisible = false;
                    this.$message({
                        message: this.$t('Le nom de votre race a été correctement mis à jour.'),
                        type: 'success'
                    });
                });
        },

        /*
         * Delete the given type
         */
        deleteRace(race) {
            this.deletingRace = race;

            this.dialogDeleteRaceVisible = true;
        },


        /**
         * Delete the current type
         */
        destroyRace() {
            Spark.delete(this.urlForDeleting, this.deleteRaceForm)
                .then(() => {
                    this.$emit('updateRacesConfiguration');
                    this.dialogDeleteRaceVisible = false;
                    this.$message({
                        message: this.$t('La race a été correctement supprimée.'),
                        type: 'success'
                    });
                });
        }
    }
});