<template>
    <tr>
        <td>{{pedido.order}}</td>
        <td>{{pedido.client}}</td>
        <td>{{pedido.amount}}</td>
        <td>{{pedido.items}}</td>
        <td><button @click="emit('editarPedido', pedido)">Editar</button> <button @click="emit('removerPedido', pedido)">Remover</button></td>
    </tr>
</template>

<script setup>
    defineProps({ pedido: Object })
    const emit = defineEmits(['editarPedido', 'removerPedido'])
</script>

<style scoped>
    td {
        padding: 5px
    }
    td:nth-child(2) {
        text-align: left
    }
</style>