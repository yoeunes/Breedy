/*
 |--------------------------------------------------------------------------
 | Laravel Spark Bootstrap
 |--------------------------------------------------------------------------
 |
 | First, we will load all of the "core" dependencies for Spark which are
 | libraries such as Vue and jQuery. This also loads the Spark helpers
 | for things such as HTTP calls, forms, and form validation errors.
 |
 | Next, we'll create the root Vue application for Spark. This will start
 | the entire application and attach it to the DOM. Of course, you may
 | customize this script as you desire and load your own components.
 |
 */

require('spark-bootstrap');
require('./components/bootstrap');

import Element from "element-ui";
import locale from "element-ui/lib/locale/lang/fr";
import router from './routes/router';
import Vuex from 'vuex';
import vuexI18n from 'vuex-i18n';
import Locales from './vue-i18n-locales.generated.js';
import displayAge from './components/mixins/displayAge';
import helpers from './components/mixins/helpers';

// Config multilangue
const store = new Vuex.Store();
Vue.use(vuexI18n.plugin, store);
Vue.i18n.add('en', Locales.en);
Vue.i18n.add('fr', Locales.fr);
Vue.i18n.set(Laravel.locale);
moment.locale(Laravel.locale);

// Auth components
import SelectCountry from "./components/auth/SelectCountry.vue";
import PasswordFields from "./components/auth/PasswordFields.vue";
// Views components
import Dashboard from './views/Dashboard.vue';

Vue.use(Element, { locale });
Vue.mixin(displayAge);
Vue.mixin(helpers);

// Components
Vue.component('SelectCountry', SelectCountry);
Vue.component('password-fields', PasswordFields);

const SparkWrapper = require('./components/settings/spark-wrapper');

Spark.forms.register = {
    firstname: '',
    lastname: '',
    country: '',
    language: ''
};


var app = new Vue({
    store,
    router,
    mixins: [require('spark')],
}).$mount(SparkWrapper, '#spark-app')
