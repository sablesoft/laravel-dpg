<script setup>
import Editable from '@/Components/Editable.vue';
import Control from '@/Components/Guide/Control.vue';
import AddModule from "@/Components/Guide/AddModule.vue";
import Note from '@/Components/Guide/Note.vue';
import DraggableList from '@/Components/Guide/DraggableList.vue';
import { guide } from "@/guide";
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
    <div v-if="guide.moduleAdding" class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-2">
        <AddModule/>
    </div>
    <div v-if="!guide.moduleAdding && guide.modulesId" :id="'module' + guide.modulesId"
         class="py-2 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <div class="note-row">
                    <span class="note-mark">{{ __('Type')}}: </span>
                    <Editable :value="guide.getModuleType() ? guide.getModuleType().id : null"
                              class="inline" type="select" :items="guide.topics"
                              @updated="(value) => guide.updateField('module', 'type_id', value)"/>
                </div>
                <div class="note-row">
                    <span class="note-mark">{{ __('Topic')}}: </span>
                    <Editable :value="guide.getModuleTopic() ? guide.getModuleTopic().id : null"
                              class="inline" type="select" :items="guide.topics"
                              @updated="(value) => guide.updateField('module', 'topic_id', value)"/>
                </div>
                <Control :item="guide.getItem('module')"/>
                <DraggableList :list="guide.getModuleNotes()">
                    <Note v-if="guide.tab !== 'ProjectInfo' && !guide.noteAdding"
                          v-for="note in guide.getModuleNotes()" :note="note"/>
                </DraggableList>
            </div>
        </div>
    </div>
</template>
