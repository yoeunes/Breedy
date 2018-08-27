var base = require('settings/settings');

Vue.component('spark-settings', {
    mounted() {
        var widthSettings = document.getElementById('settings-aside').offsetWidth;
        document.getElementById('settings-aside-container').style.minWidth = widthSettings + "px";
    },
    mixins: [base]
});