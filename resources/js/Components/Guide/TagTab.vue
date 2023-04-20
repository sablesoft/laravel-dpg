<script setup>
import Editable from '@/Components/Editable.vue';
import Post from '@/Components/Guide/Post.vue';
import Control from '@/Components/Guide/Control.vue';
import { guide } from "@/guide";
</script>
<style>
button {
    background-color: #fff;
    border-color: #6b7280;
    border-width: 1px;
    border-radius: 0;
    padding: 0.5rem 0.75rem;
    font-size: 1rem;
    line-height: 1.5rem;
    --tw-shadow: 0 0 #0000;
    margin-left: 6px;
}
</style>
<template>
    <div v-if="guide.topicsId" :id="'topic' + guide.topicsId"
         class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-2">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <h2 class="block-title cursor-pointer">
                    <Editable :value="guide.getTopicField('name', guide.topicsId)" type="input"
                              @updated="(text) => guide.updateField('topic', 'name', text, guide.topicsId)"/>
                </h2>
                <Control entity="tag" :item="guide.getTopic(guide.topicsId)"/>
                <p>
                    <Editable :value="guide.getTopicField('text', guide.topicsId)"
                              @updated="(text) => guide.updateField('topic', 'text', text, guide.topicsId)"/>
                </p>
                <Post v-for="post in guide.getTagPosts()" :post="post"/>
            </div>
        </div>
    </div>
</template>
