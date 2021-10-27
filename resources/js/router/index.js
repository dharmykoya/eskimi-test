import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

export const routes = [
    {
        path: '/:authPage?',
        name: 'home',
        component: () => import('../components/Home'),
        // component: () => import('../components/Note/Index'),
        props: true,
        meta: {
            guest: true
        }
    },
    // {
    //     path: '/:pathMatch(.*)*',
    //     name: '404',
    //     component: () => import('../components/NotFound'),
    //     meta: {
    //         guest: true,
    //     }
    // }
];


const router = new VueRouter({
    mode: 'history',
    linkExactActiveClass: 'active',
    routes
})

export default router;
