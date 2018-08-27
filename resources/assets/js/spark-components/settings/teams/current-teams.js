var base = require('settings/teams/current-teams');

Vue.component('spark-current-teams', {
    mixins: [base],
    data: function() {
        return {
            dialogDeleteTeamVisible: false,
            dialogLeaveTeamVisible: false
        }
    },
    methods: {
        successDelete() {
            this.$message({
                message: 'L\'élevage a été supprimé.',
                type: 'success'
            });
        }
    }
});