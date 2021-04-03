# LearningDay 36, 02/04/21. 

## today i learnt about following things.

- ### How to watch state changes in vuex state inside a component. 
    just define a getter for the property, make a computed property inside component which return the data returned from getter function and use that computed property inside your template. 
    ```javascript
    const state = {
        name: '', 
        roll_no: '', 
        subjects: ''
    }, 

    const getters = {
        getName(state, getters, rootState, rootGetters){
            return state.name
        }

    }

    /**
        Now isnde a component define a computed property like this. 
    **/
    export default {
        computed: {
            name(){
                return this.$store['getName'];
            }
        }
    }
    ```
    **now inside a template tag.**
    ```html
    <h2>{{ name }}</h2>
    ```
    whenever the state property will change then associated changes in front end will be shown too. 

- ### How to use pass arguments to a getters. 
    the trick is to just return a callback from the getters that do the task

```javascript
const state = {
    persons: [{
        id: 3,
        name: 'abc',
    }, {
        id: 4,
        name: 'def'
    }
    ]
}

const getters = {
    getPersonById(state, getters, rootState, rootGetters){
        return function(id) {
            return state.persons.find(i => i.id === id)
        }
    }
}

/**
 * To use this inside anywhere (eg. Components. )
 * 
*/
export default {
    computed:{
        getname(id){
            return this.$store.getters['getPersonById'](id)
        }
    }
}
```
