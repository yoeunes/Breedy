Vue.component('update-team-profile-details', {
  props: ['user', 'team'],

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
        addInfos: ''
      })
    };
  },

  mounted() {
    this.form.name = this.team.name;
    this.form.street1 = this.team.street1;
    this.form.street2 = this.team.street2;
    this.form.city = this.team.city;
    this.form.state = this.team.state;
    this.form.zip = this.team.zip;
    this.form.country = this.team.country;
    this.form.companyName = this.team.companyName;
    this.form.companyNumber = this.team.companyNumber;
    this.form.vat = this.team.vat;
    this.form.bankAccount = this.team.bankAccount;
    this.form.bicSwift = this.team.bicSwift;
    this.form.addInfos = this.team.addInfos;
  },

  methods: {
    update() {
      Spark.put(this.urlForUpdate, this.form)
          .then(success => {
            // is success
            this.validateSuccess()
          }).catch(error => {
        // is error
        this.validateError();
      });
    },

    validateSuccess() {
      if (this.form.successful) {
        this.$message({
          message: this.$t('validation.formSuccess'),
          type: 'success'
        });
      }
    },

    validateError() {
      this.$message.error(this.$t('validation.formError'));
    }
  },

  computed: {
    /**
     * Get the URL for update profile details method update.
     */
    urlForUpdate() {
      return `/settings/${Spark.teamsPrefix}/${this.team.id}/team-profile-details`;
    }
  }
});



