<script setup>
import Editable from '@/Components/Editable.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import AddNote from '@/Components/Guide/AddNote.vue';

import { guide } from "@/guide";
import { useForm } from "@inertiajs/inertia-vue3";
import { onMounted } from "vue";

const form = useForm({
    topicId: null,
    content: null
});

onMounted(() => {
    window.addEventListener('keydown', function(event) {
        const key = event.key;
        if (key === "Backspace" || key === "Delete") {
            console.log('Delete note key!');
            guide.delete('notes');
        }
    })
})

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
                    <Editable :text="guide.getProject().name"
                              @updated="(text) => guide.updateProject('name', text)"/>
                </p>
                <p class="note-row">
                    <span class="note-mark">{{ __('Code')}}: </span>
                    <Editable :text="guide.getProject().code"
                              @updated="(text) => guide.updateProject('code', text)"/>
                </p>
                <SecondaryButton v-if="!guide.isAddNote" @click="guide.isAddNote = true">
                    {{__('Add Note')}}
                </SecondaryButton>
                <AddNote v-if="guide.isAddNote"/>
                <br/><br/>
                <p v-if="!guide.isAddNote"
                   v-for="note in guide.getProjectNotes()"
                   @click="guide.notesId = guide.notesId === note.id ? null : note.id"
                   :class="guide.notesId === note.id ? 'active-note' : ''"
                   class="note-row ease-in-out duration-150">
                    <span class="note-mark">{{ __(guide.getTopicField('name', note.topicId))}}: </span>
                    <Editable :text="note.content"
                              @updated="(text) => guide.updateNote(note.id, text)"/>
                </p>
                <hr/><br/>
                <p class="note-row">
                    <span class="note-mark">{{ __('Created At')}}:</span>
                    {{ guide.getProject().createdAt }}
                </p>
                <p class="note-row">
                    <span class="note-mark">{{ __('Updated At')}}:</span>
                    {{ guide.getProject().updatedAt }}
                </p>
            </div>
        </div>
    </div>
</template>
