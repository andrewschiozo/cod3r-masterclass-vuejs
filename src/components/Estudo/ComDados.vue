<template>
  <div class="componente">
    <h1>Componente com dados</h1>
    <p>{{ nomeProduto }} - {{ codigoProduto }}</p>
  </div>
</template>

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
