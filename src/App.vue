<script setup>
import ComDados from './components/ComDados.vue';
import ComDadosReativos from './components/ComDadosReativos.vue';
import ComDadosReativosNaoPrimitivos from './components/ComDadosReativosNaoPrimitivos.vue';
import ComProps from './components/ComProps.vue';
import DataBinding from './components/DataBinding.vue';
import EscutaEvento from './components/EscutaEvento.vue';
import PrimeiroComponente from './components/PrimeiroComponente.vue';
import PropriedadesAssistidas from './components/PropriedadesAssistidas.vue';
import PropriedadesComputadas from './components/PropriedadesComputadas.vue';
import RenderizacaoCondicional from './components/RenderizacaoCondicional.vue';

const item = {
  item: 'Apontador',
  preco: 1.50
}

</script>

<template>
  <header>
    Vue
  </header>
  <RenderizacaoCondicional nome="Andrews" :qtdCachorros="1"/>
  <PropriedadesAssistidas />
  <PropriedadesComputadas />
  <EscutaEvento />
  <ComProps :item="item.item" :preco="item.preco" />
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
