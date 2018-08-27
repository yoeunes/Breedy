import moment from 'moment';
var base = require('settings/invoices/invoice-list');

Vue.component('spark-invoice-list', {
    computed: {

        dateInvoice: function () {
            moment.locale(Laravel.locale);
            return moment(invoices.attributes['created_at']).format('L [-] hh:mm')
        }
    },
    /*data {
        return {
            /!*locale: document.querySelector('html').getAttribute('lang');*!/
        }
    },*/
    mixins: [base],
});
