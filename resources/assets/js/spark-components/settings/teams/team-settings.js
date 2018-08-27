var base = require('settings/teams/team-settings');

Vue.component('spark-team-settings', {
    mounted(){
        var widthSettings = document.getElementById('settings-aside').offsetWidth;
        document.getElementById('settings-aside-container').style.minWidth  = widthSettings + "px";
    },
    mixins: [base]
});
