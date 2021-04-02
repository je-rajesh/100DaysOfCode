<template>
  <section>
    <p>
      today i learnt about vuex store management, particularly how to access
      rootState in different keys of a module
    </p>
  </section>
</template>

<script>
var bookStore = {
  namespaced: true,
  state: () => ({
    errors: "",
    books: [],
  }),

  mutations: {
    populateBooks(state, payload) {
      state.books = payload;
    },
  },

  actions: {
    fetchBooks(context, payload) {
      let { commit, state, rootState, rootGetters } = context;

      // this line calls mutations for another module

      //
      axios
        .get("/books")
        .then((response) => {
          console.log(response);
          commit("studentsStore/populateStudents", response.data, { root: true });
        })
        .catch((error) => console.log(error));
    },
  },
};

var studentsStore = {
  namespaced: true,
  state: () => ({
    errors: "",
    students: [],
  }),

  mutations: {
    populateStudents(state, payload) {
      state.students = payload;
    },
  },
};

var Store = new Vuex.Store({
  modules: {
    studentsStore,
    booksStore,
  },
});
export default {
  name: "LearningDay35_01_04",
};
</script>
