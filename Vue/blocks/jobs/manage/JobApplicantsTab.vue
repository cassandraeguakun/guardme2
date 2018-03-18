<template>
    <div class="" :class="{loading : applicants.loading}">
        <div class="white-box">
            <h3 class="box-title m-b-0">Applicants</h3>
            <p class="text-muted m-b-20">{{ applicants.total }} applicant(s) were found on this job.</p>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Date</th>
                        <th>Amount</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="user in applicants.data">
                        <td>{{ user.username }}</td>
                        <td><span class="text-muted"><i class="fa fa-clock-o"></i> {{ user.bid_date }}</span> </td>
                        <td>{{ user.bid | currency }}</td>
                        <td>
                            <div class="label label-table label-success">Applied</div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</template>
<style scoped>

</style>
<script type="text/babel">

    export default{
        data(){
            return{
                applicants : {
                    data : [],
                    total : 0,
                    loading : false
                },
                pagination : null
            }
        },
        props : ['job'],
        methods : {
            getApplicants() {
                this.applicants.loading = true;
                window.axios.get(`/api/jobs/${this.job.id}/applicants`)
                        .then((response) => {
                            var data = response.data.data;

                            data.forEach((item)=>{
                                this.applicants.data.push(item);
                            });

                            this.applicants.total = response.data.total;
                            this.pagination = response.data.links;

                            this.applicants.loading = false;
                        })
                ;
            }
        },
        mounted(){
            this.getApplicants();
        }

    }
</script>
