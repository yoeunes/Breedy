var base = require('settings/subscription/resume-subscription');

Vue.component('spark-resume-subscription', {
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
