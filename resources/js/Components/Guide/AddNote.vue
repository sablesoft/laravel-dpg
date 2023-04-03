<script setup>
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';

import { guide } from "@/guide";
import {    useForm } from "@inertiajs/inertia-vue3";
const form = useForm({
    topicId: null,
    content: null
});

</script>

<style>
</style>

<template>
    <form v-if="guide.isAddNote" @submit.prevent="guide.addProjectNote(form)">
        <br/><hr/><br/>
        <div>
            <InputLabel for="topic" :value="__('Topic')" />
            <select v-model="form.topicId" required class="mt-1 block w-full">
                <option :value="null" disabled>{{ __('Select Note Topic') }}</option>
                <option v-for="topic in guide.topics.data" :value="topic.id">
                    {{ topic.name }}
                </option>
            </select>
            <InputError class="mt-2" :message="form.errors.topicId" />
        </div>
        <div>
            <InputLabel for="content" value="Content" />
            <TextInput id="content" type="text" class="mt-1 block w-full"
                       v-model="form.content" required />
            <InputError class="mt-2" :message="form.errors.content" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Add
            </PrimaryButton>
        </div>
    </form>
</template>
