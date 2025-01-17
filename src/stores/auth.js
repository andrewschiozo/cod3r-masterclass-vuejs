import { ref, computed } from 'vue'
import { defineStore } from 'pinia'
import http from '@/services/http'
import router from '@/router'

export const useAuth = defineStore('auth', () => {
     const token = ref(localStorage.getItem('token'))
     const user = ref(JSON.parse(localStorage.getItem('user')))
     const isAuth = ref(false)

     
     function setToken(tokenValue) {
          localStorage.setItem('token', tokenValue)
          token.value = tokenValue
     }
     
     function setUser(userValue) {
          localStorage.setItem('user', JSON.stringify(userValue))
          user.value = userValue
     }

     function setIsAuth(isAuthValue) {
          isAuth.value = isAuthValue
     }
     
     async function checkToken() {
          try {
               const tokenAuth = `Bearer ${token.value}`
               const { data } = await http.get('/auth/verify', { headers: { Authorization: tokenAuth} })
               return data
          } catch (error) {
               isAuth.value = false
          }
     }

     function logout() {
          localStorage.removeItem('token')
          localStorage.removeItem('user')
          token.value = null
          user.value = null
          isAuth.value = false

          router.push({ name: 'login' })
     }

     return {
          setToken,
          setUser,
          checkToken,
          setIsAuth,
          logout,
          isAuth,
          token,
          user
     }
})