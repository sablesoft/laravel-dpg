<!--suppress JSConstantReassignment -->
<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import Select from '@/Components/Select.vue';
import ProjectInfo from '@/Components/Guide/ProjectInfo.vue';
import ModalDeletion from '@/Components/Guide/ModalDeletion.vue';
import TopicsTab from '@/Components/Guide/TopicsTab.vue';
import Category from '@/Components/Guide/Category.vue';
import {Head} from '@inertiajs/inertia-vue3';
import { guide } from "@/guide";
import {onMounted, toRaw} from "vue";

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
            if (guide.linksId) {
                guide.askDeletion(guide.getLink());
            } else if (guide.notesId) {
                guide.askDeletion(guide.getNote());
            } else if (guide.postsId) {
                guide.askDeletion(guide.getPost());
            }
        }
        if (key === "Escape") {
            guide.resetSelect();
        }
    });
});
let showCategory = function(id) {
    guide.changeTab('Category');
    if (id === 'new') {
        guide.categoriesId = null;
        guide.isAddPost = true;
    } else {
        guide.categoriesId = id;
    }
}
let showTopic = function(id) {
    guide.changeTab('Topic');
    if (id === 'new') {
        guide.topicsId = null;
        guide.isAddTopic = true;
    } else {
        guide.topicsId = id;
    }
}
</script>
<style scoped>
</style>
<template>
    <Head>
        <title v-if="guide.isReady">{{ guide.getProject().code }}</title>
    </Head>
    <AuthenticatedLayout>
        <template #header>
            <h2 v-if="guide.isReady" class="block-title inline font-semibold text-xl text-gray-800 leading-tight">
                {{ guide.getProject().name + ' ('+ guide.getProject().code +')'}}
            </h2>
            <div class="inline max-w-7xl mx-auto sm:px-6 lg:px-8">
                <SecondaryButton @click="guide.changeTab('Info')" class="mb-2 mr-2">
                    {{__('Info')}}
                </SecondaryButton>
                <Select placeholder="Categories" class="mb-2 mr-2"
                        :action="{id: 'new', name: 'New'}"
                        :items="guide.getProjectCategories()" @change="showCategory"/>
                <Select placeholder="Topics" class="mb-2 mr-2"
                        :action="{id: 'new', name: 'New'}"
                        :items="guide.getProjectTopics()" @change="showTopic"/>
                <SecondaryButton v-if="guide.backLink" @click="guide.goBack()" class="mb-2">
                    {{__('Go Back')}}
                </SecondaryButton>
            </div>
            <hr>
            <p>{{ __(guide.tab) }}</p>
        </template>
        <div class="py-2" v-if="guide.isReady">
            <ProjectInfo v-if="guide.tab === 'Info'"/>
            <Category v-if="guide.tab === 'Category'"/>
            <TopicsTab v-if="guide.tab === 'Topic'" :topics="guide.getProjectTopics()"/>
        </div>
        <ModalDeletion/>
    </AuthenticatedLayout>
</template>
