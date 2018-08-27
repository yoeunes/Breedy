var base = require('settings/teams/team-members');

Vue.component('spark-team-members', {
    mixins: [base],
    data: function () {
        return {
            dialogUpdateMemberVisible: false,
            dialogDeleteMemberVisible: false
        }
    },
    methods: {
        successDelete(){
            this.$message({
                message: 'Le membre a été supprimé.',
                type: 'success'
            });
        }
    }
});




