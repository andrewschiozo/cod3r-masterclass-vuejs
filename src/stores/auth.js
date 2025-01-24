import { ref, computed } from 'vue'
import { defineStore } from 'pinia'
import http from '@/services/http'
import router from '@/router'

export const useAuth = defineStore('auth', () => {
     const token = ref(localStorage.getItem('token'))
     const userData = ref({})
     const isAuth = ref(false)

     
     function setToken(tokenValue) {
          localStorage.setItem('token', tokenValue)
          token.value = tokenValue
     }
     
     function setUserData(userValue) {
          // localStorage.setItem('userData', JSON.stringify(userValue))
          userData.value = userValue
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
          token.value = null
          userData.value = {}
          isAuth.value = false

          router.push({ name: 'login' })
     }

     return {
          setToken,
          setUserData,
          checkToken,
          setIsAuth,
          logout,
          isAuth,
          token,
          userData
     }
})