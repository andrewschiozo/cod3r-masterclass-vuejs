import { defineStore } from "pinia";

export const usePedidoStore = defineStore("pedido", {

    // state
    state: () => ({
        pedido: {},
    }),

    // actions
    actions: {
        setPedido(pedido) {
            this.pedido = pedido;
        },
        clearPedido() {
            console.log('clear pedido')
            this.pedido = {};
        },
    },

    // getters
    getters: {
        getPedido: (state) => state.pedido,
    },
});