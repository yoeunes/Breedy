var base = require('settings/subscription/cancel-subscription');

Vue.component('spark-cancel-subscription', {
    mixins: [base],
    data: function () {
        return {
            dialogCancelSubscriptionVisible: false,
        }
    },
});
