import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export const store = new Vuex.Store({
    state: {
        source: '/api/editor',
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
    },
    mutations: {
        setquerywith : (state, query) => {
            state.query.search_column = query.column;
            state.query.search_operator = query.operator;
            state.query.search_input = query.input;
        },
        fetchIndexData: state => {
            console.log('===fetchdata===' . state)
            axios.get(state.source,{
                params: {
                    column: state.query.column,
                    direction: state.query.direction,
                    page: state.page,
                    per_page: state.query.per_page,
                    search_column: state.query.search_column,
                    search_operator: state.query.search_operator,
                    search_input: state.query.search_input
                }
            })
            .then(function(response){
                Vue.set(state, 'model', response.data.model)
                Vue.set(state, 'columns', response.data.columns)
            })
            .catch(function(response){
                console.log(response)
            })
        },
        resetData: state => {
            state.source = '/api/editor',
            state.model = {},
            state.columns = {},
             
            state.query.page = 1,
            state.query.column = 'id',
            state.query.direction = 'asc',
            state.query.per_page = 10,
            state.query.search_column = 'depart_id',
            state.query.search_operator = 'equal',
            state.query.search_input = ''
            
             
            state.operators.equal = '=',
            state.operators.not_equal = '<>',
            state.operators.less_than = '<',
            state.operators.greater_than = '>',
            state.operators.less_than_or_equal_to = '<=',
            state.operators.greater_than_or_equal_to = '>=',
            state.operators.in = 'IN',
            state.operators.like = 'LIKE'           
        }
       
    },
    actions: {
        setquerywith: ({ commit }, query) => {
            commit('setquerywith', query);
        },
        fetchIndexData: ({ commit }) => {
            commit('fetchIndexData');
        },
        resetData: ({ commit }) => {
            commit('resetData');
            commit('fetchIndexData');
        },
        
    },
    getters: {
        getQuery: state => {
            return state.query;
        },
        getEditor: state => {            
            return state;
        }
        
    }

});