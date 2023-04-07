<script setup>
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import ControlAdd from "@/Components/Guide/ControlAdd.vue";

import { guide } from "@/guide";
import { useForm } from "@inertiajs/inertia-vue3";
const form = useForm({
    name: null,
    code: null
});

let ready = function() {
    return form.name && form.code;
}
</script>
<style>
</style>
<template>
    <form @submit.prevent="guide.createProject(form)">
        <h2 class="action-title">{{__('Create Project')}}</h2>
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
        <ControlAdd :ready="ready()" :processing="form.processing"/>
    </form>
</template>
