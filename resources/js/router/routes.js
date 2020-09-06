const Home = () => import(/* webpackChunkName: "js/home" */ '../views/Home.vue');
const AppLayout = () => import(/* webpackChunkName: "js/applayout" */ '../views/layout/AppLayout.vue');
const AuthRoutes = () => import(/* webpackChunkName: "js/auth-routes" */ '../views/Auth/AuthRoutes.vue');
export default [
    {
        path: '/',
        component: AppLayout,
        children:[
            {
                path: '/',
                name: 'home',
                component: Home,
            },
            {
                path: '/auth/:url',
                name: 'auth',
                props: true,
                component: AuthRoutes,
            },
        ]
    }
]