<script setup>
import InputLabel from '@/Components/InputLabel.vue';
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
});

let topicChange = function(value) {
    form.topicId = value;
}
let ready = function() {
    return form.topicId;
}
</script>

<style>
</style>

<template>
    <form @submit.prevent="guide.createTag(form, item)">
        <h2 class="action-title">{{__('Add Tag')}}</h2>
        <div>
            <InputLabel for="selectTopic" :value="__('Topic')" />
            <Select id="selectTopic" placeholder="Select Topic" class="mt-1 block w-full"
                    keep-values="1"
                    @change="topicChange" :items="guide.getSortedTopics()"/>
        </div>
        <ControlAdd :ready="ready()" :processing="form.processing"/>
    </form>
</template>
