<script setup>
  import Menu from './components/Estudo/Menu.vue';
  import { useAuth } from './stores/auth';
  const auth = useAuth()
</script>

<template>
  <header>
    Olá, 
    <template v-if="auth.isAuth">
      {{ auth.userData.firstName }}
    </template>
    <template v-else>
      visitante
    </template>
  </header>
  
  <Menu />

  <main>
    <RouterView />
  </main>

</template>