<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import AddTopic from '@/Components/Guide/AddTopic.vue';
import AddProject from '@/Components/Guide/AddProject.vue';
import Editable from '@/Components/Editable.vue';
import ProjectNotes from '@/Components/Guide/ProjectNotes.vue';
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
    .note-mark {
        font-weight: bold;
    }
    .note-row {
        margin-bottom: 8px;
    }
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
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Dashboard') }}
            </h2>
        </template>
        <div class="py-2">

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
                    <button v-if="guide.projectsId" @click="guide.delete('projects')">
                        {{ __('Delete')}}
                    </button>
                    <AddProject/>
                </div>
            </div>
            <!-- Project Notes -->
            <ProjectNotes v-if="guide.projectsId"/>

            <div class="py-2">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <select v-model="guide.topicsId" v-if="!guide.isAddTopic">
                        <option :value="null">{{ __('Select Topic, or') }}</option>
                        <option v-for="topic in guide.topics" :value="topic.id">
                            {{ topic.name }}
                        </option>
                    </select>
                    <button v-if="!guide.topicsId && !guide.isAddTopic"
                            @click="guide.isAddTopic = !guide.isAddTopic">{{ __('Create New')}}</button>
                    <button v-if="guide.topicsId" @click="view('topic')">{{ __('View')}}</button>
                    <button v-if="guide.topicsId" @click="guide.delete('topics')">
                        {{ __('Delete')}}
                    </button>
                    <AddTopic/>
                </div>
            </div>
            <div v-if="guide.topicsId" class="py-2">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-4 text-gray-900">
                            <p class="note-row">
                                <span class="note-mark">{{ __('Name')}}: </span>
                                <Editable :text="guide.getTopicField('name')"
                                          @updated="(text) => guide.updateTopic(text, 'name')"/>
                            </p>
                            <p class="note-row">
                                <span class="note-mark">{{ __('Desc')}}: </span>
                                <Editable :text="guide.getTopicField('desc')"
                                          @updated="(text) => guide.updateTopic(text, 'desc')"/>
                            </p>
                            <p class="note-row">
                                <span class="note-mark">{{ __('Project')}}:</span>
                                {{ guide.getTopicProject() ? guide.getTopicProject().name : __('Global')}}
                            </p>
                            <p class="note-row">
                                <span class="note-mark">{{ __('Created At')}}:</span>
                                {{ guide.getTopicField('createdAt') }}
                            </p>
                            <p class="note-row">
                                <span class="note-mark">{{ __('Updated At')}}:</span>
                                {{ guide.getTopicField('updatedAt') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </AuthenticatedLayout>
</template>
