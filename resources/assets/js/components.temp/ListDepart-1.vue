<template>
    <div>
        <div class="checkbox">
            <label>
                <input type="checkbox" v-model="searchDepart">ค้นจากชื่อหน่วยงาน : 
            </label>
            <span class="btn btn-default" @click="showListToggle" v-if="searchDepart"><span class="glyphicon glyphicon-search" aria-hidden="true" ref="btnSearchDepart"></span></span>{{departSearch[1]}}
        </div>
        
        
        <div class="listdepart" v-if="showList">
            <p class="btn btn-default" v-for="depart in departs" @click="sendDepart(depart.id, depart.departname)">{{depart.departname}}</p>
        </div>
        <div>
            <button class="btn btn-primary">Search</button>
        </div>
    </div>
    
</template>
<script>
    import Vue from 'vue'
    export default{
        props: ['departid','getData'],

        data() {
            return {                
                departs: [],
                departSearch: [],
                searchDepart: false,
                showList: false                
            }
        },
        created() {
            this.fetchIndexData()
        },
        computed: {
            departvalue() {
                
            }
        },
        watch: {
            searchDepart: function(val) {
                if(!val){
                    this.sendDepart('','');
                }
            }
        },
        methods: {
            showListToggle(){
                if(this.showList){
                    this.showList = false;
                }else{
                    this.showList = true;
                }
            },
            sendDepart: function(departid, departname) {
                //this.departid = depart;
                //this.$emit('getDepart', this.departid);
                //this.getData();
                this.$store.state.departid = departid;
                
                this.departSearch = [departid, departname];
                this.showList = false;
                //console.log(this.$refs.listdepart);               
                
                
            },
            fetchIndexData() {
                var vm = this
                axios.get('/api/depart')
                .then((response)=>{
                    vm.departs = response.data;
                })
                .catch(function(response){
                    console.log(response)
                })
            }
        }
    }
</script>
<style scoped>
    
</style>