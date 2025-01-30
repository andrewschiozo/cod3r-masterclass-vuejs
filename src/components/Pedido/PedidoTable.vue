<template>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Cliente</th>
                <th>Vl. Total</th>
                <th>Qtd. Itens</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <PedidoRow v-for="pedido in pedidos" :key="pedido.order" :pedido="pedido" @removerPedido="removerPedido" @editarPedido="editarPedido"/>
        </tbody>
    </table>
</template>

<script setup>
    // defineProps({ pedidos: Array })
    import PedidoRow from './PedidoRow.vue'
    import router from '@/router'

    const props = defineProps({ pedidos: Array })

    function removerPedido(pedido) {
        props.pedidos.splice(props.pedidos.indexOf(pedido), 1)
    }
    
    function editarPedido(pedido) {
        router.push({ name: 'pedidoform' })
    }
</script>

<style scoped>
    table {
        border-collapse: collapse;
        width: 100%;
        margin-top: 10px;
        margin-bottom: 10px;
    }
    thead {
        border-bottom: 2px solid #FFF;
    }
    th:nth-child(2) {
        text-align: left
    }
</style>