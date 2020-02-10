<template>
    <div classs="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">

            </div>
        </div>
    </div>
</template>


<script>
    import axios from 'axios';
    export default{
        data(){
            return {
                elements: [],
                activeElement:null,
            }
        },
        mounted(){
            axios.post().then(function(response){

            });
        }
    }
</script>


<style>

</style>