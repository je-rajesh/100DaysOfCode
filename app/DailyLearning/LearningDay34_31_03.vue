<template>
  <div>
    <p>
      today i learnt about callback implementation using 'axios, then and catch'
      and implemented.
    </p>
  </div>
</template>

<script>
export default {
  name: "LearningDay34_31_03",

  methods: {
    /**
     * it is just a simple implementation for axios binding.
     */
    login() {
      axios
        .post("/login", {
          email: "abc@gmail.com",
          password: "password",
        })
        .then((response) => {
          console.log(response);
          axios
            .get("/user")
            .then((response) => {
              console.log(response.data);
            })
            .catch((error) => console.log(error));
        });
    },
  },
};
</script>
