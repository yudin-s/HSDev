<template>
    <div classs="container">

        <div class="row align-items-center justify-content-center">
            <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
                <div v-if="elements.length">
                    <div v-for="(element,index) in elements" class="element">


                        <div class="row ">
                            <div class="col-md-8 col-lg-9 " v-on:click="selectElement(index)">{{element.text}}</div>
                            <div class="col-md-4 col-lg-3">
                                <button class="btn btn-danger" v-on:click="removeElement(index)">Remove Item</button>
                            </div>
                        </div>
                        <div v-if="isNeedInputShow(index)">
                            <div class="row">
                                <div class="col-md-7">
                                    <input ref="newElCaption" v-on:keyup.enter="addElement" v-model="newElementCaption"/>
                                    <button class="btn btn-primary" v-on:click="addElement">Insert</button>
                                    <button class="btn btn-danger">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div v-else>
                    <div class="row">
                        <div class="col-md-7">
                            <input v-model="newElementCaption"/>
                            <button class="btn btn-primary" v-on:click="addElement">Insert</button>
                            <button class="btn btn-danger">Close</button>
                        </div>
                    </div>
                </div>
            </div>


        </div>

    </div>
</template>


<script lang="ts">
    import axios from 'axios';

    import Vue from 'vue'
    import Component from "vue-class-component"
    import {Element} from '../types/main';


    @Component
    export default class MainView extends Vue {

        public   elements: Element[] = [];
        private  activeElement: number = -1;
        private  newElementCaption: String = "";
        private  isInputShow: Boolean = false;


        mounted(): void {
            let self = this;
            window.addEventListener('keyup', this.keyboardHanlder);

        };
        public keyboardHanlder(ev : any){
            if(ev.keyCode == 13){
                this.onKeyEnter();
            }
        }

        public isNeedInputShow(index: number): Boolean {
            return this.activeElement > -1 &&
                this.activeElement == index
                && this.isInputShow;
        }

        public isGlobalInputShow() {
            return this.activeElement > -1;
        }

        public addElement(): void {
            this.elements.splice(
                this.activeElement +1 ,
                0,
                new Element(this.newElementCaption));
            this.newElementCaption = "";
            this.isInputShow = false;
            this.activeElement = -1;
        };

        public selectElement(index: number): void {
            this.activeElement = index;
        }

        public removeElement(index: number): void{

            this.elements.splice(index,1);
        }

        public onKeyEnter() {
            this.isInputShow = true;
            this.$nextTick(() => {
                // @ts-ignore
                let theField = this.$refs['newElCaption'][0]; // @ts-ignore
                theField.focus(); // @ts-ignore
            });
        };

    }
</script>

