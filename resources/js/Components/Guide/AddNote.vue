<script setup>
import InputLabel from '@/Components/InputLabel.vue';
import TextareaInput from '@/Components/TextareaInput.vue';
import ControlAdd from "@/Components/Guide/ControlAdd.vue";

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
    content: null
});

let ready = function() {
    return form.topicId && form.content;
}
</script>

<style>
</style>

<template>
    <form @submit.prevent="guide.createNote(form, item)">
        <h2 class="action-title">{{__('Create Note')}}</h2>
        <div>
            <InputLabel for="topic" :value="__('Topic')" />
            <select v-model="form.topicId" required class="mt-1 block w-full" @click.prevent.stop="">
                <option :value="null" disabled>{{ __('Select Note Topic') }}</option>
                <option v-for="topic in guide.topics" :value="topic.id">
                    {{ topic.name }}
                </option>
            </select>
        </div>
        <div>
            <InputLabel for="content" :value="__('Content')" />
            <TextareaInput id="content" class="mt-1 block w-full"
                       @click.stop @keydown.stop @keyup.stop
                       v-model="form.content" required />
        </div>
        <ControlAdd :ready="ready()" :processing="form.processing"/>
    </form>
</template>
