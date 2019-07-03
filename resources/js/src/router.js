import Vue from 'vue'
import Router from 'vue-router'

Vue.use(Router);

import store from './store/store'

const ifNotAuthenticated = (to, from, next) => {
    if (!store.getters.isAuthenticated) {
        next();
        return
    }
    next('/')
}

const ifAuthenticated = (to, from, next) => {
    if (store.getters.isAuthenticated) {
        next();
        return
    }
    next('/login')
}

const router = new Router({
    mode: 'history',
    base: '/',
    routes: [

        {
            // =============================================================================
            // MAIN LAYOUT ROUTES
            // =============================================================================
            path: '',
            component: () => import('./layouts/main/Main.vue'),
            children: [
                // =============================================================================
                // Theme Routes
                // =============================================================================
                {
                    path: '/',
                    name: 'home',
                    beforeEnter: ifAuthenticated,
                    component: () => import('./views/Home.vue'),
                },
                {
                    path: '/projects',
                    name: 'projects',
                    beforeEnter: ifAuthenticated,
                    component: () => import('./views/projects/ListProjects.vue'),
                },
                {
                    path: '/projects/new',
                    name: 'new-project',
                    beforeEnter: ifAuthenticated,
                    component: () => import('./views/projects/NewProject.vue'),
                },
            ],
        },
        // =============================================================================
        // FULL PAGE LAYOUTS
        // =============================================================================
        {
            path: '',
            component: () => import('@/layouts/full-page/FullPage.vue'),
            children: [
                // =============================================================================
                // PAGES
                // =============================================================================
                {
                    path: '/login',
                    name: 'pageLogin',
                    beforeEnter: ifNotAuthenticated,
                    component: () => import('@/views/security/Login.vue')
                },
                {
                    path: '/register',
                    name: 'pageRegister',
                    beforeEnter: ifNotAuthenticated,
                    component: () => import('@/views/security/Register.vue')
                },
                {
                    path: '/pages/error-404',
                    name: 'pageError404',
                    beforeEnter: ifNotAuthenticated,
                    component: () => import('@/views/pages/Error404.vue')
                },
            ]
        },
        // Redirect to 404 page, if no match found
        {
            path: '*',
            redirect: '/pages/error-404'
        }
    ],
})

export default router
