
<script setup>
    import router from '@/router';
    import http from '@/services/http'
    import { useAuth } from '@/stores/auth';
    import { ref } from 'vue';
    import { toast } from 'vue3-toastify';
    import { usePedidoStore } from '@/stores/Pedido/PedidoStore';

    const order = ref('')
    const cliente = ref('')
    const vlTotal = ref(0)
    const qtdItens = ref(0)

    const pedidoStore = usePedidoStore()
    const pedidoEditavel = pedidoStore.getPedido

    if(pedidoEditavel.order > 0) {
        order.value = pedidoEditavel.order
        cliente.value = pedidoEditavel.client
        vlTotal.value = pedidoEditavel.amount
        qtdItens.value = pedidoEditavel.items
    }

    

    const salvar = async function () {
        const user = { headers: { Authorization: 'Bearer ' + useAuth().token } }

        const orderSend = {
            order: order.value,
            client: cliente.value,
            amount: vlTotal.value,
            items: qtdItens.value
        }

        try {
            const { data }  = await http.post('/ordersave', orderSend, user)
            toast('Pedido salvo com sucesso', { autoClose: 1000, type: 'success', onOpen: () => router.push({ name: 'pedidos' }) })
        } catch (error) {
            toast(error?.response?.data?.message ? error.response.data.message : error.message, { type: 'error' })
        }
    }
</script>

<template>
    <div class="componente">
        <h1>Pedido {{order}}</h1>
        
        <form @submit.prevent="salvar">
            <label>Cliente</label>
            <input type="text" v-model="cliente" placeholder="Cliente" required> 

            <label>Vl. Total</label>
            <input type="number" v-model="vlTotal" placeholder="Vl. Total" min="1" step="0.01" required>
            
            <label>Qtd. Itens</label>
            <input type="number" v-model="qtdItens" placeholder="Qtd. Itens" min="1" step="1" required>
            
            <button class="btn">Salvar</button>
        </form>
    </div>
</template>

<style scoped>
    form {
        display: flex;
        flex-direction: column;
        max-width: 300px;
        margin: 0 auto;
    }

    button {
        margin-top: 10px;
        align-self: center;
        width: 300px;
    }
</style>