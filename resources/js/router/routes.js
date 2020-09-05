const Home = () => import(/* webpackChunkName: "js/home" */ '../views/Home.vue');
const AppLayout = () => import(/* webpackChunkName: "js/applayout" */ '../views/layout/AppLayout.vue');
export default [
    {
        path: '/',
        component: AppLayout,
        children:[
            {
                path: '/',
                name: 'home',
                component: Home,
            }
        ]
    }
]