<template>
  <div>
    <ul>
        <li v-for="elem in tag" >
            <ul>
                <li v-for="posts in elem.posts">
                    {{ posts.title }}
                </li>
            </ul>
        </li>
    </ul>
  </div>
</template>

  <script>
export default {
  name: "TagCard",
  components: {},
  data() {
    return {
      tag: [],
    }
  },
  mounted() {
    this.getTag();
  },
  methods: {
    getTag() {
      axios
        .get("http://localhost:8000/api/tags/" + this.$route.params.name)
        .then((res) => {
          this.tag = res.data;
        })
        .catch((err) => {
          console.log(err);
        });
    },
  },
};
</script>

  <style lang="scss" scoped>
</style>
