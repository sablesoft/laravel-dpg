<script setup>
import Editable from '@/Components/Editable.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import AddNote from '@/Components/Guide/AddNote.vue';

import { guide } from "@/guide";
import {useForm} from "@inertiajs/inertia-vue3";
const form = useForm({
    topicId: null,
    content: null
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
                <p class="note-row">
                    <span class="note-mark">{{ __('Name')}}: </span>
                    <Editable :text="guide.project.data.name"
                              @updated="(text) => guide.updateProject('name', text)"/>
                </p>
                <p class="note-row">
                    <span class="note-mark">{{ __('Code')}}: </span>
                    <Editable :text="guide.project.data.code"
                              @updated="(text) => guide.updateProject('code', text)"/>
                </p>
                <p v-for="note in guide.project.data.notes" class="note-row">
                    <span class="note-mark">{{ __(note.topic.name)}}: </span>
                    <Editable :text="note.content"
                              @updated="(text) => guide.updateNote(note.id, text)"/>
                </p>
                <SecondaryButton v-if="!guide.isAddNote" @click="guide.isAddNote = !guide.isAddNote">
                    {{__('Add Note')}}
                </SecondaryButton>
                <AddNote/>
                <br/><br/><hr/><br/>
                <p class="note-row">
                    <span class="note-mark">{{ __('Created At')}}:</span>
                    {{ guide.project.data.createdAt }}
                </p>
                <p class="note-row">
                    <span class="note-mark">{{ __('Updated At')}}:</span>
                    {{ guide.project.data.updatedAt }}
                </p>
            </div>
        </div>
    </div>
</template>
