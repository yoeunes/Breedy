Vue.component('color-team-configuration', {
    props: ['team', 'user'],

    data() {
        return {
            form: new SparkForm({
                name_color: null
            }),
            updateColorForm: new SparkForm({
                name_color: null
            }),
            deleteColorForm: new SparkForm({}),
            colors: [],
            loading: true,
            errored: false,
            dialogUpdateColorVisible: false,
            dialogDeleteColorVisible: false,
            updatingColor: null,
            deletingColor: null
        };
    },

    created() {

        var self = this;

        this.getColors();

        this.$on('updateColorsConfiguration', function() {
            self.getColors();
        });

    },

    computed: {

        /**
         * Get the URL for updating a type.
         */
        urlForUpdating: function() {
            return `/settings/${Spark.teamsPrefix}/${this.team.id}/colors/${this.updatingColor.id}`
        },

        urlForDeleting: function() {
            return `/settings/${Spark.teamsPrefix}/${this.team.id}/colors/${this.deletingColor.id}`
        }
    },

    methods: {
        getColors() {
            axios.get(`/settings/${Spark.teamsPrefix}/colors`, this.form)
                .then(response => {
                    this.colors = response.data;
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
            Spark.post(`/settings/${Spark.teamsPrefix}/${this.team.id}/colors/`, this.form)
                .then(response => {
                    this.form.name_color = null;
                    this.$emit('updateColorsConfiguration')
                });
        },

        /**
         * Edit the given type
         */
        editColor(color) {
            this.updatingColor = color;
            this.updateColorForm.name_color = color.name_color;

            this.dialogUpdateColorVisible = true;
        },

        /**
         * Update the type
         */
        update() {
            Spark.put(this.urlForUpdating, this.updateColorForm)
                .then(response => {
                    this.$emit('updateColorsConfiguration');
                    this.dialogUpdateColorVisible = false;
                    this.$message({
                        message: this.$t('Le nom de votre couleur/robe a été correctement mis à jour.'),
                        type: 'success'
                    });
                });
        },

        /*
         * Delete the given type
         */
        deleteColor(color) {
            this.deletingColor = color;

            this.dialogDeleteColorVisible = true;
        },


        /**
         * Delete the current type
         */
        destroyColor() {
            Spark.delete(this.urlForDeleting, this.deleteColorForm)
                .then(() => {
                    this.$emit('updateColorsConfiguration');
                    this.dialogDeleteColorVisible = false;
                    this.$message({
                        message: this.$t('La couleur/robe a été correctement supprimée.'),
                        type: 'success'
                    });
                });
        }
    }
});