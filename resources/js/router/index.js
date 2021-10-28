import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

export const routes = [
    {
        path: '/',
        name: 'home',
        component: () => import('../components/Home'),
        props: true,
        meta: {
            guest: true
        }
    },
    {
        path: '/campaigns/create',
        name: 'new-campaign',
        component: () => import('../components/NewCampaign'),
        props: true,
        meta: {
            guest: true
        }
    },
    {
        path: '/campaigns/:campaignId',
        name: 'campaign',
        component: () => import('../components/Campaign'),
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
