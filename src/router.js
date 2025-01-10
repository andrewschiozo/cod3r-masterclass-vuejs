import { createMemoryHistory, createRouter } from 'vue-router'


import Home from './views/Home.vue'
import Link1 from './views/Link1.vue'

const routes = [
    { path: '/', component: Home },
    { path: '/Link1', component: Link1 },
    { 
        path: '/Link2',
        name: 'link2',

        //lazy-loading
        component: () => import('./views/Link2.vue')
    },
]

const router = createRouter({
  history: createMemoryHistory(),
  routes,
})

export default router