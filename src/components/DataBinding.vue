<template>
    <div class="componente">
        <h1>Componente com Data Binding</h1>
        <label>1 way data binding</label>
        <br /><input type="text" 
                     v-bind:value="valor" />

        <br /><br />

        <label>2 way data binding (v-bind/@input)</label>
        <br /><input type="text" 
                     v-bind:value="valor"
                     @input="(e) => valor = e.target.value" />

        <br /><br />
        <label>2 way data binding (v-model)</label>
        <br /><input type="text" v-model="valor" />

        <p>{{ valor }}</p>
    </div>
</template>

<script setup>
    import {ref} from 'vue'

    const valor = ref('Vue JS!')

</script>
