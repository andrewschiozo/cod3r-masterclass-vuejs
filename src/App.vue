<script setup>
import ComDados from './components/ComDados.vue';
import ComDadosReativos from './components/ComDadosReativos.vue';
import ComDadosReativosNaoPrimitivos from './components/ComDadosReativosNaoPrimitivos.vue';
import ComProps from './components/ComProps.vue';
import DataBinding from './components/DataBinding.vue';
import PrimeiroComponente from './components/PrimeiroComponente.vue';
</script>

<template>
  <header>
    Vue
  </header>
  <ComProps item="Borracha" v-bind:preco="2.50" />
  <ComProps item="Caneta" :preco="2.99" />
  <ComProps item="Caderno" :preco="2.25" />
  <DataBinding />
  <ComDadosReativosNaoPrimitivos />
  <ComDadosReativos />
  <ComDados />
  <PrimeiroComponente />
</template>

<style scoped>
</style>
