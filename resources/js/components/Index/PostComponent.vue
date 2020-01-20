<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-12">
                <div class="card mt-5" style="">
                    <img class="card-img-top"
                         :src="post.image ? post.image : 'https://via.placeholder.com/500'"
                         alt="Card image cap">
                    <div class="card-body">
                        <h5 v-show="!editState" class="card-title">{{ post.title }}</h5>
                        <div class="input-group" v-show="editState">
                            <input class="form-control" type="text" v-model="title">
                        </div>
                        <p v-show="!editState" class="card-text">{{ post.description }}</p>
                        <div class="input-group mt-2" v-show="editState">
                            <textarea class="form-control" v-model="description"></textarea>
                        </div>
                        <div class="input-group mt-2" v-show="editState">
                            <input @change="uploadImage" type="file" accept="image/*">
                        </div>
                    </div>
                    <div class="card-body d-flex">
                        <div v-show="!editState" @click="edit" class="btn btn-primary">Edit</div>
                        <div v-show="!editState" @click="remove" class="ml-auto btn btn-danger">Delete</div>
                        <div v-show="editState" @click="cancel" class="btn btn-danger">Cancel</div>
                        <div v-show="editState" @click="save" class="ml-2 btn btn-success">Save</div>
                    </div>
                </div>
                <button type="button" class="btn btn-primary mt-3" data-toggle="modal" data-target="#commentModal">
                    Create comment
                </button>
                <!-- Modal -->
                <div class="modal fade" id="commentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Create comment</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="input-group">
                                    <textarea v-model="commentData.context" class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="closeCommentModal btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary" @click="createNewComment">Create</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <comment-component
            :comment="comment"
            v-for="comment in post.comments"
            :key="comment.id"
            @commentChanged="commentChanged"
            @commentDeleted="commentDeleted"
        />
    </div>
</template>

<script>
    import {mapActions, mapGetters} from "vuex";
    import CommentComponent from "./CommentComponent";
    import uploadImage from "../../mixins/uploadeImage";

    export default {
        name: "Post",
        components: {CommentComponent},
        mixins: [uploadImage],
        data() {
            return {
                id: this.$route.params.id,
                editState: false,
                cardDescription: document.querySelector('.card-description'),
                formData: {
                    id: '',
                    title: '',
                    description: '',
                    image: '',
                    comments: []
                },
                commentData: {
                    context: ''
                }
            }
        },
        methods: {
            ...mapActions([
                'fetchPost',
                'updatePost',
                'updateComment',
                'createComment',
                'deleteComment',
                'deletePost',
            ]),
            edit() {
                this.editState = true;
            },
            cancel() {
                this.editState = false;
            },
            async save() {
                await this.updatePost(this.formData);
                this.editState = false;
            },
            async remove() {
                await this.deletePost(this.id);
                this.$router.push({name: 'home'})
            },
            async commentChanged(formData) {
                await this.updateComment({post_id: this.id, ...formData});
            },
            async commentDeleted(commentId) {
                await this.deleteComment({post_id: this.id, id: commentId});
            },
            async createNewComment() {
                await this.createComment({post_id: this.id, ...this.commentData});
                document.querySelector('.closeCommentModal').click();
                this.commentData.context = '';
            }
        },
        computed: {
            ...mapGetters({
                post: 'getCurrentPost',
            }),
            title: {
                set(title) {
                    this.formData.title = title;
                },
                get() {
                    return this.post.title;
                }
            },
            description: {
                set(description) {
                    this.formData.description = description;
                },
                get() {
                    return this.post.description;
                }
            },
        },
        async created() {
            await this.fetchPost(this.id);
            this.formData = _.cloneDeep(this.post);
        }
    }
</script>

<style scoped>

</style>
