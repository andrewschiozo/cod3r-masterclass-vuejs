<template>
    <div class="componente">
        <h1>Componente com Slots</h1>
        <button>
            <slot name="icone" /> <slot name="texo" />
        </button>
    </div>
</template>