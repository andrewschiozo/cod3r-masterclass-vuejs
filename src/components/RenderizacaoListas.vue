<template>
    <div class="componente">
        <h1>Componente com Renderização de Listas</h1>
        <p>Nome: {{ nome }}</p>
        <ul>
            <li v-for="cachorro in cachorros">
                Nome: {{ cachorro.nome }} | Idade: {{ cachorro.idade }}
            </li>
        </ul>
    </div>
</template>

<script setup>
    import { ref, defineProps } from 'vue'

    defineProps({
        nome: String,
        cachorros: Array
    })
</script>

<style scoped>
    ul {
        margin: 0;
        padding: 0;
    }
    
    li {
        list-style: none;
        text-align: center;
        font-size: large;
    }
</style>