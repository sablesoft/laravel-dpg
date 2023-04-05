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
                <SecondaryButton v-if="!guide.isAddTopic" @click="guide.isAddTopic = !guide.isAddTopic">
                    {{__('Add Topic')}}
                </SecondaryButton>
                <AddTopic/>
                <br/><br/><hr/><br/>
                <div v-for="topic in guide.getProjectTopics()" v-if="!guide.isAddTopic" class="note-row">
                    <span class="note-mark">{{ __('Name')}}: </span>
                    <Editable :text="topic.name"
                              @updated="(text) => guide.updateTopic(text, 'name', topic.id)"/>
                    <br/>
                    <span class="note-mark">{{ __('Desc')}}: </span>
                    <Editable :text="topic.desc"
                              @updated="(text) => guide.updateTopic(text, 'desc', topic.id)"/>
                    <br/><br/>
                    <SecondaryButton @click="guide.delete('topics', topic.id)">
                        {{__('Delete')}}
                    </SecondaryButton>
                    <br/><br/><hr/>
                </div>
            </div>
        </div>
    </div>
</template>
