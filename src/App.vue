<script setup>
  import Menu from './components/Menu.vue';
  import { useAuth } from './stores/auth';
  const auth = useAuth()
</script>

<template>
  <header>
    Olá, 
    <template v-if="auth.isAuthenticated">
      {{ auth.user }}
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