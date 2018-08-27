Vue.component('update-profile-details', {
   props: ['user'],

   data() {
       return {
           form: new SparkForm({
               firstname: '',
               lastname: '',
               email: '',
               country: '',
               name:''
           })
       };
   },

    mounted() {
       this.form.firstname = this.user.firstname,
       this.form.lastname = this.user.lastname,
       this.form.email = this.user.email,
       this.form.country = this.user.country,
       this.form.name = this.user.firstname + ' ' + this.user.lastname
    },

    methods: {
       update() {
           Spark.put('/settings/profile/details', this.form)
               .then(response => {
                   Bus.$emit('updateUser');
               });
       }
    }
});
