import { ref, computed } from 'vue'
import { defineStore } from 'pinia'
import http from '@/services/http'

export const useAuth = defineStore('auth', () => {
     const token = ref(localStorage.getItem('token'))
     const user = ref(JSON.parse(localStorage.getItem('user')))
     
     function setToken(tokenValue) {
          localStorage.setItem('token', tokenValue)
          token.value = tokenValue
     }
     
     function setUser(userValue) {
          localStorage.setItem('user', JSON.stringify(userValue))
          user.value = userValue
     }
     
     async function checkToken() {
          try {
               const tokenAuth = `Bearer ${token.value}`
               const { data } = await http.get('/auth/verify', { headers: { Authorization: tokenAuth } })
               return data
          } catch (error) {
               console.log(error?.response?.data)
          }
     }

     const isAuthenticated = computed(() => {
          return token.value && user.value
     })

     function logout() {
          localStorage.removeItem('token')
          localStorage.removeItem('user')
          token.value = null
          user.value = null
     }

     return {
          setToken,
          setUser,
          checkToken,
          isAuthenticated,
          logout,
          token,
          user
     }
})