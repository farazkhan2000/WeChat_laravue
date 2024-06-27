import { createRouter, createWebHistory } from "vue-router";

const routes = [
    {
        path: "/",
        component: () => import("./pages/Home.vue"),
    },
    {
        path: "/chat",
        component: () => import("./pages/Chat.vue"),
    },
];

export default createRouter({
    history: createWebHistory(),
    routes,
});