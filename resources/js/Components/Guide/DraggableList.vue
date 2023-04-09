<script setup>
import { VueDraggableNext } from 'vue-draggable-next';
import { guide } from "@/guide";
const props = defineProps(['list']);
</script>
<style>
</style>
<template>
    <template v-if="guide.draggable">
        <VueDraggableNext :list="list" @end="(e) => guide.dragged(e)">
            <slot />
        </VueDraggableNext>
    </template>
    <template v-else>
        <slot />
    </template>
</template>
