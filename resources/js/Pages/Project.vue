<!--suppress JSConstantReassignment -->
<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import Select from '@/Components/Select.vue';
import ProjectInfo from '@/Components/Guide/ProjectInfo.vue';
import ModalDeletion from '@/Components/Guide/ModalDeletion.vue';
import TopicsTab from '@/Components/Guide/TopicsTab.vue';
import ModuleInfo from "@/Components/Guide/ModuleInfo.vue";
import Category from '@/Components/Guide/Category.vue';
import TagTab from "@/Components/Guide/TagTab.vue";
import Buffer from '@/Components/Guide/Buffer.vue';
import { Head } from '@inertiajs/inertia-vue3';
import { guide } from "@/guide";
import { onMounted, toRaw } from "vue";

const props = defineProps({
    projectId: {
        type: Number,
        required: true
    },
    bufferId: {
        type: Number,
        required: true
    },
    projects: {
        type: Object,
        required: true
    },
    modules: {
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
    },
    tags: {
        type: Object,
        required: true
    },
    buffers: {
        type: Object,
        required: true
    }
});

onMounted(() => {
    guide.init({
        projectsId: toRaw(props.projectId),
        projects: props.projects,
        modules: props.modules,
        topics: props.topics,
        posts: props.posts,
        notes: props.notes,
        links: props.links,
        tags: props.tags,
        buffers: props.buffers,
        buffersId : props.bufferId
    });
    window.addEventListener('keydown', function(event) {
        const key = event.key;
        if (key === "Backspace" || key === "Delete") {
            if (guide.tagsId) {
                guide.askDeletion(guide.getTag());
            } else if (guide.linksId) {
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
let showInfo = function() {
    guide.changeTab('Info');
    guide.modulesId = null;
}
let showModule = function(id) {
    guide.changeTab('Module');
    if (id === 'new') {
        guide.moduleAdding = true;
    } else {
        guide.modulesId = id;
    }
}
let showCategory = function(id) {
    guide.changeTab('Category');
    if (id === 'new') {
        guide.categoriesId = null;
        guide.postAdding = true;
    } else {
        guide.categoriesId = id;
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
let showTag = function(id) {
    guide.changeTab('Tag');
    guide.topicsId = id;
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
                <span v-if="guide.modulesId">
                    - {{ guide.getModule().name }}
                </span>
            </h2>
            <div class="max-w-7xl mx-auto mt-2">
                <SecondaryButton @click="showInfo" class="mb-2 mr-2">
                    {{__('Info')}}
                </SecondaryButton>
                <Select placeholder="Modules" class="mb-2 mr-2"
                        :action="{id: 'new', name: 'New'}"
                        :items="guide.getProjectModules()" @change="showModule"/>
                <Select placeholder="Categories" class="mb-2 mr-2"
                        :action="{id: 'new', name: 'New'}"
                        :items="guide.getCategories()" @change="showCategory"/>
                <Select placeholder="Tags" class="mb-2 mr-2"
                        :items="guide.getTags()" @change="showTag"/>
                <Select placeholder="Topics" class="mb-2 mr-2"
                        :action="{id: 'new', name: 'New'}"
                        :items="guide.getTopics()" @change="showTopic"/>
                <Select placeholder="General Topics" class="mb-2 mr-2"
                        :action="{id: 'new', name: 'New'}"
                        :items="guide.getGeneralTopics()" @change="showTopic"/>
                <SecondaryButton @click="guide.changeTab('Buffer')" class="mb-2">
                    {{__('Buffer')}}
                </SecondaryButton>
                <SecondaryButton v-if="guide.backLink" @click="guide.goBack()" class="mb-2">
                    {{__('Go Back')}}
                </SecondaryButton>
            </div>
            <hr>
            <p>{{ __(guide.tab) }}</p>
        </template>
        <div class="py-2" v-if="guide.isReady">
            <ProjectInfo v-if="guide.tab === 'Info'"/>
            <ModuleInfo v-if="guide.tab === 'Module'"/>
            <Category v-if="guide.tab === 'Category'"/>
            <TagTab v-if="guide.tab === 'Tag'"/>
            <TopicsTab v-if="guide.tab === 'Topic'" :topics="guide.getTopics()"/>
            <Buffer v-if="guide.tab === 'Buffer'"/>
        </div>
        <ModalDeletion/>
    </AuthenticatedLayout>
</template>
