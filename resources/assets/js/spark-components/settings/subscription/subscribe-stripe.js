var base = require('settings/subscription/subscribe-stripe');

Vue.component('spark-subscribe-stripe', {
    mixins: [base],
    data() {
        return {
            switchForm: {
                switch: false
            }
        }
    },

    mounted() {
        if (this.showingMonthlyPlans) {
            this.switchForm.switch = false;
        } else if (this.showingYearlyPlans) {
            this.switchForm.switch = true;
        }
    }
});
