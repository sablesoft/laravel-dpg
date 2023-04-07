<script setup>
import {ref} from "vue";
let props = defineProps(['placeholder', 'action', 'items', 'keepValues']);
const emit = defineEmits(['change']);
let select = ref(null);
let onChange = function(event) {
    emit('change', event.target.value);
    if (!props.keepValues) {
        select.value.value = "_";
    }
}
</script>

<template>
    <select class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150"
              @change="onChange" ref="select">
        <option value="_" selected disabled>{{ placeholder ? __(placeholder) : __('Select') }}</option>
        <option v-if="action" :value="action.id">{{ __(action.name) }}</option>
        <option v-for="item in items" :value="item.id">
            {{ item.name }}
        </option>
    </select>
</template>
