<script setup>
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import TextareaInput from '@/Components/TextareaInput.vue';
import Checkbox from '@/Components/Checkbox.vue';
import SecondaryButton from "@/Components/SecondaryButton.vue";

import { guide } from "@/guide";
import { useForm } from "@inertiajs/inertia-vue3";
const form = useForm({
    name: null,
    desc: null,
    isGlobal: true
});

</script>

<style>
</style>

<template>
    <form @submit.prevent="guide.createTopic(form)">
        <h2 class="action-title">{{__('Create Topic')}}</h2>
        <hr/><br/>
        <div>
            <InputLabel for="name" :value="__('Name')" />
            <TextInput id="name" type="text" class="mt-1 block w-full"
                       v-model="form.name" required />
        </div>
        <div class="mb-2">
            <InputLabel for="desc" :value="__('Desc')" />
            <TextareaInput id="desc" class="mt-1 block w-full"
                       v-model="form.desc" />
        </div>
        <div>
            <InputLabel for="isGlobal" :value="__('Is Global')" class="inline mr-2"/>
            <Checkbox id="isGlobal"
                      class="mr-2"
                      :disabled="!guide.projectsId"
                      checked="checked"
                      v-model="form.isGlobal" />
            <span v-if="!form.isGlobal">({{__('Project') +': '+ guide.getProject().code}})</span>
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
