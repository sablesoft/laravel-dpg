<!--suppress JSConstantReassignment -->
<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import Select from '@/Components/Select.vue';
import ProjectInfo from '@/Components/Guide/ProjectInfo.vue';
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
            if (guide.notesId) {
                guide.delete(guide.getNote());
            } else if (guide.postsId) {
                guide.delete(guide.getPost());
            }
        }
        if (key === "Escape") {
            guide.resetSelect();
        }
    });
});
let showCategory = function(id) {
    guide.changeTab('Category');
    if (id === 'post') {
        guide.isAddPost = true;
    } else {
        guide.categoriesId = id;
    }
}

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
            <h2 v-if="guide.isReady" class="block-title inline font-semibold text-xl text-gray-800 leading-tight">
                {{ guide.getProject().name + ' ('+ guide.getProject().code +')'}}
            </h2>
            <div class="inline max-w-7xl mx-auto sm:px-6 lg:px-8">
                <SecondaryButton @click="guide.changeTab('Info')" class="mb-2">
                    {{__('Info')}}
                </SecondaryButton>
                <Select placeholder="Categories" :action="{id: 'post', name: 'Create Post'}"
                        :items="guide.getProjectCategories()" @change="showCategory"/>
                <SecondaryButton @click="guide.changeTab('Topics')" class="mb-2">
                    {{__('Topics')}}
                </SecondaryButton>
                <SecondaryButton v-if="guide.backLink" @click="guide.goBack()" class="mb-2">
                    {{__('Go Back')}}
                </SecondaryButton>
            </div>
            <hr>
            <p>{{ __(guide.tab) }}</p>
        </template>
        <div class="py-2" v-if="guide.isReady">
            <div v-if="guide.tab === 'Info'" class="py-2">
                <ProjectInfo/>
            </div>
            <div v-if="guide.tab === 'Category'" class="py-2">
                <Category/>
            </div>
            <div v-if="guide.tab === 'Topics'" class="py-2">
                <TopicsTab :topics="guide.getProjectTopics()"/>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
