import {POSTS_URL, COMMENTS_URL} from "./constants";

const mutations = {
    updateComment(state, payload) {
        state.currentPost.comments.forEach(comment => {
            if (comment.id === payload.id) {
                Object.assign(comment, payload);
            }
        });
    },
    addComment(state, payload) {
        state.currentPost.comments.push(payload);
    },
    deleteComment(state, id) {
        let index = state.currentPost.comments.findIndex(comment => comment.id === id);
        state.currentPost.comments.splice(index, 1);
    }
};

const actions = {
    async updateComment({commit}, formData) {
        const {data} = await axios.put(`/api/${POSTS_URL}/${formData.post_id}/${COMMENTS_URL}/${formData.id}`, formData);
        let comment = data.data;
        commit('updateComment', comment);
    },
    async createComment({commit}, formData) {
        const {data} = await axios.post(`/api/${POSTS_URL}/${formData.post_id}/${COMMENTS_URL}`, formData);
        let comment = data.data;
        commit('addComment', comment);
    },
    async deleteComment({commit}, formData) {
        await axios.delete(`/api/${POSTS_URL}/${formData.post_id}/${COMMENTS_URL}/${formData.id}`);
        commit('deleteComment', formData.id);
    }
};

export default {
    actions,
    mutations,
};
