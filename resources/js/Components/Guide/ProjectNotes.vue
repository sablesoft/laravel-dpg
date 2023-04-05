<script setup>
import Editable from '@/Components/Editable.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import AddNote from '@/Components/Guide/AddNote.vue';
import Note from '@/Components/Guide/Note.vue';

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
            console.log('Delete note key!', event);
            guide.delete('notes');
        }
    })
})

</script>

<style>
    .note-mark {
        font-weight: bold;
        cursor: pointer;
    }
    .note-row {
        margin-bottom: 8px;
    }
</style>

<template>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-4 text-gray-900">
                <div class="note-row">
                    <h3 class="note-mark">{{ __('Name')}}</h3>
                    <Editable :text="guide.getProject().name" type="input"
                              @updated="(text) => guide.updateProject('name', text)"/>
                </div>
                <div class="note-row">
                    <h3 class="note-mark">{{ __('Code')}}</h3>
                    <Editable :text="guide.getProject().code" type="input"
                              @updated="(text) => guide.updateProject('code', text)"/>
                </div>
                <SecondaryButton v-if="!guide.isAddNote" @click="guide.isAddNote = true">
                    {{__('Add Note')}}
                </SecondaryButton>
                <AddNote v-if="guide.isAddNote"/>
                <br/><br/>
                <Note v-if="!guide.isAddNote" v-for="note in guide.getProjectNotes()" :note="note"/>
                <hr/><br/>
                <p class="note-more">
                    <span class="note-mark">{{ __('Created At')}}:</span>
                    {{ guide.getProject().createdAt }}
                </p>
                <p class="note-more">
                    <span class="note-mark">{{ __('Updated At')}}:</span>
                    {{ guide.getProject().updatedAt }}
                </p>
            </div>
        </div>
    </div>
</template>
