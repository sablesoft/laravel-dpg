<script setup>
import Editable from '@/Components/Editable.vue';
import AddProject from '@/Components/Guide/AddProject.vue';
import Control from '@/Components/Guide/Control.vue';
import Note from '@/Components/Guide/Note.vue';
import { VueDraggableNext } from 'vue-draggable-next';
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
    <div v-if="guide.projectAdding" class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-2">
        <AddProject/>
    </div>
    <div v-if="!guide.projectAdding && guide.projectsId" :id="'project' + guide.projectsId"
         class="py-2 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <div class="note-row">
                    <span class="note-mark">{{ __('Name')}}: </span>
                    <Editable :value="guide.getProject().name" type="input" class="inline"
                              @updated="(text) => guide.updateField('project','name', text)"/>
                </div>
                <div class="note-row">
                    <span class="note-mark">{{ __('Code')}}: </span>
                    <Editable :value="guide.getProject().code" type="input" class="inline"
                              @updated="(text) => guide.updateField('project','code', text)"/>
                </div>
                <div class="note-row">
                    <span class="note-mark">{{ __('Desc')}}: </span>
                    <Editable :value="guide.getProject().text" class="project-desc"
                              @updated="(text) => guide.updateField('project', 'text', text, guide.getProject().id)"/>
                </div>
                <Control :item="guide.getProject()"/>
                <VueDraggableNext :list="guide.getProjectNotes()" @end="(e) => guide.dragged(e)">
                    <Note v-if="guide.tab !== 'ProjectInfo' && !guide.noteAdding"
                          v-for="note in guide.getProjectNotes()" :note="note"/>
                </VueDraggableNext>
            </div>
        </div>
    </div>
</template>
