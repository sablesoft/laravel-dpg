<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import ProjectNotes from '@/Components/Guide/ProjectNotes.vue';
import ProjectTopics from '@/Components/Guide/ProjectTopics.vue';
import {Head} from '@inertiajs/inertia-vue3';

import { guide } from "@/guide";

import {onMounted, shallowRef, toRaw} from "vue";

const tabName = shallowRef('notes');

const props = defineProps({
    project: {
        type: Object,
        required: true
    },
    topics: {
        type: Object,
        required: true
    }
});

onMounted(() => {
    guide.init({
        project: props.project,
        topics: props.topics
    })
    console.debug('PROJECT', toRaw(props.project));
});

</script>
<style scoped>
    button {
        margin-right: 5px;
    }
</style>
<template>
    <Head>
        <title>{{ project.data.code }}</title>
    </Head>

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ project.data.name + ' ('+ project.data.code +')'}}
            </h2>
        </template>
        <div class="py-2" v-if="guide.isReady">
            <div class="py-2">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <SecondaryButton @click="tabName = 'notes'">
                        {{__('Notes')}}
                    </SecondaryButton>
                    <SecondaryButton @click="tabName = 'posts'">
                        {{__('Posts')}}
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
                <ProjectTopics/>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
