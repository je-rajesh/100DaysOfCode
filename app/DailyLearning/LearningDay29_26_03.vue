<template>
    <section>
        <div>today i learnt about vuex store</div>
        <h3>instructions to use. </h3>
        <ul>
            <li>installation: `npm i vuex`</li>
        </ul>
    </section>
</template>

<script>
import Vue from 'vue'
import Vuex from 'vuex'

/** plugin initialisation */
Vue.use(Vuex)

/** crating a store */
const store = new Vuex.Store({
    state: {
        page_layout: 'guest-layout',
        dark_mode: false,
    },

    // how to read values from store.
    getters: { // getters get state and all getters as first and second arguments respectively
        isDarkMode(state, getters){
            return state.dark_mode
        }, 

        getLayOut(state, getters){
            return state.page_layout
        }
    },
    
    mutations: { // mutators set values in the store. 
        setLayout (state, payload) { // get state as first arguments and payload as second arguments. 
            try{
                state.page_layout = payload
            } catch(e) {
                alert('exception occured')
                console.log(e);
            }
            return true;
        }
    }
})

const vue = new Vue({
    store,
})

export default {
    name: 'LearningDay31_28_03',

    methods: {
        getLayOut() { // getting the layout from store
            return this.$store.getters.getLayOut 
        },

        setLayout(){
            commit('setLayout', 'auth')  // setting the layout in the store
        }
    }
}

</script>
