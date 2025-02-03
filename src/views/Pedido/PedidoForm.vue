
<script setup>
    import router from '@/router';
    import http from '@/services/http'
    import { useAuth } from '@/stores/auth';
    import { ref } from 'vue';
    import { toast } from 'vue3-toastify';
    import { usePedidoStore } from '@/stores/Pedido/PedidoStore';

    const id = ref(0)
    const cliente = ref('')
    const vlTotal = ref(0)
    const qtdItens = ref(0)

    const pedidoStore = usePedidoStore()
    const pedidoEditavel = pedidoStore.getPedido
    console.log('receive: ', pedidoEditavel)

    if(pedidoEditavel) {
        id.value = pedidoEditavel.id
        cliente.value = pedidoEditavel.client
        vlTotal.value = pedidoEditavel.amount
        qtdItens.value = pedidoEditavel.items
    }

    

    const salvar = async function () {
        const user = { headers: { Authorization: 'Bearer ' + useAuth().token } }

        try {
            const { data }  = await http.post('/order', {
                order: id.value,
            }, user)
            console.log(data)
            toast('Pedido salvo com sucesso', { autoClose: 1000, type: 'success', onOpen: () => router.push({ name: 'pedidos' }) })
        } catch (error) {
            toast(error?.response?.data?.message ? error.response.data.message : error.message, { type: 'error' })
        }
    }
</script>

<template>
    <div class="componente">
        <h1>Pedido pedidos.order</h1>
        
        <form @submit.prevent="salvar"> 
            <label>ID</label>
            <input type="text" v-model="id" placeholder="ID">

            <label>Cliente</label>
            <input type="text" v-model="cliente" placeholder="Cliente">

            <label>Vl. Total</label>
            <input type="number" v-model="vlTotal" placeholder="Vl. Total">
            
            <label>Qtd. Itens</label>
            <input type="number" v-model="qtdItens" placeholder="Qtd. Itens">
            
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