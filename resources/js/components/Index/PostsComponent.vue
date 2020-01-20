<template>
    <div class="container">
        <button type="button" class="btn btn-primary mt-3" data-toggle="modal" data-target="#postModal">
            Create post
        </button>
        <!-- Modal -->
        <div class="modal fade" id="postModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Create post</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Title</label>
                            <input class="form-control" v-model="formData.title" type="text" placeholder="Title">
                        </div>
                        <div class="form-group mt-2" >
                            <label>Description</label>
                            <textarea class="form-control" v-model="formData.description"></textarea>
                        </div>
                        <div class="form-group mt-2">
                            <label>Image</label>
                            <input @change="uploadImage" type="file" accept="image/*">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="closePostModal btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" @click="createNewPost">Create</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div
                class="col-md-4 col-12 d-flex align-items-stretch"
                v-for="post in getPosts"
                :key="post.id"
            >
                <div class="card mt-4 w-100" style="">
                    <router-link :to="{ name: 'post', params: { id: post.id }}">
                        <img class="card-img-top"
                             :src="post.image ? post.image : 'https://via.placeholder.com/500'"
                             alt="Card image cap"
                        >
                    </router-link>
                    <div class="card-body h-100">
                        <h5 class="card-title">
                            <router-link :to="{ name: 'post', params: { id: post.id }}">{{ post.title }}</router-link>
                        </h5>
                        <p class="card-text">{{ post.description }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import {mapActions, mapGetters} from 'vuex';
    import uploadImage from "../../mixins/uploadeImage";


    export default {
        name: "Posts",
        mixins: [uploadImage],
        data() {
            return {
                formData: {
                    title: '',
                    description: '',
                    image: '',
                }
            }
        },
        created() {
            this.fetchPosts();
        },
        methods: {
            ...mapActions([
                'fetchPosts',
                'createPost'
            ]),
            async createNewPost() {
                await this.createPost(this.formData);
                document.querySelector('.closePostModal').click();
                for (let ket in this.formData) {
                    this.formData[key] = '';
                }
            }
        },
        computed: {
            ...mapGetters([
                'getPosts',
                'getPostsCount'
            ]),
        }
    }
</script>

<style scoped>

</style>
