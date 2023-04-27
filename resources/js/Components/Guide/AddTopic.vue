<script setup>
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import TextareaInput from '@/Components/TextareaInput.vue';
import Checkbox from '@/Components/Checkbox.vue';
import ControlAdd from "@/Components/Guide/ControlAdd.vue";

import { guide } from "@/guide";
import { useForm } from "@inertiajs/inertia-vue3";
const form = useForm({
    name: null,
    text: null,
    isGlobal: false
});

let ready = function() {
    return form.name;
}
let nonGlobalTitle = function() {
    let title = guide.getProject().code;
    if (guide.getModule()) {
        title = title + ' - ' + guide.getModule().name;
    }

    return title;
}
</script>

<style>
</style>

<template>
    <form @submit.prevent="guide.createTopic(form)">
        <h2 class="action-title">{{__('Create Topic')}}</h2>
        <div>
            <InputLabel for="name" :value="__('Name')" />
            <TextInput id="name" type="text" class="mt-1 block w-full"
                       v-model="form.name" required />
        </div>
        <div class="mb-2">
            <InputLabel for="text" :value="__('Desc')" />
            <TextareaInput id="text" class="mt-1 block w-full"
                       v-model="form.text" />
        </div>
        <div>
            <InputLabel for="isGlobal" :value="__('Is Global')" class="inline mr-2"/>
            <Checkbox id="isGlobal"
                      class="mr-2"
                      :disabled="!guide.projectsId"
                      v-model="form.isGlobal" />
            <span v-if="!form.isGlobal">({{ nonGlobalTitle() }})</span>
        </div>
        <ControlAdd :ready="ready()" :processing="form.processing"/>
    </form>
</template>
