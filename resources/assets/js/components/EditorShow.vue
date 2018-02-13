<template>
    <div class="container">
        <div class="row">              
           <table class="table table-striped">
                <thead>
                    <tr>
                        <th v-for="column in getEditor.columns" @click="toggleOrder(column)">
                            
                              <span>{{column}}</span>
                              <span v-if="column === getEditor.query.column">
                                  <span v-if="getEditor.query.direction === 'asc'">&uarr;</span>
                                  <span v-else>&darr;</span>
                              </span>                          
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="row in getEditor.model.data">                        
                        <td>{{row.id}}</td>
                        <td>{{row.fname}}</td>   
                        <td>{{row.depart.departname}}</td>                     
                        <td>{{row.job}}</td>                        
                        <td>{{row.user.fname}}</td>
                    </tr>
                </tbody>
            </table>
        </div>        
    </div>
</template>
<script>
    import axios from 'axios';
    import {mapActions} from 'vuex';
    import {mapGetters} from 'vuex';
    export default {
        data(){
            return {
                editor : {}
            }
        },
       created(){
           this.fetchIndexData();           
       },
       computed: {
           ...mapGetters([
               'getEditor'
           ])
       },
       methods: {
           ...mapActions([
               'fetchIndexData'
               
           ]),
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
                if(column === this.$store.state.query.column){
                    if(this.$store.state.query.direction === 'desc'){
                        this.$store.state.query.direction = 'asc'
                    }else{
                        this.$store.state.query.direction = 'desc'
                    }
                }else{
                    this.$store.state.query.column = column
                }
                
                this.fetchIndexData();
            }
       },
       
    }
</script>