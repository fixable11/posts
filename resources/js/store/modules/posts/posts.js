import {COMMENTS_URL, POSTS_URL} from "./constants";

import comments from "./comments";

const state = {
    posts: [],
    currentPost: {
        title: '',
        description: '',
        image: '',
        id: '',
        comments: [],
    },
};

const getters = {
    getCurrentPost: state => state.currentPost,
    getPosts: state => state.posts,
    getPostsCount: state => state.posts.length,
};

const mutations = {
    ...comments.mutations,

    addPosts(state, posts) {
        state.posts = posts;
    },
    addPost(state, post) {
        state.posts.push(post);
    },
    deletePost(state, id) {
        let index = state.posts.findIndex(post => post.id === id);
        state.posts.splice(index, 0);
    },
    selectPost(state, post) {
        state.currentPost = post;
    },
};

const actions = {
    ...comments.actions,

    async fetchPosts({commit}) {
        const {data} = await axios.get(`/api/${POSTS_URL}`);
        let posts = data.data;
        commit('addPosts', posts);
    },
    async fetchPost({commit}, id) {
        const {data} = await axios.get(`/api/${POSTS_URL}/${id}`);
        let post = data.data;
        commit('selectPost', post);
    },
    async createPost({commit}, formData) {
        const {data} = await axios.post(`/api/${POSTS_URL}`, formData);
        let post = data.data;
        commit('addPost', post);
    },
    async updatePost({commit}, formData) {
        const {data} = await axios.put(`/api/${POSTS_URL}/${formData.id}`, formData);
        let post = data.data;
        commit('selectPost', post);
    },
    async deletePost({commit}, id) {
        await axios.delete(`/api/${POSTS_URL}/${id}`);
        commit('deletePost', id);
    },
};

export default {
    state,
    getters,
    actions,
    mutations,
};
