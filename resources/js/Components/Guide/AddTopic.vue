<script setup>
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import TextareaInput from '@/Components/TextInput.vue';
import SecondaryButton from "@/Components/SecondaryButton.vue";

import { guide } from "@/guide";
import { useForm } from "@inertiajs/inertia-vue3";
const form = useForm({
    name: null,
    desc: null
});

</script>

<style>
</style>

<template>
    <form @submit.prevent="guide.addTopic(form)">
        <h2 class="action-title">{{__('Create Topic')}}</h2>
        <hr/><br/>
        <div>
            <InputLabel for="name" :value="__('Name')" />
            <TextInput id="name" type="text" class="mt-1 block w-full"
                       v-model="form.name" required />
        </div>
        <div>
            <InputLabel for="desc" :value="__('Desc')" />
            <TextareaInput id="desc" type="text" class="mt-1 block w-full"
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
