import { createMemoryHistory, createRouter } from 'vue-router'
import { useAuth } from '@/stores/auth';

import Home from './views/Home.vue'
import Link1 from './views/Link1.vue'

const routes = [
    { path: '/', component: Home },
    { path: '/Link1', component: Link1, meta: { requiresAuth: true } },
    { 
        path: '/Link2',
        name: 'link2',

        //lazy-loading
        component: () => import('./views/Link2.vue'),
        meta: { requiresAuth: true }
    },
    { path: '/pedido/listar', name: 'pedidos', component: () => import('./views/Pedido/Pedidos.vue'), meta: {requiresAuth: true} },
    { path: '/pedido/form', name: 'pedidoform', component: () => import('./views/Pedido/PedidoForm.vue'), meta: {requiresAuth: true} },
    { path: '/Profile', name: 'profile', component: () => import('./views/Profile.vue'), meta: {requiresAuth: true} },
    { path: '/Login', name: 'login', component: () => import('./views/Login.vue') },
]

const router = createRouter({
  history: createMemoryHistory(),
  routes,
})

router.beforeEach(async (to, from, next) => {
    if(to.meta?.requiresAuth) {
        const auth = useAuth()
        auth.isAuth ? next() : next({ name: 'login' })
        return
    }
    return next() 
})
export default router