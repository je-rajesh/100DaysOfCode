<template>
  <div>
    <p>today i learnt about routing in vue single application</p>

    <section id="instructions">
      <p>installation: `npm i vue-router`</p>

      initiase it and use this plugin in vue original class. ``` ```
    </section>
  </div>
</template>

<script>
import Vue from "vue";
import VueRouter from "vue-router";

Vue.use(VueRouter);

const routes = [
  { name: "applications", component: () => import("pages/applications/index") },
  {
    name: "applications/create",
    component: () => import("pages/applications/create"),
  },
  { name: "playlists", component: () => import("pages/playlists/index") },
];

const router = new VueRouter({
  routes,
});

var vue = new Vue({
  router,
});

export default {
  name: "LearningDay32_29_03",
};
</script>
