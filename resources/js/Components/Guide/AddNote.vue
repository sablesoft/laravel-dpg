<script setup>
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextareaInput from '@/Components/TextareaInput.vue';
import SecondaryButton from "@/Components/SecondaryButton.vue";

import { guide } from "@/guide";
import { useForm } from "@inertiajs/inertia-vue3";
const form = useForm({
    topicId: null,
    content: null
});

</script>

<style>
</style>

<template>
    <form @submit.prevent="guide.addProjectNote(form)">
        <h2 class="action-title">{{__('Create Note')}}</h2>
        <hr/><br/>
        <div>
            <InputLabel for="topic" :value="__('Topic')" />
            <select v-model="form.topicId" required class="mt-1 block w-full" @click.prevent.stop="">
                <option :value="null" disabled>{{ __('Select Note Topic') }}</option>
                <option v-for="topic in guide.topics" :value="topic.id">
                    {{ topic.name }}
                </option>
            </select>
        </div>
        <div>
            <InputLabel for="content" :value="__('Content')" />
            <TextareaInput id="content" class="mt-1 block w-full"
                       @click.prevent.stop=""
                       v-model="form.content" required />
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
