<template>
    <div class="componente">
        <h1>Componente com Renderização Condicional</h1>
        <p>Nome: {{ nome }}</p>
        <label>Qtd Cachorros: </label>
        <input type="number" v-model="qtdCachorros" min="0"/>
        <p v-if="qtdCachorros === 0">Não tem cachorros</p>
        <p v-else-if="qtdCachorros === 1">Tem um cachorro</p>
        <p v-else>Tem muitos cachorros</p>
    </div>
</template>

<script setup>
    // import { ref, defineProps } from 'vue'
    import { ref } from 'vue'

    const qtdCachorros = ref(0)

    defineProps({
        nome: String,
        qtdCachorros: Number
    })
</script>