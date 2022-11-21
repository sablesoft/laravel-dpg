<script setup>
import GameLayout from '@/Layouts/GameLayout.vue';
import Board from '@/Components/Board/Board.vue';
import { Head } from '@inertiajs/inertia-vue3';

defineProps({
    game: Object,
});

</script>

<template>
    <Head title="Game" />

    <GameLayout>
        <Board/>
    </GameLayout>
</template>
