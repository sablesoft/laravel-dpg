<script setup>
import Editable from '@/Components/Editable.vue';
import { guide } from "@/guide";
const props = defineProps({
    note: {
        type: Object,
        required: true
    }
});
</script>
<style>
</style>
<template>
    <div :class="guide.notesId === note.id ? 'active-block' : ''"
       class="note-row ease-in-out duration-150">
        <h3 class="note-mark" @click="guide.notesId = guide.notesId === note.id ? null : note.id">
            {{ __(guide.getTopicField('name', note.topicId))}}
        </h3>
        <Editable :text="note.content"
                  @updated="(text) => guide.updateNote(note.id, text)"/>
        <div v-if="guide.notesId === note.id" class="note-more">
            <hr/><br/>
            <p>
                <span class="note-mark">{{ __('Created At')}}: </span> {{ note.createdAt }}
            </p>
            <p>
                <span class="note-mark">{{ __('Updated At')}}: </span> {{ note.updatedAt }}
            </p>
        </div>
    </div>
</template>
