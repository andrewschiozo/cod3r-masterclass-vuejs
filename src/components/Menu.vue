<template>
    <nav>
        <div class="componente">
        <h1>Componente com VueRouter</h1>
        <RouterLink to="/">Home</RouterLink>
        <RouterLink to="/link1">Link 1</RouterLink>
        <RouterLink to="/link2">Link 2</RouterLink>
        </div>
    </nav>
</template>

<script setup>
</script>

<style scoped>
  nav a {
    margin-right: 10px;
    text-decoration: none;
    color: #fff;
    font-weight: bold;
  }
  nav a.router-link-active {
    color: #42b983;
  }
</style>
