<script setup>
import Editable from '@/Components/Editable.vue';
import AddProject from '@/Components/Guide/AddProject.vue';
import Control from '@/Components/Guide/Control.vue';
import Note from '@/Components/Guide/Note.vue';
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
    <div v-if="guide.isAddProject" class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <AddProject/>
        </div>
    </div>
    <div v-if="!guide.isAddProject && guide.projectsId" class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-4 text-gray-900">
                <div class="note-row">
                    <span class="note-mark">{{ __('Name')}}: </span>
                    <Editable :text="guide.getProject().name" type="input" class="inline"
                              @updated="(text) => guide.updateField('projects','name', text)"/>
                </div>
                <div class="note-row">
                    <span class="note-mark">{{ __('Code')}}: </span>
                    <Editable :text="guide.getProject().code" type="input" class="inline"
                              @updated="(text) => guide.updateField('projects','code', text)"/>
                </div>
                <Control :item="guide.getProject()"/>
                <Note v-if="!guide.isAddNote" v-for="note in guide.getProjectNotes()" :note="note"/>
            </div>
        </div>
    </div>
</template>
