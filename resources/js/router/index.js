import Vue from "vue";
import VueRouter from "vue-router";
import NotFound from "../views/NotFound";
import Index from "../views/Index";
import Post from "../views/Post";

import {POSTS_URL} from "../store/modules/posts/constants";

Vue.use(VueRouter);

export default new VueRouter({
    mode: "history",
    routes: [
        { path: "/", component: Index, name: "home" },
        { path: "/posts/:id", name: 'post', component: Post,
            beforeEnter: (to, from, next) => {
                axios.head(`/api/${POSTS_URL}/${to.params.id}`)
                    .then(() => next(true))
                    .catch(() => next({name: 'not-found'}));
            }
        },
        { path: '/404', name: 'not-found', component: NotFound },
        { path: '*', redirect: '/404' },
    ],
});
