<script setup>
import {nextTick, ref, shallowRef} from "vue";

const emit = defineEmits(['updated']);
const props = defineProps(['text', 'resource']);

const textarea = ref(null);
const editMode = shallowRef(false);
const cache = shallowRef(null);

let edit = function() {
    editMode.value = !editMode.value;
    if (editMode.value) {
        cache.value = props.text;
        nextTick(() => {
            textarea.value.focus();
        });
    } else {
        if (cache.value !== props.text) {
            emit('updated', props.text);
        }
    }
}
</script>

<style>
textarea {
    width: 100%;
}
</style>

<template>
    <template v-if="editMode">
        <textarea v-model="props.text" ref="textarea" @blur="edit"/>
    </template>
    <template v-else>
        <span @dblclick="edit">
          {{ text ? text : '-----' }}
        </span>
    </template>
</template>
