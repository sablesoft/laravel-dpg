<!--suppress JSConstantReassignment -->
<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import ProjectNotes from '@/Components/Guide/ProjectNotes.vue';
import TopicTabs from '@/Components/Guide/TopicsTab.vue';
import {Head} from '@inertiajs/inertia-vue3';

import { guide } from "@/guide";

import {onMounted, shallowRef, toRaw} from "vue";

const tabName = shallowRef('notes');

const props = defineProps({
    projectId: {
        type: Number,
        required: true
    },
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
    },
    posts: {
        type: Object,
        required: true
    },
    links: {
        type: Object,
        required: true
    }
});

onMounted(() => {
    guide.init({
        projectsId: toRaw(props.projectId),
        projects: props.projects,
        topics: props.topics,
        posts: props.posts,
        notes: props.notes,
        links: props.links,
    })
    console.debug('PROJECT', toRaw(props.projectId));
});

</script>
<style scoped>
    button {
        margin-right: 5px;
    }
</style>
<template>
    <Head>
        <title v-if="guide.isReady">{{ guide.getProject().code }}</title>
    </Head>

    <AuthenticatedLayout>
        <template #header>
            <h2 v-if="guide.isReady" class="font-semibold text-xl text-gray-800 leading-tight">
                {{ guide.getProject().name + ' ('+ guide.getProject().code +')'}}
            </h2>
        </template>
        <div class="py-2" v-if="guide.isReady">
            <div class="py-2">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <SecondaryButton @click="tabName = 'notes'">
                        {{__('Notes')}}
                    </SecondaryButton>
                    <SecondaryButton @click="tabName = 'categories'">
                        {{__('Categories')}}
                    </SecondaryButton>
                    <SecondaryButton @click="tabName = 'topics'">
                        {{__('Topics')}}
                    </SecondaryButton>
                </div>
            </div>
            <div v-if="tabName === 'notes'" class="py-2">
                <ProjectNotes/>
            </div>
            <div v-if="tabName === 'topics'" class="py-2">
                <TopicTabs :topics="guide.getProjectTopics()"/>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
