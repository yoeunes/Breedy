Vue.component('create-type-team-configuration', {
    props: ['user', 'team'],

    data() {
        return {
            form: new SparkForm({
                name: null
            }),
            updateTypeForm: new SparkForm({
                name: null
            }),
            deleteTypeForm: new SparkForm({ name: null }),
            types: [],
            loading: true,
            errored: false,
            dialogUpdateTypeVisible: false,
            dialogDeleteTypeVisible: false,
            updatingType: null,
            deletingType: null
        }
    },

    created() {
        var self = this

        this.getTypes()

        this.$on('updateTypesConfiguration', function() {
            self.getTypes()
        })
    },

    computed: {
        /**
         * Get the URL for updating a type.
         */
        urlForUpdating: function() {
            return `/settings/${Spark.teamsPrefix}/${this.team.id}/types/${this.updatingType.id}`
        },

        urlForDeleting: function() {
            return `/settings/${Spark.teamsPrefix}/${this.team.id}/types/${this.deletingType.id}`
        }
    },

    methods: {
        getTypes() {
            axios.get('/settings/team/create-type', this.form)
                .then(response => {
                    this.types = response.data
                })
                .catch(error => {
                    console.log(error)
                    this.errored = true
                })
                .finally(() => this.loading = false)
        },

        /**
         * Store a new type
         */
        store() {
            Spark.post('/settings/team/create-type', this.form)
                .then(response => {
                    this.form.name = null
                    this.$emit('updateTypesConfiguration')
                })
        },

        /**
         * Edit the given type
         */
        editType(type) {
            this.updatingType = type
            this.updateTypeForm.name = type.name

            this.dialogUpdateTypeVisible = true
        },

        /**
         * Update the type
         */
        update() {
            Spark.put(this.urlForUpdating, this.updateTypeForm)
                .then(response => {
                    this.$emit('updateTypesConfiguration')
                    this.dialogUpdateTypeVisible = false
                    this.$message({
                        message: this.$t('Votre type d’animal a été correctement mis à jour.'),
                        type: 'success'
                    });
                });
        },

        /*
         * Delete the given type
         */
        deleteType(type) {
            this.deletingType = type;

            this.dialogDeleteTypeVisible = true;
        },

        /**
         * Delete the current type
         */
        destroyType() {
            Spark.delete(this.urlForDeleting, this.deleteTypeForm)
                .then(() => {
                    this.$emit('updateTypesConfiguration')
                    this.dialogDeleteTypeVisible = false
                    this.$message({
                        message: this.$t('Votre type d’animal a été correctement supprimé.'),
                        type: 'success'
                    })
                })
        }
    }
})