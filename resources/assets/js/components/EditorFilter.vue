<template>
    <div>
        <div class="checkbox">
            <label>
                <input type="checkbox" v-model="searchDepart">ค้นจากชื่อหน่วยงาน 
            </label>            
        </div>
        {{departSearch}}
        <div class="listdepart" v-if="searchDepart && !hasDepartSearch">
            <p class="btn btn-default" v-for="depart in departs" @click="selectSearch(depart.id, depart.departname)">{{depart.departname}}</p>
        </div>
       
        <div>
            <button @click="fetchIndexData">getdata</button><button @click="clearSearch">reset</button>
        </div>
    </div>
</template>
<script>
    
    import {mapGetters} from 'vuex';
    import {mapActions} from 'vuex';
    export default {
        data() {
            return {                
                departs: [],
                departSearch: [],
                searchDepart: false,  
                hasDepartSearch: false              
            }
        },
        created() {
            this.fetchDepartData()
        },
        watch: {
            searchDepart(){
                if(!this.searchDepart){
                    this.departSearch = [];  
                    this.hasDepartSearch = false                  
                }
            }
        },
        methods:{
            fetchDepartData() {
                var vm = this
                axios.get('/api/depart')
                .then((response)=>{
                    vm.departs = response.data;                    
                })
                .catch(function(response){
                    console.log(response)
                })
            },
            selectSearch(id,departname){
                this.departSearch = [id, departname];    
                this.setquerywith({
                    'column': 'depart_id',
                    'operator': 'equal',
                    'input': id
                })            
                this.hasDepartSearch = true;
                console.log(this.departSearch);
            },
            clearSearch(){
                this.searchDepart = false;
                this.resetData();

            },
            ...mapActions([
                'setquerywith',
                'fetchIndexData',
                'resetData'
            ])
        },
        computed: {
            ...mapGetters([
                'getQuery',
                
            ]),
            
        }
    }
</script>

