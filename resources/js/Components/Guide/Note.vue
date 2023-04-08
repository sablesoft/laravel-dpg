<script setup>
import Link from '@/Components/Guide/Link.vue';
import Editable from '@/Components/Editable.vue';
import Control from '@/Components/Guide/Control.vue';
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
        <Control v-if="guide.isActive(note)" :item="note"/>
        <Editable :value="note.text" class="block-content"
                  @updated="(text) => guide.updateField('note', 'text', text, note.id)"/>
        <div v-if="guide.isActive(note) && guide.tab !== 'ProjectInfo'" class="note-more">
            <Link v-if="!guide.linkAdding" v-for="link in guide.getNoteLinks()" :link="link"/>
        </div>
    </div>
</template>
