<script setup>
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';

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
    <form v-if="guide.isAddTopic" @submit.prevent="guide.addTopic(form)">
        <div>
            <InputLabel for="name" :value="__('Name')" />
            <TextInput id="name" type="text" class="mt-1 block w-full"
                       v-model="form.name" required />
        </div>
        <div>
            <InputLabel for="desc" :value="__('Desc')" />
            <TextInput id="desc" type="text" class="mt-1 block w-full"
                       v-model="form.desc" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <PrimaryButton>
                {{__('Add')}}
            </PrimaryButton>
        </div>
    </form>
</template>
