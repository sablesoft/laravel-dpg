<script setup>
import InputLabel from '@/Components/InputLabel.vue';
import ControlAdd from "@/Components/Guide/ControlAdd.vue";
import Select from "@/Components/Select.vue";
import { guide } from "@/guide";
import { useForm } from "@inertiajs/inertia-vue3";

const form = useForm({
    topicId: null,
    typeId: null,
});

let ready = function() {
    return form.topicId && form.typeId;
}
let typeChange = function(value) {
    form.typeId = value;
}
let topicChange = function(value) {
    form.topicId = value;
}
</script>
<style>
</style>
<template>
    <form @submit.prevent="guide.createModule(form)">
        <h2 class="action-title">{{__('Create Module')}}</h2>
        <div>
            <InputLabel for="selectType" :value="__('Type')" />
            <Select id="selectType" placeholder="Select Type" class="mt-1 block w-full"
                    keep-values="1"
                    @change="typeChange" :items="guide.getSortedTopics()"/>
        </div>
        <div>
            <InputLabel for="selectTopic" :value="__('Topic')" />
            <Select id="selectTopic" placeholder="Select Topic" class="mt-1 block w-full"
                    keep-values="1"
                    @change="topicChange" :items="guide.getSortedTopics()"/>
        </div>
        <ControlAdd :ready="ready()" :processing="form.processing"/>
    </form>
</template>
