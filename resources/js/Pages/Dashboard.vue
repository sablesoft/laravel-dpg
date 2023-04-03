<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head} from '@inertiajs/inertia-vue3';
import {onMounted, shallowRef, toRaw} from "vue";

const projectId = shallowRef(null);
const topicId = shallowRef(null);

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

let getProject = function(id = null) {
    id = id ? id : projectId.value;
    return id ? props.projects.data[id] : null;
}

let getTopic = function(id = null) {
    id = id ? id : topicId.value;
    return id ? props.topics.data[id] : null;
}

let view = function(name) {
    window.location.href = name === 'topic' ? '/topic/' + topicId.value :
        '/project/' + projectId.value;
}

onMounted(() => {
    console.debug('INITIAL PROJECTS', toRaw(props.projects));
    console.debug('INITIAL TOPICS', toRaw(props.topics));
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
            <div class="py-2">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <select v-model="projectId">
                        <option :value="null">{{ __('Select Project, or') }}</option>
                        <option v-for="project in projects.data" :value="project.id">
                            {{ project.name }}
                        </option>
                    </select>
                    <button v-if="!projectId">{{ __('Create New')}}</button>
                    <button v-if="projectId" @click="view('project')">{{ __('View')}}</button>
                    <button v-if="projectId">{{ __('Delete')}}</button>
                </div>
            </div>
            <div v-if="projectId" class="py-2">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-4 text-gray-900">
                            <p class="note-row">
                                <span class="note-mark">{{ __('Name')}}:</span> {{ getProject().name }}
                            </p>
                            <p class="note-row">
                                <span class="note-mark">{{ __('Code')}}:</span> {{ getProject().code }}
                            </p>
                            <p v-for="note in getProject().notes" class="note-row">
                                <span class="note-mark">{{ __(getTopic(note.topicId).name)}}:</span>
                                {{ note.content }}
                            </p>
                            <p class="note-row">
                                <span class="note-mark">{{ __('Created At')}}:</span>
                                {{ getProject().createdAt }}
                            </p>
                            <p class="note-row">
                                <span class="note-mark">{{ __('Updated At')}}:</span>
                                {{ getProject().updatedAt }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="py-2">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <select v-model="topicId">
                        <option :value="null">{{ __('Select Topic, or') }}</option>
                        <option v-for="topic in topics.data" :value="topic.id">
                            {{ topic.name }}
                        </option>
                    </select>
                    <button v-if="!topicId">{{ __('Create New')}}</button>
                    <button v-if="topicId" @click="view('topic')">{{ __('View')}}</button>
                    <button v-if="topicId">{{ __('Delete')}}</button>
                </div>
            </div>
            <div v-if="topicId" class="py-2">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-4 text-gray-900">
                            <p class="note-row">
                                <span class="note-mark">{{ __('Name')}}:</span> {{ getTopic().name }}
                            </p>
                            <p class="note-row">
                                <span class="note-mark">{{ __('Project')}}:</span>
                                {{ getTopic().projectId ? getProject(getTopic().projectId).name : __('Global')}}
                            </p>
                            <p class="note-row">
                                <span class="note-mark">{{ __('Desc')}}:</span> {{ getTopic().desc }}
                            </p>
                            <p class="note-row">
                                <span class="note-mark">{{ __('Created At')}}:</span>
                                {{ getTopic().createdAt }}
                            </p>
                            <p class="note-row">
                                <span class="note-mark">{{ __('Updated At')}}:</span>
                                {{ getTopic().updatedAt }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </AuthenticatedLayout>
</template>
