require('../../bootstrap/google-maps');
window.accounting = require('../../../Scripts/accounting/accounting.min');

Vue.filter('currency', function (value) {
    return accounting.formatMoney(value,'£ ');
});

new window.App({
    el: '#app',
    data : function(){
        return {
            job : null,
            page : 'details'
        }
    },
    methods : {
        gotoPage : function (page) {
            if(page) this.page = page;
        }
    },
    components : {
        'gm-job-details-tab' : require('../../blocks/jobs/manage/JobDetailTab.vue'),
        'gm-job-applicants-tab' : require('../../blocks/jobs/manage/JobApplicantsTab.vue'),
    },
    watch : {

    },
    mounted : function(){
        const job_token = document.head.querySelector('meta[name="jt"]').content;

        this.job = this.$root.decodeToken(job_token).entity;
    }
});