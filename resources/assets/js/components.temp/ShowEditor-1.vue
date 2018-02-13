<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <list-depart :departid="query.search_input" 
                    @getDepart="query.search_input=$event" 
                    :getData="fetchIndexData"></list-depart>
            </div>
            <div>{{searchinput}}</div>
        </div>
        
        <div class="row">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th v-for="column in columns" @click="toggleOrder(column)">
                            
                              <span>{{column}}</span>
                              <span v-if="column === query.column">
                                  <span v-if="query.direction === 'asc'">&uarr;</span>
                                  <span v-else>&darr;</span>
                              </span>                          
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="row in model.data">                        
                        <td>{{row.id}}</td>
                        <td>{{row.fname}}</td>   
                        <td>{{row.depart.departname}}</td>                     
                        <td>{{row.job}}</td>                        
                        <td>{{row.user.fname}}</td>
                    </tr>
                </tbody>
            </table>
            <button class="btn btn-primary">test</button>
        </div>
    </div>
</template>
<script>
    import Vue from 'vue';
    import axios from 'axios';
    import {mapGetters} from 'vuex';
    import ListDepart from './ListDepart';
    export default {
        props: ['source', 'title'],
        data() {
            return {
                model: {},
                columns: {},
                query: {
                    page: 1,
                    column: 'id',
                    direction: 'asc',
                    per_page: 10,
                    search_column: 'depart_id',
                    search_operator: 'equal',
                    search_input: ''
                },
                operators: {
                    equal: '=',
                    not_equal: '<>',
                    less_than: '<',
                    greater_than: '>',
                    less_than_or_equal_to: '<=',
                    greater_than_or_equal_to: '>=',
                    in: 'IN',
                    like: 'LIKE'
                    }
            }
        },
        
        created() {
            this.fetchIndexData()
        },
        components:{
            ListDepart
        },
        watch: {
            query: function(){
                this.fetchIndexData();
            }
        },
        computed: {
            searchinput : function(){                
                return this.$store.state.departid;
            }
        },
        methods: {
            next() {
                console.log('next page')
                if(this.model.next_page_url){
                    this.query.page++;
                    this.fetchIndexData()                    
                }
            },
            prev() {
                if(this.model.prev_page_url){
                    this.query.page--;
                    this.fetchIndexData()                    
                }
            },
            toggleOrder(column) {
                if(column === this.query.column){
                    if(this.query.direction === 'desc'){
                        this.query.direction = 'asc'
                    }else{
                        this.query.direction = 'desc'
                    }
                }else{
                    this.query.column = column
                }
                
                this.fetchIndexData();
            },
            fetchIndexData() {
                var vm = this
                axios.get(this.source,{
                    params: {
                        column: this.query.column,
                        direction: this.query.direction,
                        page: this.page,
                        per_page: this.query.per_page,
                        search_column: this.query.search_column,
                        search_operator: this.query.search_operator,
                        search_input: this.query.search_input
                    }
                })
                .then(function(response){
                    Vue.set(vm.$data, 'model', response.data.model)
                    Vue.set(vm.$data, 'columns', response.data.columns)
                })
                .catch(function(response){
                    console.log(response)
                })
            }
        }
    }
</script>