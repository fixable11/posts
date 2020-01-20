<template>
    <div class="row justify-content-center mt-3">
        <div class="col-md-6 col-12">
            <div class="card">
                <div class="card-body">
                    <p v-show="!editState" class="card-text">{{ comment.context }}</p>
                    <div class="input-group mt-2" v-show="editState">
                        <textarea class="form-control" v-model="context"></textarea>
                    </div>
                </div>
                <div class="card-body d-flex">
                    <div v-show="!editState" @click="edit" class="btn btn-primary">Edit</div>
                    <div v-show="!editState" @click="remove" class="ml-auto btn btn-danger">Delete</div>
                    <div v-show="editState" @click="cancel" class="btn btn-secondary">Cancel</div>
                    <div v-show="editState" @click="save" class="btn btn-success ml-2">Save</div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "CommentComponent",
        props: ['comment'],
        data() {
            return {
                editState: false,
                newContext: this.comment.context,
            }
        },
        methods: {
            edit() {
                this.editState = true;
            },
            cancel() {
                this.editState = false;
            },
            remove() {
                this.$emit('commentDeleted', this.comment.id);
            },
            save() {
                this.$emit('commentChanged', {context: this.newContext, id: this.comment.id});
                this.editState = false;
            },
        },
        computed: {
            context: {
                set(newContext) {
                    this.newContext = newContext;
                },
                get() {
                    return this.comment.context;
                }
            }
        }
    }
</script>

<style scoped>

</style>
