<!--suppress JSConstantReassignment -->
<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import ProjectNotes from '@/Components/Guide/ProjectNotes.vue';
import TopicsTab from '@/Components/Guide/TopicsTab.vue';
import CategoriesTab from '@/Components/Guide/CategoriesTab.vue';
import {Head} from '@inertiajs/inertia-vue3';

import { guide } from "@/guide";

import {onMounted, shallowRef, toRaw} from "vue";

const tabName = shallowRef('Info');

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
    });
    window.addEventListener('keydown', function(event) {
        const key = event.key;
        if (key === "Backspace" || key === "Delete") {
            console.log('delete key!');
            if (guide.notesId) {
                console.log('delete note!');
                guide.delete('notes');
            } else if (guide.postsId) {
                console.log('delete post!');
                guide.delete('posts');
            }
        }
        if (key === "Escape") {
            guide.resetSelect();
        }
    });
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
            <h2 v-if="guide.isReady" class="block-title font-semibold text-xl text-gray-800 leading-tight">
                {{ guide.getProject().name + ' ('+ guide.getProject().code +')'}}
            </h2>
            <hr>
            <p>{{ __(tabName) }}</p>
        </template>
        <div class="py-2" v-if="guide.isReady">
            <div class="py-2">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <SecondaryButton @click="tabName = 'Info'">
                        {{__('Info')}}
                    </SecondaryButton>
                    <SecondaryButton @click="tabName = 'Categories'">
                        {{__('Categories')}}
                    </SecondaryButton>
                    <SecondaryButton @click="tabName = 'Topics'">
                        {{__('Topics')}}
                    </SecondaryButton>
                </div>
            </div>
            <div v-if="tabName === 'Info'" class="py-2">
                <ProjectNotes/>
            </div>
            <div v-if="tabName === 'Topics'" class="py-2">
                <TopicsTab :topics="guide.getProjectTopics()"/>
            </div>
            <div v-if="tabName === 'Categories'" class="py-2">
                <CategoriesTab/>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
