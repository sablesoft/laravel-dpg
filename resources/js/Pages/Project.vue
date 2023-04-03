<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import Editable from '@/Components/Editable.vue';
import {Head, useForm} from '@inertiajs/inertia-vue3'

import {onMounted, shallowRef, toRaw} from "vue";

const tabName = shallowRef('notes');
const addNote = shallowRef(false);
const form = useForm({
    topicId: null,
    content: null
});

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

let request = function(routeName, post, callback) {
    axios.post(route(routeName), post)
    .then(response => callback(response))
    .catch(err => {
        console.error(err);
    });
}

let updateProject = function(field, value) {
    request('guide.update', {
        table: 'projects',
        id: props.project.data.id,
        field: field,
        value: value
    }, function(res) {
        console.debug(res);
        props.project.data[field] = value;
    });
}

let updateNote = function(id, value) {
    request('guide.update', {
        table: 'notes',
        id: id,
        field: 'content',
        value: value
    }, function(res) {
        console.debug(res);
        let note = props.project.data.notes[id];
        note.content = value;
    });
}

let createNote = function(config, callback) {
    let post = {
        table: 'notes',
        data: {
            topic_id: config['topicId'],
            content: config['content']
        }
    };
    post['data'][config['target'] + '_id'] = config['targetId'];
    request('guide.create', post, callback);
}

let addProjectNote = function() {
    createNote({
        target : 'project',
        targetId :  props.project.data.id,
        topicId : form.topicId,
        content : form.content
    }, function(res) {
        console.log(res);
    });
}

onMounted(() => {
    console.debug('PROJECT', toRaw(props.project));
});

</script>
<style scoped>
    button {
        margin-right: 5px;
    }
    .note-mark {
        font-weight: bold;
    }
    .note-row {
        margin-bottom: 8px;
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
        <div class="py-2">
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
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-4 text-gray-900">
                            <p class="note-row">
                                <span class="note-mark">{{ __('Name')}}: </span>
                                <Editable :text="project.data.name"
                                          @updated="(text) => updateProject('name', text)"/>
                            </p>
                            <p class="note-row">
                                <span class="note-mark">{{ __('Code')}}: </span>
                                <Editable :text="project.data.code"
                                          @updated="(text) => updateProject('code', text)"/>
                            </p>
                            <p v-for="note in project.data.notes" class="note-row">
                                <span class="note-mark">{{ __(note.topic.name)}}: </span>
                                <Editable :text="note.content"
                                          @updated="(text) => updateNote(note.id, text)"/>
                            </p>
                            <SecondaryButton v-if="!addNote" @click="addNote = !addNote">
                                {{__('Add Note')}}
                            </SecondaryButton>
                            <form v-if="addNote" @submit.prevent="addProjectNote">
                                <br/><hr/><br/>
                                <div>
                                    <InputLabel for="topic" :value="__('Topic')" />
                                    <select v-model="form.topicId" required class="mt-1 block w-full">
                                        <option :value="null" disabled>{{ __('Select Note Topic') }}</option>
                                        <option v-for="topic in topics.data" :value="topic.id">
                                            {{ topic.name }}
                                        </option>
                                    </select>
                                    <InputError class="mt-2" :message="form.errors.topicId" />
                                </div>
                                <div>
                                    <InputLabel for="content" value="Content" />
                                    <TextInput id="content" type="text" class="mt-1 block w-full"
                                               v-model="form.content" required />
                                    <InputError class="mt-2" :message="form.errors.content" />
                                </div>

                                <div class="flex items-center justify-end mt-4">
                                    <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                        Add
                                    </PrimaryButton>
                                </div>
                            </form>
                            <br/><br/><hr/><br/>
                            <p class="note-row">
                                <span class="note-mark">{{ __('Created At')}}:</span>
                                {{ project.data.createdAt }}
                            </p>
                            <p class="note-row">
                                <span class="note-mark">{{ __('Updated At')}}:</span>
                                {{ project.data.updatedAt }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
