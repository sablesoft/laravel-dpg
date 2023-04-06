<script setup>
import Editable from '@/Components/Editable.vue';
import AddPost from '@/Components/Guide/AddPost.vue';
import Post from '@/Components/Guide/Post.vue';
import BlockFooter from '@/Components/Guide/BlockFooter.vue';

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
    <!-- Categories Control Tab -->
    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <select v-model="guide.categoriesId" v-if="!guide.isAddPost">
                <option :value="null">{{ __('Select Category, or') }}</option>
                <option v-for="topic in guide.getProjectCategories()" :value="topic.id">
                    {{ topic.name }}
                </option>
            </select>
            <button v-if="!guide.isAddPost"
                    @click="guide.isAddPost = true">{{ __('Create Post')}}</button>
            <button v-if="guide.categoriesId && !guide.isAddPost"
                    @click="guide.delete('topics', guide.categoriesId)">
                {{ __('Delete')}}
            </button>
            <AddPost v-if="guide.isAddPost"/>
        </div>
    </div>
    <!-- Category Info -->
    <div v-if="guide.categoriesId && !guide.isAddPost" :id="'category' + guide.categoriesId" class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4 text-gray-900">
                    <h2 class="block-title cursor-pointer">
                        <Editable :text="guide.getTopicField('name', guide.categoriesId)" type="input"
                                  @updated="(text) => guide.updateField('topics', 'name', text, guide.categoriesId)"/>
                    </h2>
                    <p>
                        <Editable :text="guide.getTopicField('desc', guide.categoriesId)"
                                  @updated="(text) => guide.updateField('topics', 'desc', text, guide.categoriesId)"/>
                    </p>
                    <hr/><br/>
                    <Post v-for="post in guide.getCategoryPosts()" :post="post"/>
                    <BlockFooter :entity="guide.getTopic(guide.categoriesId)"/>
                </div>
            </div>
        </div>
    </div>
</template>
