<script setup>
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextareaInput from '@/Components/TextareaInput.vue';
import SecondaryButton from "@/Components/SecondaryButton.vue";
import Select from "@/Components/Select.vue";
import { guide } from "@/guide";
import { useForm } from "@inertiajs/inertia-vue3";
import { onMounted } from "vue";

const form = useForm({
    categoryId: null,
    topicId: null,
    desc: null
});

let ready = function() {
    return form.categoryId && form.topicId;
}
let categoryChange = function(value) {
    form.categoryId = value;
}
let topicChange = function(value) {
    form.topicId = value;
}
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
            <InputLabel for="selectCategory" :value="__('Category')" />
            <Select id="selectCategory" placeholder="Select Category" class="mt-1 block w-full"
                    keep-values="1"
                    @change="categoryChange" :items="guide.topics"/>
        </div>
        <div>
            <InputLabel for="selectTopic" :value="__('Topic')" />
            <Select id="selectTopic" placeholder="Select Topic" class="mt-1 block w-full"
                    keep-values="1"
                    @change="topicChange" :items="guide.topics"/>
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
            <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="!ready() || form.processing">
                {{__('Add')}}
            </PrimaryButton>
        </div>
    </form>
</template>
