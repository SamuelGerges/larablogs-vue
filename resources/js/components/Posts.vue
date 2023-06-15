<template>
    <div class="row">
        <div class="col-md-8" v-if="isSearching">
            ...searching posts
        </div>
        <div class="col-md-8" v-else>
            <div class="media simple-post" v-for="post in posts.data" :key="post.id">
                <img class="mr-3" :src="/img/+post.image" alt="Generic placeholder image">
                <div class="media-b0">
                    <h4>
                        <router-link :to="'post/'+ post.slug">{{ post.title }}</router-link>
                    </h4>
                    {{ post.body }}
                    <ul class="list-inline list-unstyled d-flex post-info">
                        <li><span><i class="fa fa-user"></i> posted by : <strong class="text-primary">{{
                                post.user.name
                            }}</strong> </span></li>
                        <li>|</li>
                        <li><span><i class="fa fa-calendar"></i>{{ post.added_at }} </span></li>
                        <li>|</li>
                        <span><i class="fa fa-comment"></i> {{ post.comments_count }} comments</span>

                    </ul>
                </div>
            </div>
            <pagination :data="posts" @pagination-change-page="getPosts"></pagination>
        </div>
        <!-- Sidebar Widgets Column -->
        <div class="col-md-4">
            <!-- Search Widget -->
            <div class="card my-4">
                <h5 class="card-header">Search</h5>
                <div class="card-body">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search for..." v-model="searchPost">
                        <span class="input-group-btn">
                <button class="btn btn-secondary" type="button">Go!</button>
              </span>
                    </div>
                </div>
            </div>

            <category></category>

        </div>
    </div>

</template>

<script>
import category from "./Category.vue";

export default {
    data() {
        return {
            posts: {},
            searchPost: '',
            isSearching: false
        }
    },
    components: {
        category,

    },

    watch: {
        searchPost(query) {
            if (query.length > 0) {
                this.isSearching = true

                axios.get('/api/search-post/' + query + '?page=1')
                    .then(res => {
                        // console.log(res.data)
                        this.posts = res.data;

                    })
                    .then(err => console.log(err))
            } else {
                let oldPosts = JSON.parse(localStorage.getItem('posts'));
                this.posts = oldPosts;
            }
            this.isSearching = false

        }
    },
    mounted() {
        this.getPosts();
    },
    methods: {
        getPosts(page = 1) {
            axios.get('/api/posts?page=' + page)
                .then(res => {
                    this.posts = res.data;
                    localStorage.setItem('posts', JSON.stringify(this.posts))
                })
                .catch(err => console.log(err))
        },
    },

}
</script>
