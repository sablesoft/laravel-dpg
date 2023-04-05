<script setup>
import {nextTick, ref, shallowRef} from "vue";

const emit = defineEmits(['updated']);
const props = defineProps(['text', 'type']);

const input = ref(null);
const editMode = shallowRef(false);
const cache = shallowRef(null);

let edit = function() {
    editMode.value = !editMode.value;
    if (editMode.value) {
        cache.value = props.text;
        nextTick(() => {
            input.value.focus();
        });
    } else {
        if (cache.value !== props.text) {
            emit('updated', props.text);
        }
    }
}
</script>

<style>
textarea, input {
    width: 100%;
}
.editable-text {
    white-space: pre-wrap;
}
</style>

<template>
    <template v-if="editMode">
        <div @keydown.stop @click.stop>
            <input v-if="type === 'input'" v-model="props.text"
                   ref="input" @blur="edit" />
            <textarea v-if="type !== 'input'" v-model="props.text" rows="8"
                      ref="input" @blur="edit" />
        </div>
    </template>
    <template v-else>
        <p @dblclick="edit" class="editable-text">
          {{ text ? text : '-----' }}
        </p>
    </template>
</template>
