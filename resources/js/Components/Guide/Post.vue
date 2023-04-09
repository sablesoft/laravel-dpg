<script setup>
import Note from '@/Components/Guide/Note.vue';
import Link from '@/Components/Guide/Link.vue';
import Editable from '@/Components/Editable.vue';
import Control from '@/Components/Guide/Control.vue';
import DraggableList from '@/Components/Guide/DraggableList.vue';
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
    <div :id="'post' + post.id" data-entity="post" :data-id="post.id"
         :class="guide.postsId === post.id ? 'active-block' : ''"
         class="post-row ease-in-out duration-150">
        <h2 class="block-subtitle cursor-pointer" @click="guide.postsId = guide.postsId === post.id ? null : post.id">
            <Editable :value="guide.getTopicField('name', post.topicId)" type="input"
                      @updated="(text) => guide.updateField('topic', 'name', text, post.topicId)"/>
        </h2>
        <Control :item="post"/>
        <Editable :value="post.text" class="block-content"
                  @updated="(text) => guide.updateField('post', 'text', text, post.id)"/>
        <div class="post-more" v-if="guide.isActive(post)">
            <DraggableList :list="guide.getPostLinks()">
                <Link v-if="!guide.linkAdding" v-for="link in guide.getPostLinks()" :link="link"/>
            </DraggableList>
            <DraggableList :list="guide.getPostNotes()">
                <Note v-if="!guide.noteAdding" v-for="note in guide.getPostNotes()" :note="note"/>
            </DraggableList>
        </div>
    </div>
</template>
