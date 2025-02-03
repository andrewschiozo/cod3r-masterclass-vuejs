<template>
    <div class="componente">
        <h1>Componente com dados reativos</h1>
        <p>{{ nomePessoa }} | {{ idadePessoa }}</p>
        <button class="btn" v-on:click="fazerAniversario()">Fazer aniversário</button>
        <!-- @ é um alias para v-on: -->
        <button class="btn" @click="mudarNome">Mudar Nome</button>
    </div>
</template>

<script setup>
    // o ref permite a utilização de variáveis reativas
    import { ref } from 'vue'

    const nomePessoa = ref('João')
    const idadePessoa = ref(1)

    function fazerAniversario() {
        idadePessoa.value++
    }

    function mudarNome() {
        nomePessoa.value = nomePessoa.value === 'João' ? 'Vicente' : 'João'
    }

</script>