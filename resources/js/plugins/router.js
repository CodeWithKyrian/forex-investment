import Vue from 'vue'
import VueRouter from 'vue-router'
import { routes } from '../routes';

Vue.use(VueRouter)

const router = new VueRouter({
    routes,
    mode: 'history'
})

router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.requiresAuth)) {
        if (store.getters.isAuthenticated)
            next()
        else
            next({
                path: '/login',
                query: { redirect: to.fullPath }
            })
    } else if (to.matched.some(record => record.meta.guest)) {
        if (store.getters.isAuthenticated)
            next('/')
        else
            next()
    } else {
        next()
    }
})

export default router