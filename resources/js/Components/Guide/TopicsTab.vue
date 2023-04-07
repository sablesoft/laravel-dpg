<script setup>
import Editable from '@/Components/Editable.vue';
import AddTopic from '@/Components/Guide/AddTopic.vue';
import Control from '@/Components/Guide/Control.vue';
import { guide } from "@/guide";
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
    <!-- Add Topic -->
    <div v-if="!guide.topicsId && guide.isAddTopic" class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-2">
        <AddTopic/>
    </div>
    <!-- Topic Info -->
    <div v-if="guide.topicsId && !guide.isAddTopic" :id="'topic' + guide.topicsId"
         class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-2">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <p class="note-row">
                    <span class="note-mark inline">{{ __('Name')}}: </span>
                    <Editable :value="guide.getTopicField('name')" type="input" class="inline"
                              @updated="(text) => guide.updateField('topics', 'name', text)"/>
                </p>
                <p class="note-row">
                    <span class="note-mark">{{ __('Project')}}: </span>
                    {{ guide.getTopicProject() ? guide.getTopicProject().name : __('Global')}}
                </p>
                <Control :item="guide.getTopic()"/>
                <p class="note-row">
                    <span class="note-mark">{{ __('Desc')}}</span>
                    <Editable :value="guide.getTopicField('desc')"
                              @updated="(text) => guide.updateField('topics', 'desc', text)"/>
                </p>
            </div>
        </div>
    </div>
</template>
