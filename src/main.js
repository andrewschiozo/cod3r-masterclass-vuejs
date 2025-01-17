import './assets/main.css'

import { createApp, markRaw } from 'vue'
import router from './router'
import { createPinia } from 'pinia'
import { useAuth } from '@/stores/auth'

import App from './App.vue'

const app = createApp(App)
const pinia = createPinia()
// pinia.use(({ store }) => { store.router = markRaw(router) })

app.use(pinia)
app.use(router)

console.log('main')

if(localStorage.getItem('token')) {
    //iife
    (async () => {
        const auth = useAuth()
        try{
            auth.setIsAuth(true)
            await auth.checkToken()
        } catch (error) {
            auth.logout()
        }
    })()
}
    
app.mount('#app')
