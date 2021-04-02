<template>
    <section>
        <p>today i learnt vuex actions method</p>

        <p>we define functionality in actions which are asynchronous in nature. such as api fetching </p>
        <p></p>
    </section>
</template>

<script>
import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

const store = new Vuex.Store({
    state: {
        layout: 'guest'
    },

    actions: {
        login(payload){
            axios.post('/login', payload).then(response => {
                console.log(response);
            }).catch(error => {
                console.log(error)
            })
        }
    }
})

export default {
    name: 'LearningDay30_27_03',
    methods: {
        login(){
            dispatch('login', {
                email: 'abc@gmail.com',
                password: 'password'
            })
        }
    }
}
</script>
