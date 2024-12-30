<template>
    <div class="componente">
        <h1>Componente com dados reativos não primitivos</h1>
        <p>{{ pessoa.nome }} | {{ pessoa.idade }}</p>
        <button @click="fazerAniversario()">Fazer aniversário</button>
        <!-- @ é um alias para v-on: -->
        <button @click="mudarNome">Mudar Nome</button>
    </div>
</template>

<!-- <script setup>
    import { reactive } from 'vue'

    const pessoa = reactive({
        nome: 'João',
        idade: 1
    })


    function fazerAniversario() {
        pessoa.idade++
    }

    function mudarNome() {
        pessoa.nome = pessoa.nome === 'João' ? 'Vicente' : 'João'
    }

</script> -->

<script >
    export default {
        data() {
            return {
                pessoa: {
                    nome: 'João',
                    idade: 1
                }
            }
        }
        ,methods: {
            fazerAniversario() {
                this.pessoa.idade++
            },
            mudarNome() {
                this.pessoa.nome = this.pessoa.nome === 'João' ? 'Vicente' : 'João'
            }
        }
    } 

</script>