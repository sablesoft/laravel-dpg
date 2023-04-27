<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import ModalDeletion from '@/Components/Guide/ModalDeletion.vue';
import ProjectInfo from '@/Components/Guide/ProjectInfo.vue';
import TopicsTab from '@/Components/Guide/TopicsTab.vue';
import Select from '@/Components/Select.vue';
import { Head } from '@inertiajs/inertia-vue3';
import { onMounted } from "vue";
import { guide } from "@/guide";

const props = defineProps({
    projects: {
        type: Object,
        required: true
    },
    topics: {
        type: Object,
        required: true
    }
});

let showProject = function(id) {
    guide.changeTab('ProjectInfo');
    if (id === 'new') {
        guide.projectsId = null;
        guide.projectAdding = true;
    } else {
        guide.projectsId = id;
    }
}
let showTopic = function(id) {
    guide.changeTab('Topic');
    if (id === 'new') {
        guide.topicsId = null;
        guide.topicAdding = true;
    } else {
        guide.topicsId = id;
    }
}
onMounted(() => {
    guide.init({
        projects : props.projects,
        topics : props.topics
    });
});
</script>
<style>
    button {
        background-color: #fff;
        border-color: #6b7280;
        border-width: 1px;
        border-radius: 0;
        padding: 0.5rem 0.75rem;
        font-size: 1rem;
        line-height: 1.5rem;
        --tw-shadow: 0 0 #0000;
        margin-left: 6px;
    }
</style>
<template>
    <Head title="Dashboard" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="block-title inline font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Dashboard') }}
            </h2>
            <div class="inline max-w-7xl mx-auto sm:px-6 lg:px-8">
                <SecondaryButton @click="guide.changeTab('Info')" class="mb-2 mr-2">
                    {{ __('Info') }}
                </SecondaryButton>
                <Select placeholder="Projects" class="mb-2 mr-2" :action="{id: 'new', name: 'New'}"
                        :items="guide.projects" @change="showProject"/>
                <Select placeholder="General Topics" class="mb-2 mr-2"
                        :action="{id: 'new', name: 'New'}"
                        :items="guide.getGeneralTopics()" @change="showTopic"/>
            </div>
            <hr>
            <p>{{ __(guide.tab) }}</p>
        </template>
        <div class="py-2" v-if="guide.isReady">
            <div v-if="guide.tab === 'Info'" class="py-2">
                <div class="py-2">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <h2>IN DEVELOPMENT</h2>
                    </div>
                </div>
            </div>
            <ProjectInfo v-if="guide.tab === 'ProjectInfo'"/>
            <TopicsTab v-if="guide.tab === 'Topic'"/>
        </div>
        <ModalDeletion/>
    </AuthenticatedLayout>
</template>
