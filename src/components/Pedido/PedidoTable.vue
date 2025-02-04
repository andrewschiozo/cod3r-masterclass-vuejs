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
            <PedidoRow v-for="pedido in pedidos" :key="pedido.order" :pedido="pedido" @removerPedido="removerPedido(pedido)" @editarPedido="editarPedido"/>
        </tbody>
    </table>
</template>

<script setup>
    // defineProps({ pedidos: Array })
    import PedidoRow from './PedidoRow.vue'
    import router from '@/router'
    import http from '@/services/http'
    import { useAuth } from '@/stores/auth';
    import { usePedidoStore } from '@/stores/Pedido/PedidoStore'
    import { toast } from 'vue3-toastify';

    const props = defineProps({ pedidos: Array })
    const pedidoStore = usePedidoStore()
    pedidoStore.clearPedido()

    async function removerPedido(pedido) {
        const user = { headers: { Authorization: 'Bearer ' + useAuth().token } }
        const orderSend = {
            order: pedido.order
        }

        try {
            const { data }  = await http.post('/orderdelete', orderSend, user)
            props.pedidos.splice(props.pedidos.indexOf(pedido), 1)
            toast('Pedido removido com sucesso', { autoClose: 1000, type: 'success'})
        } catch (error) {
            toast(error?.response?.data?.message ? error.response.data.message : error.message, { type: 'error' })
        }
        
    }
    
    function editarPedido(pedido) {
        pedidoStore.setPedido(pedido)
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