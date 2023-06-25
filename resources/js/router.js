import { createWebHistory, createRouter } from "vue-router";
import Home from "./Home.vue";
import Flights from "./Flights.vue";

const routes = [
    {
        path: "/dashboard",
        name: "Home",
        component: Home,
    },
    {
        path: "/flights",
        name: "Flights",
        component: Flights,
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;


