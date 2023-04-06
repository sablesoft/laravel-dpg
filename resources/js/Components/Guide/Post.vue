<script setup>
import SecondaryButton from '@/Components/SecondaryButton.vue';
import AddNote from '@/Components/Guide/AddNote.vue';
import Editable from '@/Components/Editable.vue';
import Note from '@/Components/Guide/Note.vue';
import Link from '@/Components/Guide/Link.vue';
import AddLink from '@/Components/Guide/AddLink.vue';
import { guide } from "@/guide";
const props = defineProps({
    post: {
        type: Object,
        required: true
    }
});
</script>
<style>
.post-more {
    padding-top: 5px;
}
</style>
<template>
    <div :id="'post' + post.id" :class="guide.postsId === post.id ? 'active-block' : ''"
         class="post-row ease-in-out duration-150">
        <h2 class="block-subtitle" @click="guide.postsId = guide.postsId === post.id ? null : post.id">
            <Editable :text="guide.getTopicField('name', post.topicId)" type="input"
                      @updated="(text) => guide.updateField('topics', 'name', text, post.topicId)"/>
        </h2>
        <Editable :text="post.desc" class="post-desc"
                  @updated="(text) => guide.updateField('posts', 'desc', text, post.id)"/>
        <div class="post-more" v-if="guide.postsId === post.id">
            <Link v-for="link in guide.getPostLinks()" :link="link"/>
            <hr/>
            <SecondaryButton v-if="!guide.isAddLink" @click.prevent.stop="guide.isAddLink = true">
                {{__('Add Link')}}
            </SecondaryButton>
            <SecondaryButton v-if="!guide.isAddNote" @click.prevent.stop="guide.isAddNote = true">
                {{__('Add Note')}}
            </SecondaryButton>
            <AddLink v-if="guide.isAddLink" :entity="post"/>
            <AddNote v-if="guide.isAddNote" :entity="post"/>
            <Note v-if="!guide.isAddNote" v-for="note in guide.getPostNotes(post.id)" :note="note"/>
            <p><span class="note-mark">{{ __('Created At')}}:</span> {{ post.createdAt }}</p>
            <p><span class="note-mark">{{ __('Updated At')}}:</span> {{ post.updatedAt }}</p>
        </div>
        <hr/><br/>
    </div>
</template>
