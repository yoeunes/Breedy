export default {

  computed: {

    canUseFullApp: function () {
      let currentTeam = Spark.state.currentTeam;
      let trialEnd = currentTeam.trial_ends_at;
      let isOnTrial;

      // Check if the team is on trial, return true or false
      if (trialEnd == 'null') {
        isOnTrial = false;
      } else {
        isOnTrial = moment.utc(trialEnd).isAfter(moment.utc());
      }

      // Check if the team has a plan, return true or false
      let hasPremiumPlan = currentTeam.current_billing_plan !== null

      // Return if isOnPaidPlan is true or false
      return isOnTrial == true || hasPremiumPlan == true ? true : false
    },

    laravel: function () {
      return Laravel;
    }
  }
}
