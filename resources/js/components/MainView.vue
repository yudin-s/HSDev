<template>
    <div classs="container">

        <div class="row align-items-center justify-content-center">
            <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
                <div v-if="elements.length">
                    <list v-for="(element,index) in elements" :value.sync="element"></list>
                    <div v-if="activeElement == index && isInputShow">
                        <div class="row">
                            <div class="col-md-7">
                                <input v-model="newElementCaption"/>
                            </div>
                            <div class="col-md-5">
                                <button class="btn btn-primary" v-on:click="addElement">Insert</button>
                                <button class="btn btn-danger">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="v-else">
                    <div class="row">
                        <div class="col-md-7">
                            <input v-model="newElementCaption"/>
                        </div>
                        <div class="col-md-5">
                            <button class="btn btn-primary" v-on:click="addElement">Insert</button>
                            <button class="btn btn-danger">Close</button>
                        </div>
                    </div>
                </div>
            </div>


        </div>

        <div class="row align-items-center justify-content-center">
            <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
                <div class="text-right pull-right">
                    <button class=" btn btn-primary">
                        Add Element
                    </button>
                </div>
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
                activeElement: 0,
                newElementCaption: "",
                isInputShow: false,
            }
        },
        mounted(){
            axios.post().then(function (response) {

            });
        },

        methods: {
            addElement(){
                elements.slice(activeElement, 0, {
                    text: newElementCaption,
                });

            },

            showInput(){
                isInputShow = true;
            },
        }
    }
</script>


<style>

</style>