import { createWebHistory, createRouter } from "vue-router";
import Home from "./Home.vue";

const routes = [
    {
        path: "/dashboard",
        name: "Home",
        component: Home,
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;


