import Films from '../pages/Films.vue';
import Page404 from '../pages/404.vue';

const routes = [
    {
        path: '/films',
        name: 'films',
        component: Films,
    },
    {
        path: '*',
        name: '404',
        component: Page404,
    }
];

export default routes;