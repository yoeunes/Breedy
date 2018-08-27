var base = require('settings/subscription/update-subscription');

Vue.component('spark-update-subscription', {
    mixins: [base],
    data() {
        return {
            form: {
                switch: false
            },
            dialogUpdatePlanVisible: false
        }
    },

    mounted() {
        if (this.showingMonthlyPlans) {
            this.form.switch = false;
        } else if (this.showingYearlyPlans) {
            this.form.switch = true;
        }
    },

    methods: {
        confirmPlanUpdate(plan) {
            this.confirmingPlan = plan;
            this.dialogUpdatePlanVisible = true;
        },
    }
});
