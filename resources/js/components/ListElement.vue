
<template>
    <div class="row">
        <div class="col-md-8 col-lg-9 " v-on:click="selectedElement">{{element.text}}</div>
        <div class="col-md-4 col-lg-3"><button class="btn btn-danger">Remove Item</button></div>
    </div>
</template>


<script lang="ts">
    import Vue from 'vue'
    import Component  from 'vue-class-component'

    import {Element} from '../types/main';
    import {Emit} from 'vue-property-decorator';

    @Component({
        props: {
            element: {
                type: Element,

            },
            key:{
                type: Number,
                default: -1,
            },
            activeElement:{
                type: Number,
                default: -1,
            }
        }
    })
    export default class ListElement extends Vue{
        key: number = -1;
        activeElement: number = 0;

    }
</script>


<style>

</style>