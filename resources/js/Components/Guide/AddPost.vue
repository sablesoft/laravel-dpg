<script setup>
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextareaInput from '@/Components/TextareaInput.vue';
import SecondaryButton from "@/Components/SecondaryButton.vue";

import { guide } from "@/guide";
import { useForm } from "@inertiajs/inertia-vue3";
import { onMounted } from "vue";

const form = useForm({
    categoryId: null,
    topicId: null,
    desc: null
});

onMounted(() => {
    form.categoryId = guide.categoriesId;
});

</script>

<style>
</style>

<template>
    <form @submit.prevent="guide.createPost(form)">
        <h2 class="action-title">{{__('Create Post')}}</h2>
        <div v-if="!guide.categoriesId">
            <InputLabel for="category" :value="__('Category')" />
            <select v-model="form.categoryId" required class="mt-1 block w-full">
                <option :value="null" disabled>{{ __('Select Post Category') }}</option>
                <option v-for="topic in guide.topics" :value="topic.id">
                    {{ topic.name }}
                </option>
            </select>
        </div>
        <div>
            <InputLabel for="topic" :value="__('Topic')" />
            <select v-model="form.topicId" required class="mt-1 block w-full">
                <option :value="null" disabled>{{ __('Select Post Topic') }}</option>
                <option v-for="topic in guide.topics" :value="topic.id">
                    {{ topic.name }}
                </option>
            </select>
        </div>
        <div>
            <InputLabel for="desc" :value="__('Desc')" />
            <TextareaInput id="desc" class="mt-1 block w-full"
                           @click.stop @keydown.stop @keyup.stop
                           v-model="form.desc" />
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
