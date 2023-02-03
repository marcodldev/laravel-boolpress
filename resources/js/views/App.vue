<template>
  <div >

    <Header/>

    <!-- <WorkInProgress /> -->

    <!-- <PostList :isLoading="isLoading" :posts="posts" :pagination="pagination" /> -->

    <!-- <PostList /> -->
    <div class="container">
        <router-view></router-view>
    </div>


  </div>
</template>

<script>
// import WorkInProgress from "../components/WorkInProgress.vue"
// import PostList from "../components/posts/PostsList.vue"

import Header from "../components/Header.vue"

export default {
  name: "App",
  components: {
    Header
    // WorkInProgress,
    // PostList
    //inserire futuri componenti
  },
  data() {
    // return{
    //     posts: [],
    //     isLoading: false,
    //     pagination: {}
    // }
  },
  mounted() {
    //     this.getPosts();
  },
  // methods : {
  //     getPosts(page = 1){
  //         this.isLoading = true
  //         axios.get('http://localhost:8000/api/posts?page=' + page)
  //             .then((res) => {
  //                 // this.posts = res.data.data

  //                 //destrutturizzazione
  //                 const {data , current_page , last_page} = res.data;
  //                 this.posts = data;
  //                 this.pagination = {
  //                     lastPage: last_page,
  //                     currentPage: current_page
  //                 }

  //             }).catch(err =>{
  //                 console.log(err)
  //             }).then(() =>{
  //                 this.isLoading = false
  //             })
  //     }
  // }
};
</script>
