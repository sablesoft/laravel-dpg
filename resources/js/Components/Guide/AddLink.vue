<script setup>
import InputLabel from '@/Components/InputLabel.vue';
import ControlAdd from "@/Components/Guide/ControlAdd.vue";
import { guide } from "@/guide";
import { useForm } from "@inertiajs/inertia-vue3";
const props = defineProps({
    item: {
        type: Object,
        required: true
    }
});
const form = useForm({
    categoryId: null,
    postId: null,
    noteId: null
});
let ready = function() {
    return form.categoryId && form.postId;
}
let title = function(item) {
    let topic = guide.getTopic(item.topicId);

    return topic.name;
}
</script>

<style>
</style>

<template>
    <form @submit.prevent="guide.createLink(form, item)">
        <h2 class="action-title">{{__('Create Link')}}</h2>
        <hr/><br/>
        <div>
            <InputLabel for="categorySelect" :value="__('*Category')" />
            <select id="categorySelect" v-model="form.categoryId" required
                    @change="form.postId = null; form.noteId = null;"
                    class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150 mt-1 block w-full">
                <option :value="null" disabled>{{ __('Select Category') }}</option>
                <option v-for="category in guide.getProjectCategories()" :value="category.id">
                    {{ category.name }}
                </option>
            </select>
        </div>
        <div v-if="form.categoryId">
            <InputLabel for="postSelect" :value="__('*Post')" />
            <select id="postSelect" v-model="form.postId" required
                    class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150 mt-1 block w-full">
                <option :value="null" disabled>{{ __('Select Post') }}</option>
                <option v-for="post in guide.getCategoryPosts(form.categoryId)" :value="post.id">
                    {{ title(post) }}
                </option>
            </select>
        </div>
        <div v-if="form.postId && guide.getPostNotes(form.postId)">
            <InputLabel for="noteSelect" :value="__('Note')" />
            <select id="noteSelect" v-model="form.noteId"
                    class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150 mt-1 block w-full">
                <option :value="null">{{ __('Select Note (optional)') }}</option>
                <option v-for="note in guide.getPostNotes(form.postId)" :value="note.id">
                    {{ title(note) }}
                </option>
            </select>
        </div>
        <ControlAdd :ready="ready()" :processing="form.processing"/>
    </form>
</template>
