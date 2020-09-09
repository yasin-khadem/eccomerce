import NotFound from "../views/errors/NotFound"
import AccessDenied from "../views/errors/AccessDenied"
import auth from '../middleware/auth'
import guest from '../middleware/guest'
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
                meta: {
                    middleware: [
                        guest
                    ]
                }
            },
        ]
    },
    {
        path: '*',
        name: 'not-found',
        component: NotFound
    },
    {
        path: '/404',
        name: 'error404',
        component: NotFound
    },
    {
        path: '/403',
        name: 'access-denied',
        component: AccessDenied
    }
]