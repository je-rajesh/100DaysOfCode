<template>
  <div>
    <p>today i learnt about axios's passing cookies to nested axios request.</p>
    <p>
      this one is implemented using laravel sanctum package for SPA
      authentication
    </p>

    <h3>steps to product</h3>
    <ul>
      <li>
        to provide the request the XSS (CSRF protection). we first make a
        request to get cookie.
      </li>
      <li>then we make login or registration request</li>
      <li>
        rest the subsequest request will be automatically session based
        authentcated even if it is made outside somewhere else.
      </li>
    </ul>
  </div>
</template>

<script>
export default {
  name: "LearningDay33_30_03",
  methods: {
    login() {
      /**first make a request to `/sanctum/csrf-cookie` */
      axios.get("/sanctum/csrf-cookie").then(() => {
        axios
          .post("/login", {
            email: "abc@gmail.com",
            password: "password",
          })
          .then(this.$router.push("/home"))
          .catch((error) => console.log(error));
      });
    },
    getUser() {
      /**for this api request, the user must be authenticated */
      axios.get("/user").then((response) => console.log(response)).catch(error => alert('something wrong happened', error.response.data.message));
    },
  },
};
</script>


