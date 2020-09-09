import Vue from 'vue'
import VueRouter from 'vue-router'
import routes from './routes'
import checkAuth from '../middleware/check-auth';
import store from '../store/store'
import middlewarePipeline from './middlewarePipeline';

Vue.use(VueRouter);


const router = new VueRouter({
    linkExactActiveClass: 'active',
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
    let context = {
        to,from,next,store
    }

    return middleware[0]({
        ...context, pipe: middlewarePipeline(context,middleware,1)
    })
})

export default router;