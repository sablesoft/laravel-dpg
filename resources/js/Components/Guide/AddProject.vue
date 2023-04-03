<script setup>
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';

import { guide } from "@/guide";
import {useForm} from "@inertiajs/inertia-vue3";
const form = useForm({
    name: null,
    code: null
});

</script>

<style>
</style>

<template>
    <form v-if="guide.isAddProject" @submit.prevent="guide.addProject(form)">
        <div>
            <InputLabel for="name" :value="__('Name')" />
            <TextInput id="name" type="text" class="mt-1 block w-full"
                       v-model="form.name" required />
        </div>
        <div>
            <InputLabel for="code" :value="__('Code')" />
            <TextInput id="code" type="text" class="mt-1 block w-full"
                       v-model="form.code" required/>
        </div>

        <div class="flex items-center justify-end mt-4">
            <PrimaryButton>
                {{__('Add')}}
            </PrimaryButton>
        </div>
    </form>
</template>
