<template>
    <div class="componente">
        <h1>Login</h1>

        <form @submit.prevent="login">
            <input v-model="user.username" type="email" placeholder="E-mail">
            <input v-model="user.password" type="password" placeholder="Senha">

            <button>Entrar</button>
        </form>
    </div>
</template>

<script setup>
    import http from '@/services/http'
    import { reactive } from 'vue';
    import { useAuth } from '@/stores/auth';

    const auth = useAuth()

    const user = reactive({
        username: 'u1@mail.com',
        password: '123456'
    })

    async function login() {
        try {
            const { data } = await http.post('/login', user)
            auth.setToken(data.token)
            auth.setUser(data.user)
            auth.setIsAuth(true)
        } catch (error) {
            console.log(error?.response?.data)
        }
    }
</script>