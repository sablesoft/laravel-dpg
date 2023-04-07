<script setup>
import {nextTick, ref, shallowRef} from "vue";
import Select from '@/Components/Select.vue';
const emit = defineEmits(['updated']);
const props = defineProps(['value', 'type', 'items', 'action']);

const input = ref(null);
const editMode = shallowRef(false);
const cache = shallowRef(null);
let change = function(value) {
    props.value.value = value;
    edit();
}
let edit = function() {
    editMode.value = !editMode.value;
    if (editMode.value) {
        cache.value = props.value;
        nextTick(() => {
            input.value.focus();
        });
    } else {
        if (cache.value !== props.value) {
            emit('updated', props.value);
        }
    }
}
let text = function() {
    if (props.type !== 'select') {
        return props.value;
    }
    let text = null;
    props.items.forEach(function(item) {
        if (parseInt(item.id) === parseInt(props.value)) {
            text = item.name;
        }
    });

    return text;
}
</script>
<style>
</style>
<template>
    <template v-if="editMode">
        <div @keydown.stop @click.stop>
            <input v-if="type === 'input'" @keydown.esc.stop="$event.target.blur()" class="mt-1 block w-full"
                   v-model="props.value" ref="input" @blur="edit" />
            <textarea v-if="!type" @keydown.esc.stop="$event.target.blur()" class="mt-1 block w-full"
                      v-model="props.value" rows="8" ref="input" @blur="edit" />
            <Select v-if="type === 'select'" :value="props.value" class="mt-1 block w-full"
                    keep-values="1" ref="input" :action="action"
                    @keydown.esc.stop="$event.target.blur()" @blur="edit"
                    @change="change" :items="items"/>
        </div>
    </template>
    <template v-else>
        <p @dblclick="edit" class="editable-text">
          {{ text() ? text() : '-----' }}
        </p>
    </template>
</template>
