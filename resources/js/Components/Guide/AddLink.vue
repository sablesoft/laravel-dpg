<script setup>
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from "@/Components/SecondaryButton.vue";

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
            <select id="categorySelect" v-model="form.categoryId" required class="mt-1 block w-full">
                <option :value="null" disabled>{{ __('Select Category') }}</option>
                <option v-for="category in guide.getProjectCategories()" :value="category.id">
                    {{ category.name }}
                </option>
            </select>
        </div>
        <div v-if="form.categoryId">
            <InputLabel for="postSelect" :value="__('*Post')" />
            <select id="postSelect" v-model="form.postId" required class="mt-1 block w-full">
                <option :value="null" disabled>{{ __('Select Post') }}</option>
                <option v-for="post in guide.getCategoryPosts(form.categoryId)" :value="post.id">
                    {{ title(post) }}
                </option>
            </select>
        </div>
        <div v-if="form.postId && guide.getPostNotes(form.postId)">
            <InputLabel for="noteSelect" :value="__('Note')" />
            <select id="noteSelect" v-model="form.noteId" required class="mt-1 block w-full">
                <option :value="null" disabled>{{ __('Select Note (optional)') }}</option>
                <option v-for="note in guide.getPostNotes(form.postId)" :value="note.id">
                    {{ title(note) }}
                </option>
            </select>
        </div>
        <div class="flex items-center justify-end mt-4">
            <SecondaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing"
                @click="guide.resetAdding()">
                {{__('Cancel')}}
            </SecondaryButton>
            <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                {{__('Add')}}
            </PrimaryButton>
        </div>
    </form>
</template>
