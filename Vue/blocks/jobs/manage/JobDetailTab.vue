<template>
    <div class="row" v-if="job">
        <div class="col-sm-6">
            <div class="mb-3 mt-0">
              <span v-for="category in job.categories" class="d-inline-block mr-3">
                 <i class="tag icon"></i>
                 {{ category.name }}
              </span>
            </div>

            <p class="mail-desc fluid d-block mb-5" v-html="job.description"></p>


            <a :href="'/jobs/' + job.slug" target="_blank" class="label label-rouded label-warning">
                <i class="icon unhide"></i> Preview
            </a>
            <span class="time pull-right uk-text-middle">
                <i class="icon clock large "></i>
                {{ job.publishedOn.diff }}
            </span>
        </div>
        <div class="col-sm-5 offset-1">
            <google-map :name="job.id"
                        :height="350"
                        :markers="[{latitude: job.address.coord.latitude,
                                        longitude: job.address.coord.longitude}]">
            </google-map>
        </div>
    </div>
</template>
<style scoped>

</style>
<script type="text/babel">

    export default{
        data(){
            return{

            }
        },
        props : ['job']

    }
</script>
