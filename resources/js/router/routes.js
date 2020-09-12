import NotFound from "../views/errors/NotFound"
import AccessDenied from "../views/errors/AccessDenied"
import auth from '../middleware/auth'
import guest from '../middleware/guest'
import admin from "../middleware/admin";
const Home = () => import(/* webpackChunkName: "js/home" */ '../views/Home.vue');
const AppLayout = () => import(/* webpackChunkName: "js/applayout" */ '../views/layout/AppLayout.vue');
const AuthRoutes = () => import(/* webpackChunkName: "js/auth-routes" */ '../views/Auth/AuthRoutes.vue');
const DashboardIndex = () => import(/* webpackChunkName: "js/Dashboard-index" */ '../views/dashboard/DashboardIndex.vue');
const Dashboard = () => import(/* webpackChunkName: "js/Dashboard" */ '../views/dashboard/Dashboard.vue');
const AdminDashboardIndex = () => import(/* webpackChunkName: "js/admin-Dashboard-index" */ '../views/admin/AdminDashboardIndex.vue');
const AdminDashboard = () => import(/* webpackChunkName: "js/admin-Dashboard" */ '../views/admin/AdminDashboard.vue');
const AdminUser = () => import(/* webpackChunkName: "js/admin-user" */ '../views/admin/User/AdminUser.vue');
export default [
    {
        path: '/',
        component: AppLayout,
        children:[
            {
                path: '/admin/user/:url',
                name: 'admin-user',
                component: AdminUser,
                props: true,
                meta: {
                    middleware: [
                        auth,admin
                    ]
                }
            },
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
            {
                path: '/dashboard',
                component: Dashboard ,
                children:[
                    {
                        path: 'index',
                        name: 'dashboard-index',
                        component: DashboardIndex,
                        meta: {
                            middleware: [
                                auth
                            ]
                        },                      
                    },
                ]
            },
            {
                path: '/admin/dashboard',
                component: AdminDashboard,
                children: [
                    {
                        path: 'index',
                        name: 'admin-dashboard-index',
                        component: AdminDashboardIndex,
                        meta: {
                            middleware: [
                                auth
                            ]
                        },

                    },
                         ]
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