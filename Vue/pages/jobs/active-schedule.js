require('../../bootstrap/google-maps');

new window.App({
    el: '#app',
    data : function(){
        return {
            jobs : {
                data : [],
                loading : false,
                url : '/api/jobs/auth/active',
                total : 0
            },
            search_keyword : '',
            pagination : null
        }
    },
    methods : {
        getActiveJobs : function (keyword) {
            const vm = this;
            if(!this.jobs.url) return;

            var params = {};

            if(keyword){
                this.jobs.url = '/api/jobs/auth/active';
                params = {
                    keyword : keyword
                };
            }

            vm.jobs.loading = true;

            window.axios.get(vm.jobs.url, {params : params})
                .then(function (response) {
                    vm.jobs.data = [];

                    vm.jobs.loading = false;
                    vm.jobs.total = response.data.total;

                    response.data.data.forEach(function (job) {

                        var exists = window._.find(vm.jobs.data, function (item) {
                            return item.id === job.id;
                        });

                        if(!exists){
                            vm.jobs.data.push(job);
                        }
                    });
                    vm.pagination = response.data.links;
                });
        },
        filterJobs : _.debounce(function (newVal) {
            this.getActiveJobs(newVal);
        }, 2000),
        next: function () {
            this.jobs.url = this.pagination.next;

            this.getActiveJobs();
        },
        prev: function () {
            this.jobs.url = this.pagination.prev;

            this.getActiveJobs();
        }
    },
    mounted : function () {
        this.getActiveJobs();
    },
    watch : {
        search_keyword : function (newVal, oldVal) {
            this.filterJobs(newVal);
        }
    }
});