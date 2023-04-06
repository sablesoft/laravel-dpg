<script setup>
import SecondaryButton from "@/Components/SecondaryButton.vue";

import { guide } from "@/guide";
const props = defineProps({
    entity: {
        type: Object,
        required: true
    }
});
</script>

<style>
</style>

<template>
    <div class="block-footer">
        <hr/>
        <div class="float-left">
            <div>
                <span class="note-mark">{{ __('Created At')}}: </span>
                <span> {{ entity.createdAt }}</span>
            </div>
            <div>
                <span class="note-mark">{{ __('Updated At')}}: </span>
                <span> {{ entity.updatedAt }}</span>
            </div>
        </div>
        <SecondaryButton v-if="guide.backLink" @click="guide.goBack()" class="float-right">
            {{__('Go Back')}}
        </SecondaryButton>
        <div style="clear:both;"></div>
    </div>
</template>
