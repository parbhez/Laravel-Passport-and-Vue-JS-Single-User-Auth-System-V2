<template> 
    <div class="d-flex flex-column flex-lg-row justify-content-between" style="margin-bottom: 15px;">
        <div>
            <label> 
                Show
                <select class="select-page-limit" 
                style="color: white;"
                v-model="limit"
                @change="handleOnChangePerPageLimit"

                > 
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                    <option value="200">200</option>
                    <option value="300">300</option>
                    <option value="500">500</option>
                </select> 
                entries
            </label>
        </div>
        <slot name="filters">
            
        </slot>
        <div class="w-25">
            <input 
                type="search" 
                placeholder="Search:" 
                v-model="filterString" 
                @keyup="handleSearch" 
                @change="handleSearch"
                class="dataTables_filter_search"  
                aria-controls="">
        </div>       
    </div>
</template>

<script>
import _ from 'lodash';
    export default {
        props:{
            meta:{
                type: Object,
                default: {}
                
            }
        },

        data() {
            return {
                page: 1,
                limit: 10,
                searchQuery: '',
                filterString: ''
            }
        },

        mounted(){
            // console.log("last = " + this.meta.last_page);
        },
        watch: {
            meta() {
                this.limit = this.meta.per_page
            },
            filterString(value) {
                if (value == '') {
                    this.$emit('search', '')
                }
                this.$store.dispatch('updateSearchStr', {
                    search_str: value
                })
            },
            searchStrFromStore() {
                this.filterString = this.$store.state.search_str
            },
        },

        computed: {

            gotoPage() {
                const gotoData = [];
                for(let i = 5; i <= this.meta.last_page; i += 5) {
                    gotoData.push(i);
                }
                return gotoData;
            },

            searchStrFromStore() {
                this.filterString = this.$store.state.search_str
            },
            
        },

        methods:{
            handleOnChangePerPageLimit() {
                //console.log(this.meta.total) //4
                //console.log(this.limit); //10
                let totalPage = Math.round(this.meta.total / this.limit) // 4/10 = 0
                //console.log(totalPage);
                if(totalPage < this.page) { // 0 < 1
                    this.broadcast(totalPage, this.limit)
                    return
                }
                if(totalPage > 0) { //5 > 0
                    this.broadcast(this.page, this.limit)
                }
            },

            broadcast(page, limit = this.limit) {
                //
                //Send data from the Child Component to Parent Component using the $emit() method.
                this.$emit('changed', { page, limit }) //The first argument is the $event name and the second argument is the actual data that you want to pass to the parent component.
            },  

            handleSearch: _.debounce( function(e) {
                let inputVal = e.target.value     
                let strSearch = this.searchQuery
              ;  
                if((strSearch == '' || strSearch === inputVal) && (inputVal.length <= 0 || strSearch === inputVal || inputVal.replace(/\s/g, "") == '')) {
                    return
                }
                this.searchQuery = inputVal;
                if (this.searchQuery != '') {
                    this.$emit('search', this.searchQuery) ////The first argument is the $event name and the second argument is the actual data that you want to pass to the parent component.
                }
            }, 500),
        },
    }
</script>


<style scoped>
    .select-page-limit {
        width: 80px;
        height: 30px !important;
        padding: 0px 10px !important;
        border: 1px solid #aaa;
        border-radius: 3px;
        background-color: #484a56;
    }
    .dataTables_filter_search {
        width: 97%;
        border: 1px solid #ffffff;
        border-radius: 3px;
        padding: 5px;
        background-color: transparent;
        color: white;
        margin-left: 3px;
    }
</style>