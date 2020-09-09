import Vue from 'vue'
import VueRouter from 'vue-router'
import routes from './routes'
import checkAuth from '../middleware/check-auth';

Vue.use(VueRouter);


const router = new VueRouter({
    mode: 'history',
    routes
})


router.beforeEach((to, from,next)=>{
    let parentMiddleware = to.matched[0].meta.middleware;
    let childMiddleware = to.meta.middleware;
    if(!childMiddleware && !parentMiddleware){
        return next();
    }
    let middleware = [checkAuth];
    if(parentMiddleware){
        middleware = [...middleware, ...parentMiddleware];
    }
    if (childMiddleware) {
        middleware = [...middleware, ...childMiddleware];
    }
    console.log(middleware);
    return next();
})

export default router;