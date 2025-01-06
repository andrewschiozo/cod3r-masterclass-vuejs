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
import RenderizacaoListas from './components/RenderizacaoListas.vue';
import Slots from './components/Slots.vue';

const item = {
  item: 'Apontador',
  preco: 1.50
}

const cachorrosDoVicente = [
  { nome: 'Rex', idade: 2},
  { nome: 'Toby', idade: 1}
]
</script>

<template>
  <header>
    Vue
  </header>
  <Slots>
    <svg  xmlns="http://www.w3.org/2000/svg"  width="16"  height="16"  viewBox="0 0 24 24"  fill="currentColor"  class="icon icon-tabler icons-tabler-filled icon-tabler-home"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12.707 2.293l9 9c.63 .63 .184 1.707 -.707 1.707h-1v6a3 3 0 0 1 -3 3h-1v-7a3 3 0 0 0 -2.824 -2.995l-.176 -.005h-2a3 3 0 0 0 -3 3v7h-1a3 3 0 0 1 -3 -3v-6h-1c-.89 0 -1.337 -1.077 -.707 -1.707l9 -9a1 1 0 0 1 1.414 0m.293 11.707a1 1 0 0 1 1 1v7h-4v-7a1 1 0 0 1 .883 -.993l.117 -.007z" /></svg>
    Home
  </Slots>
  <RenderizacaoListas nome="Vicente" :cachorros="cachorrosDoVicente" />
  <RenderizacaoCondicional nome="João" :qtdCachorros="1"/>
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
