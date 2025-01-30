<script setup>
  import { useAuth } from '../stores/auth'

  const auth = useAuth()
</script>

<template>
    <nav>
        <div class="componente">
        <!-- <h1>Componente com VueRouter</h1> -->
        <RouterLink to="/">Home</RouterLink>
        <template v-if="auth.isAuth">
          <RouterLink to="/link1">Link 1</RouterLink>
          <RouterLink to="/link2">Link 2</RouterLink>
          <RouterLink to="/pedido/listar">Pedidos</RouterLink>
          <RouterLink to="/profile">Profile</RouterLink>
            <a href="#" @click="auth.logout">Logout</a>        
        </template>
        <template v-else>
            <RouterLink to="/login">Login</RouterLink>
        </template>
        </div>
    </nav>
</template>

<style scoped>
  .componente {
    border: none;
    background-color: transparent;
  }
  nav a {
    margin-right: 10px;
    text-decoration: none;
    color: #fff;
    font-weight: bold;
    padding: 5px 10px;
  }
  nav a.router-link-active {
    color: #FFF;
    background-color: #42b983;
    border-radius: 5px;
  }
</style>
