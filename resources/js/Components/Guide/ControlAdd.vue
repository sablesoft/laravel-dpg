<script setup>
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from "@/Components/SecondaryButton.vue";
import { guide } from "@/guide";
const props = defineProps({
    processing: {
        type: Boolean,
        required: true
    },
    ready: {
        type: Boolean,
        required: true
    }
});
</script>
<style>
</style>
<template>
    <div class="flex items-center justify-end mt-4">
        <SecondaryButton :class="{ 'opacity-25': processing }" :disabled="processing"
                     @click="guide.resetAdding()">
            {{__('Cancel')}}
        </SecondaryButton>
        <PrimaryButton :class="{ 'opacity-25': processing || !ready }" :disabled="processing || !ready">
            {{__('Add')}}
        </PrimaryButton>
    </div>
</template>
