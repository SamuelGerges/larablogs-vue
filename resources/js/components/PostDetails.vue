<template>
    <div>
        <!-- Post Content Column -->
        <div class="col-lg-8">
            <!-- Title -->
            <h1 class="mt-4">{{ post.title }}</h1>
            <!-- Author -->
            <p class=" alert alert-info" style="width: fit-content;
        padding: 5px;
        color: #142d31;" v-if="post.category">{{ post.category.name }}
            </p>
            <hr>
            <!-- Date/Time -->
            <p>Posted on <strong class="badge badge-primary p-1">{{ post.added_at}}</strong>
                <span class="float-right"><strong class="badge badge-info p-1">{{ comments.length}}</strong> comments</span></p>

            <hr>

            <!-- Preview Image -->
            <img class="img-fluid rounded" :src="/img/+post.image" style="width:900px;max-height:300px" alt="">

            <hr>
            {{ post.body}}
            <hr>

            <!-- Comments Form -->
            <div class="card my-4">
                <h5 class="card-header">Add a Comment:</h5>
                <div class="card-body">
                    <form>
                      <input  type="hidden" name="post_id" v-model="post_id">
                        <div class="form-group">
                            <textarea class="form-control" rows="3" v-model="body"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary" @click.prevent="AddComment">Submit</button>
                    </form>
                </div>
            </div>

            <!-- Single Comment -->
            <div class="media mb-4" v-for="(comment,index) in post.comments" :key="index">
                <img class="d-flex mr-3 rounded-circle" :src="/img/+comment.user.image" alt="" height="50px" width="50px">
                <div class="media-body">
                    <h5 class="mt-0">{{ comment.user.name }}</h5>
                    {{ comment.body}}
                </div>
            </div>



        </div>    </div>
</template>

<script>
    export default {
      data() {
        return {
          post: '',
          body: '',
          post_id:'',
          comments:[],
        }
      },
      created() {
        this.getPost();
        this.updateToken();
      },
      methods: {
        getPost() {
          axios.get('/api/posts/' + this.$route.params.slug)
              .then(res => {
                console.log(res);
                this.post = res.data;
                this.post_id = this.post.id;
                this.comments = this.post.comments;
              })
              .catch(err => {
                console.log(err)
              })
        },
        AddComment(){
          let {body,post_id} = this
          axios.post('/api/create-comment/',{body,post_id})
              .then(res => {
                console.log(res.data);
                this.comments.unshift(res.data);
              })
              .catch(err => {
                console.log(err)
              })
        },
        updateToken(){
          let token = JSON.parse(localStorage.getItem('userToken'));
          this.$store.commit('setUserToken',token)
        },
      },
      computed: {
        isLogged(){
          return this.$store.getters.isLogged
        }
      },
    }
</script>
