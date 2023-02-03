<template>
    <div>

        <h1>Post: {{  post.title }} </h1>

        <p>
            {{ post.body }}
        </p>


    </div>
  </template>

  <script>


  export default {
    name: "PostCard",
    components: {

    },
    data() {
      return {
        post: null,

      };
    },
    mounted() {
      this.getPost();
    },
    methods: {
      getPost() {

        axios
          .get("http://localhost:8000/api/posts/" + this.$route.params.id)
          .then((res) => {

            this.post = res.data;

          })
          .catch((err) => {
            console.log(err);
          })

      },
    },
  };
  </script>

  <style lang="scss" scoped>
  </style>
