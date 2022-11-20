<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Board from '@/Components/Board.vue';
import { Head } from '@inertiajs/inertia-vue3';

defineProps({
    game: Object,
});

</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Dashboard') }}
            </h2>
        </template>

        <Board/>
    </AuthenticatedLayout>
</template>
