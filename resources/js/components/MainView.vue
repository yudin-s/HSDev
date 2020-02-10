<template>
    <div classs="container" v-bind:class="{'view': !isEditMode}" v->
        <div class="row align-items-center justify-content-center">
            <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
                <div class="card-header">

                    <div class="btn-group" role="group" aria-label="Basic example">
                        <button type="button" class="btn btn-success" v-on:click="setViewMode">View</button>
                        <button type="button" class="btn btn-secondary" v-on:click="setEditMode">Edit</button>
                    </div>

                    <div class="btn-group pull-right " role="group" aria-label="Basic example">
                        <button type="button" class="btn btn-secondary" :disabled="!isSaveNeeded"
                                v-on:click="saveData()">Save
                        </button>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div v-if="elements.length">
                            <div v-for="(element,index) in elements" class="element"
                                 v-bind:class="{'focus': activeElement == index }">


                                <div class="row ">
                                    <div class="col-md-6 col-lg-7 " v-on:click="selectElement(index)">{{element.text}}
                                    </div>
                                    <div class="col-md-6 col-lg-5">
                                        <button class="btn btn-primary" v-on:click="selectAndShow(index)">Add Item
                                        </button>
                                        <button class="btn btn-danger" v-on:click="removeElement(index)">Remove Item
                                        </button>
                                    </div>
                                </div>
                                <div v-if="isNeedInputShow(index)">
                                    <div class="row">
                                        <div class="col-md-7">
                                            <input ref="newElCaption" v-on:keyup.enter="addElement"
                                                   v-model="newElementCaption"/>
                                            <button class="btn btn-primary" v-on:click="addElement">Insert</button>
                                            <button class="btn btn-danger" v-on:click="hideInput">Close</button>
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
                                </div>
                            </div>
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
    import {Watch} from 'vue-property-decorator'

    @Component(
        {
            props:{
                api_index:{
                    type:String,
                    default: null,
                },
                api_store:{
                    type: String,
                    default: null,
                }
            }
        }
    )
    export default class MainView extends Vue {

        private   elements: Element[] = [];
        private  activeElement: number = -1;
        private  newElementCaption: String = "";

        private  isInputShow: Boolean = false;
        private  isEditMode: Boolean = false;
        private isSaveNeeded = false;



        mounted(): void {
            let self = this;
            window.addEventListener('keyup', this.keyboardHanlder);
            //@ts-ignore
            axios.get(this.api_index).then(function (response) {
                self.$set(self,'elements',response.data);
            });
        };

        public keyboardHanlder(ev: any) {
            if (ev.keyCode == 13) {
                this.onKeyEnter();
            }
        }


        public saveData() {
            let arr = this.elements;
            //@ts-ignore
            axios.post(this.api_store,{elements: JSON.stringify(arr)}).then( (response) => {
                this.isSaveNeeded = false;
            });
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
                this.activeElement + 1,
                0,
                new Element(this.newElementCaption));
            this.hideInput();
        };

        public selectElement(index: number): void {
            if(this.isEditMode) {
                this.activeElement = index;
            }
        }

        public removeElement(index: number): void {
            if(confirm('Are you sure?')) {
                this.elements.splice(index, 1);
            }
        }

        public onKeyEnter() {
            this.isInputShow = true;
            this.$nextTick(() => {
                // @ts-ignore
                let theField = this.$refs['newElCaption'][0]; // @ts-ignore
                theField.focus(); // @ts-ignore
            });
        };

        public  selectAndShow(index: number): void {
            this.selectElement(index);

            this.onKeyEnter();
        }

        public hideInput() {
            this.newElementCaption = "";
            this.isInputShow = false;
            this.activeElement = -1;
        }

        public setViewMode() {
            if(this.isSaveNeeded){
                if(confirm("Click 'Ok' if you wan't store changes'")){
                    this.isEditMode = false;
                    this.hideInput();
                }
            }

        }

        public setEditMode() {
            this.isEditMode = true;

        }


        @Watch('elements')
        onElementsChange(val: Element[], oldVal: Element[]): void {
            this.isSaveNeeded = true;
            this.hideInput();
        }


    }
</script>

