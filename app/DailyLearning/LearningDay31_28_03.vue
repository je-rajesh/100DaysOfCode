<template>
  <section>
    today. I learnt about chaining dispatch with then and catch. and i also
    learnt about beforeEnter key in routes for protecting the user from visiting
    certain routes.
  </section>
</template>

<script>
// -------------- routes ------
const routes = [
  {
    path: "/home",
    component: () => import("pages/auth/Home.vue"),
    beforeEnter(to, from, next) {
      if (this.$store.getters.isUserAuthenticated) {
        next(to);
      } else {
        next("/login");
      }
    },
  },
];
export default {
  name: "LearningDay31_28_03",

  methods: {
    login() {
      dispatch("login", payload).then((response) => {
        this.$router.push("/home");
      });
    },
  },
};
</script>
