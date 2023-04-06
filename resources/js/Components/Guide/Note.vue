<script setup>
import Editable from '@/Components/Editable.vue';
import BlockFooter from '@/Components/Guide/BlockFooter.vue';
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
    <div :id="'note' + note.id" :class="guide.notesId === note.id ? 'active-block' : ''"
       class="note-row ease-in-out duration-150">
        <h3 class="note-mark cursor-pointer" @click="guide.notesId = guide.notesId === note.id ? null : note.id">
            {{ __(guide.getTopicField('name', note.topicId))}}
        </h3>
        <Editable :text="note.content" class="block-content"
                  @updated="(text) => guide.updateField('notes', 'content', text, note.id)"/>
        <div v-if="guide.notesId === note.id" class="note-more">
            <BlockFooter :entity="note"/>
        </div>
    </div>
</template>
