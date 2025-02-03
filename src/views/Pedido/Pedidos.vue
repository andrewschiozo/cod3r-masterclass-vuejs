
<script setup>
    import PedidoTable from '@/components/Pedido/PedidoTable.vue';
    import http from '@/services/http'
    import { useAuth } from '@/stores/auth';
    import { usePedidoStore } from '@/stores/Pedido/PedidoStore';
    import { ref } from 'vue';

    const pedidos = ref([])
    const pedidoStore = usePedidoStore()

    const getOrders = async function () {        
        const user = { headers: { Authorization: 'Bearer ' + useAuth().token }}

        try {
            const { data } = await http.get('/order', user)
            pedidos.value = data.data
        } catch (error) {
            console.log(error)
        }
    }()

</script>

<template>
    <div class="componente">
        <h1>Pedidos</h1>
        <RouterLink class="btn" to="/pedido/form" @click="pedidoStore.clearPedido" >Novo Pedido</RouterLink>
        <PedidoTable :pedidos="pedidos"/>
    </div>
</template>
