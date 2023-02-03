   <template>
  <div>
    <!-- loader -->

    <Loader v-if="isLoading" />

    <ul v-else-if="posts.length">
      <li v-for="elem in posts" :key="elem.id">
        <router-link :to="`/posts/${elem.id}`">
          {{ elem.title }}
        </router-link>
      </li>
    </ul>
    <p v-else>no post</p>

    <!-- Pagination -->

    <Pagination @on-page-change="getPosts" :pagination="pagination" />
  </div>
</template>

<script>
import Loader from "../Loader.vue";
import Pagination from "../Pagination.vue";

export default {
  name: "PostList",
  components: {
    Loader,
    Pagination,
  },
  data() {
    return {
      posts: [],
      isLoading: false,
      pagination: {},
    };
  },
  //   props: ["posts", "isLoading", "pagination"],
  mounted() {
    this.getPosts();
  },
  methods: {
    getPosts(page = 1) {
      this.isLoading = true;
      axios
        .get("http://localhost:8000/api/posts?page=" + page)
        .then((res) => {
          // this.posts = res.data.data

          //destrutturizzazione
          const { data, current_page, last_page } = res.data;
          this.posts = data;
          this.pagination = {
            lastPage: last_page,
            currentPage: current_page,
          };
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
