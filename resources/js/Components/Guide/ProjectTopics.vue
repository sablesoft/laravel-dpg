<script setup>
import Editable from '@/Components/Editable.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import AddTopic from '@/Components/Guide/AddTopic.vue';

import { guide } from "@/guide";
import {useForm} from "@inertiajs/inertia-vue3";
const form = useForm({
    name: null,
    desc: null
});

let topics = function() {
    return guide.project ? guide.project.data.topics :
        guide.topics.data;
}

</script>

<style>
.note-mark {
    font-weight: bold;
}
.note-row {
    margin-bottom: 8px;
}
</style>

<template>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-4 text-gray-900">
                <p v-for="topic in topics()" class="note-row">
                    <span class="note-mark">{{ __('Name')}}: </span>
                    <Editable :text="topic.name"
                              @updated="(text) => guide.updateTopic(topic.id, text, 'name')"/>
                    <br/>
                    <span class="note-mark">{{ __('Desc')}}: </span>
                    <Editable :text="topic.desc"
                              @updated="(text) => guide.updateTopic(topic.id, text, 'desc')"/>
                </p>
                <SecondaryButton v-if="!guide.isAddTopic" @click="guide.isAddTopic = !guide.isAddTopic">
                    {{__('Add Topic')}}
                </SecondaryButton>
                <AddTopic/>
            </div>
        </div>
    </div>
</template>
