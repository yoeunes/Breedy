var base = require('settings/subscription');

Vue.component('spark-subscription', {
  mixins: [base],
  computed: {

    /**
     * Get the formatted trial ending date.
     */
    trialEndsAt() {
      if (!this.subscriptionIsOnTrial) {
        return;
      }

      if (this.onGenericTrial) {
        return moment.utc(this.billable.trial_ends_at)
            .local().format('LL');
      }

      return moment.utc(this.activeSubscription.trial_ends_at)
          .local().format('LL');
    },
  }
});
