<script setup>
import SecondaryButton from '@/Components/SecondaryButton.vue';
import AddNote from '@/Components/Guide/AddNote.vue';
import Editable from '@/Components/Editable.vue';
import Note from '@/Components/Guide/Note.vue';
import { guide } from "@/guide";
const props = defineProps({
    post: {
        type: Object,
        required: true
    }
});
</script>
<style>
</style>
<template>
    <div @click="guide.postsId = guide.postsId === post.id ? null : post.id"
         :class="guide.postsId === post.id ? 'active-block' : ''"
         class="post-row ease-in-out duration-150">
        <h2 class="block-subtitle">
            <Editable :text="guide.getTopicField('name', post.topicId)"
                      @updated="(text) => guide.updateTopic(text, 'name', post.topicId)"/>
        </h2>
        <hr/><br/>
        <SecondaryButton v-if="!guide.isAddNote" @click.prevent.stop="guide.isAddNote = true">
            {{__('Add Note')}}
        </SecondaryButton>
        <AddNote v-if="guide.isAddNote"/>
        <Note v-if="!guide.isAddNote" v-for="note in guide.getPostNotes(post.id)" :note="note"/>
    </div>
</template>
