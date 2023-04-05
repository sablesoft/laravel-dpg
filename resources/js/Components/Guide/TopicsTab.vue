<script setup>
import Editable from '@/Components/Editable.vue';
import AddTopic from '@/Components/Guide/AddTopic.vue';

import { guide } from "@/guide";
const props = defineProps({
    topics: {
        type: Object,
        required: true
    }
});

</script>

<style>
.note-mark {
    font-weight: bold;
}
.note-row {
    margin-bottom: 8px;
}
button {
    background-color: #fff;
    border-color: #6b7280;
    border-width: 1px;
    border-radius: 0;
    padding: 0.5rem 0.75rem;
    font-size: 1rem;
    line-height: 1.5rem;
    --tw-shadow: 0 0 #0000;
    margin-left: 6px;
}
</style>

<template>
    <!-- Topics Control Tab -->
    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <select v-model="guide.topicsId" v-if="!guide.isAddTopic">
                <option :value="null">{{ __('Select Topic, or') }}</option>
                <option v-for="topic in topics" :value="topic.id">
                    {{ topic.name }}
                </option>
            </select>
            <button v-if="!guide.topicsId && !guide.isAddTopic"
                    @click="guide.isAddTopic = true">{{ __('Create New')}}</button>
            <button v-if="guide.topicsId" @click="guide.delete('topics')">
                {{ __('Delete')}}
            </button>
            <AddTopic v-if="guide.isAddTopic"/>
        </div>
    </div>
    <!-- Topic Info -->
    <div v-if="guide.topicsId" class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4 text-gray-900">
                    <p class="note-row">
                        <span class="note-mark">{{ __('Name')}}: </span>
                        <Editable :text="guide.getTopicField('name')"
                                  @updated="(text) => guide.updateTopic(text, 'name')"/>
                    </p>
                    <p class="note-row">
                        <span class="note-mark">{{ __('Desc')}}: </span>
                        <Editable :text="guide.getTopicField('desc')"
                                  @updated="(text) => guide.updateTopic(text, 'desc')"/>
                    </p>
                    <p class="note-row">
                        <span class="note-mark">{{ __('Project')}}:</span>
                        {{ guide.getTopicProject() ? guide.getTopicProject().name : __('Global')}}
                    </p>
                    <p class="note-row">
                        <span class="note-mark">{{ __('Created At')}}:</span>
                        {{ guide.getTopicField('createdAt') }}
                    </p>
                    <p class="note-row">
                        <span class="note-mark">{{ __('Updated At')}}:</span>
                        {{ guide.getTopicField('updatedAt') }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</template>
