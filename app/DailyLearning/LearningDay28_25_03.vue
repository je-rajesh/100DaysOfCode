<template>
  <div>
    <!-- Today i learnt about how to configure Laravel fortify along  with laravel sanctum in authenticating laravel
        Single page application -->

    <q-page class="flex flex-center">
      <img alt="Quasar logo" src="~assets/quasar-logo-full.svg" />
      <!-- <div class="row"></div> -->
    </q-page>
  </div>
</template>
<script>
import axios from "axios";

export default {
  name: "DailyLearning28_25_03",

  mounted() {
    axios
      .get("/sanctum/csrf-cookie")
      .then((response) => {
        console.log(response);
      })
      .catch(function (response) {
        console.log(response);
      });
  },
};
</script>

