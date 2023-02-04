<template>
  <div>
    <!-- loader -->

    <Loader v-if="isLoading" />

    <ul v-else-if="tags.length">
      <li v-for="elem in tags" :key="elem.id">
        <router-link :to="`/tags/${elem.name}`">
          {{ elem.name }}
        </router-link>
      </li>
    </ul>
    <p v-else>no tags nel DB</p>
  </div>
</template>

  <script>
import Loader from "../Loader.vue";

export default {
  name: "TagsList",
  components: {
    Loader,
  },
  data() {
    return {
      tags: [],
      isLoading: false,
    };
  },
  mounted() {
    this.getTags();
  },
  methods: {
    getTags() {
      this.isLoading = true;
      axios
        .get("http://localhost:8000/api/tags")
        .then((res) => {
          this.tags = res.data;

        })
        .catch((err) => {
          console.log(err);
        })
        .then(() => {
          this.isLoading = false;
        });
    },
  },
};
</script>

  <style lang="scss" scoped>
</style>
