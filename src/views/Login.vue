<template>
    <div class="componente">
        <h1>Login</h1>

        <form @submit.prevent="login">
            <input v-model="user.username" type="email" placeholder="E-mail">
            <input v-model="user.password" type="password" placeholder="Senha">

            <button class="btn">Entrar</button>
        </form>
    </div>
</template>

<script setup>
    import http from '@/services/http'
    import { reactive } from 'vue';
    import { useAuth } from '@/stores/auth';
    import router from '@/router'
    import { toast } from 'vue3-toastify';

    const auth = useAuth()

    const user = reactive({
        username: 'u1@mail.com',
        password: '123456'
    })

    const parseJwt = (token) => {
        const base64Url = token.split('.')[1];
        const base64 = base64Url.replace(/-/g, '+').replace(/_/g, '/');
        const jsonPayload = decodeURIComponent(atob(base64).split('').map((c) => `%${(`00${c.charCodeAt(0).toString(16)}`).slice(-2)}`).join(''));
        return JSON.parse(jsonPayload);
    }


    async function login() {
        try {
            const { data } = await http.post('/login', user)
            auth.setToken(data.token)
            auth.setUserData(parseJwt(data.token).userData)
            auth.setIsAuth(true)
            router.push({ name: 'profile' })
        } catch (error) {
            toast(error?.response?.data?.message ? error.response.data.message : error.message, { type: 'error' })
        }
    }
</script>