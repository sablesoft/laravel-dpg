<script setup>
import InputLabel from '@/Components/InputLabel.vue';
import TextareaInput from '@/Components/TextareaInput.vue';
import ControlAdd from "@/Components/Guide/ControlAdd.vue";
import Select from "@/Components/Select.vue";

import { guide } from "@/guide";
import { useForm } from "@inertiajs/inertia-vue3";
const props = defineProps({
    item: {
        type: Object,
        required: true
    }
});
const form = useForm({
    topicId: null,
    text: null
});

let topicChange = function(value) {
    form.topicId = value;
}
let ready = function() {
    return form.topicId && form.text;
}
</script>

<style>
</style>

<template>
    <form @submit.prevent="guide.createNote(form, item)">
        <h2 class="action-title">{{__('Create Note')}}</h2>
        <div>
            <InputLabel for="selectTopic" :value="__('Topic')" />
            <Select id="selectTopic" placeholder="Select Topic" class="mt-1 block w-full"
                    keep-values="1"
                    @change="topicChange" :items="guide.topics"/>
        </div>
        <div>
            <InputLabel for="text" :value="__('Content')" />
            <TextareaInput id="text" class="mt-1 block w-full"
                       @click.stop @keydown.stop @keyup.stop
                       v-model="form.text" required />
        </div>
        <ControlAdd :ready="ready()" :processing="form.processing"/>
    </form>
</template>
