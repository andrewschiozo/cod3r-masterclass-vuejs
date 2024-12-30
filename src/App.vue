<script setup>
import ComDados from './components/ComDados.vue';
import ComDadosReativos from './components/ComDadosReativos.vue';
import ComDadosReativosNaoPrimitivos from './components/ComDadosReativosNaoPrimitivos.vue';
import PrimeiroComponente from './components/PrimeiroComponente.vue';
</script>

<template>
  <header>
    Vue
  </header>
  <ComDadosReativosNaoPrimitivos />
  <ComDadosReativos />
  <ComDados />
  <PrimeiroComponente />
</template>

<style scoped>
</style>
