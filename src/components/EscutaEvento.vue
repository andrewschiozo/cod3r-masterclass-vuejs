<template>
    <div class="componente">
        <h1>Componente Escuta Evento</h1>
        <p>Total: R$ {{ total }}</p>

        <div class="lista">
            <EmiteEvento item="Item 1" :preco="1.99" @adicionarAoCarrinho="atualizarTotal"/>
            <EmiteEvento item="Item 2" :preco="5.00" @adicionarAoCarrinho="atualizarTotal"/>
            <EmiteEvento item="Item 3" :preco="10.99" @adicionarAoCarrinho="atualizarTotal"/>
        </div>
    </div>
</template>

<script setup>
    import EmiteEvento from './EmiteEvento.vue';
    import { ref } from 'vue'

    const total = ref(0)

    function atualizarTotal(item) {
        total.value += item.preco
    }
</script>

<style scoped>
    .lista {
        display: flex;
        justify-content: space-between;
    }
</style>