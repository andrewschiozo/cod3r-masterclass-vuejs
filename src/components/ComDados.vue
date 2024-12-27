<template>
  <div>
    <h1>Componente com dados</h1>
    <p>{{ nomeProduto }} - {{ codigoProduto }}</p>
  </div>
</template>

<style scoped>
    div{
        text-align: center;
        border: 2px solid rgb(10, 69, 4);
        background-color: #050d04;
        border-radius: 15px;
        margin: 30px;
        padding: 10px;
    }

    p {
        font-size: 1.2em;
    }
</style>

<!-- Ao utilizar o setup, o script se comporta como composition api -->
<script setup>
const nomeProduto = 'Caneta'
const codigoProduto = '#003'

</script>

<!-- <script> -->
// composition api
// export default {
//   setup() {
//     return {
//       nomeProduto: 'Lápis',
//       codigoProduto: '#002'
//     }
//   }
// }
<!-- </script> -->

<!-- <script> -->
// options api
// export default {
//   data() {
//     return {
//       nomeProduto: 'Caderno',
//       codigoProduto: '#001'
//     }
//   }
// }
<!-- </script> -->
