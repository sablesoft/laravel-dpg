<script setup>
import Editable from '@/Components/Editable.vue';
import Control from '@/Components/Guide/Control.vue';
import { guide } from "@/guide";
</script>
<style>
.buffer-tab textarea {
    height: 26em !important;
}
.buffer-tab .editable-text {
    max-height: 100%;
    white-space: pre-wrap;
}
.buffer-tab .editable-text:before {
    content: none;
    background: none;
}
</style>
<template>
    <div :id="'buffer' + guide.buffersId"
         class="buffer-tab max-w-7xl mx-auto sm:px-6 lg:px-8 py-2">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <h2 class="block-title cursor-pointer">
                    {{ __('Buffer') }}
                </h2>
                <Control entity="buffer" :item="guide.getItem('buffer')"/>
                <Editable :value="guide.getField('buffer', 'text')"
                          @updated="(text) => guide.updateField('buffer', 'text', text)"/>
            </div>
        </div>
    </div>
</template>
