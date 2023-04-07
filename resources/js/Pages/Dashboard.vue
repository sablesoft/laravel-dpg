<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import AddProject from '@/Components/Guide/AddProject.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import ProjectNotes from '@/Components/Guide/ProjectNotes.vue';
import TopicsTab from '@/Components/Guide/TopicsTab.vue';
import { Head } from '@inertiajs/inertia-vue3';
import {onMounted, shallowRef} from "vue";
import { guide } from "@/guide";

const props = defineProps({
    projects: {
        type: Object,
        required: true
    },
    topics: {
        type: Object,
        required: true
    },
    notes: {
        type: Object,
        required: true
    }
});

let view = function(name) {
    window.location.href = name === 'topic' ? '/topic/' + guide.topicsId :
        '/project/' + guide.projectsId;
}

onMounted(() => {
    guide.init({
        projects : props.projects,
        topics : props.topics,
        notes : props.notes
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
                <SecondaryButton @click="guide.changeTab('Info')" class="mb-2">
                    {{__('info')}}
                </SecondaryButton>
                <SecondaryButton @click="guide.changeTab('Projects')" class="mb-2">
                    {{__('Projects')}}
                </SecondaryButton>
                <SecondaryButton @click="guide.changeTab('Topics')" class="mb-2">
                    {{__('Topics')}}
                </SecondaryButton>
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
            <div v-if="guide.tab === 'Projects'" class="py-2">
                <!-- Projects Control Tab -->
                <div class="py-2">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <select v-model="guide.projectsId" v-if="!guide.isAddProject">
                            <option :value="null">{{ __('Select Project, or') }}</option>
                            <option v-for="project in guide.projects" :value="project.id">
                                {{ project.name }}
                            </option>
                        </select>
                        <button v-if="!guide.projectsId && !guide.isAddProject"
                                @click="guide.isAddProject = true">{{ __('Create New')}}</button>
                        <button v-if="guide.projectsId" @click="view('project')">{{ __('View')}}</button>
                        <button v-if="guide.projectsId" @click="guide.delete(guide.getProject())">
                            {{ __('Delete')}}
                        </button>
                        <AddProject v-if="guide.isAddProject"/>
                    </div>
                </div>
                <!-- Project Notes -->
                <ProjectNotes v-if="guide.projectsId"/>
            </div>
            <div v-if="guide.tab === 'Topics'" class="py-2">
                <!-- Topics -->
                <TopicsTab :topics="guide.topics"/>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
