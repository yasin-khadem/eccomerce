const Home = () => import(/* webpackChunkName: "js/home" */ '../views/Home.vue');
export default [
    {
        path: '/',
        name: 'home',
        component: Home,
    }
]