<!--suppress JSUnresolvedVariable -->
<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/inertia-vue3";
import { useForm } from "@inertiajs/inertia-vue3";
import {onMounted, reactive, ref} from "vue";

import Codemirror from "codemirror-editor-vue3";
import "codemirror/mode/javascript/javascript.js";
import "codemirror/addon/display/placeholder.js";

const cmFontSize = ref(12);
const cmThemes = [
    '3024-day', '3024-night', 'abbott', 'abcdef', 'ambiance', 'ayu-dark', 'ayu-mirage', 'base16-dark', 'base16-light',
    'bespin', 'blackboard', 'cobalt', 'colorforth', 'darcula', 'dracula', 'duotone-dark', 'duotone-light',
    "duotone-light", "eclipse", "elegant", "erlang-dark", "gruvbox-dark", "hopscotch", "icecoder", "idea", "isotope",
    "juejin", "lesser-dark", "liquibyte", "lucario", "material", "material-darker", "material-palenight", "material-ocean",
    "mbo", "mdn-like", "midnight", "monokai", "moxer", "neat", "neo", "night", "nord", "oceanic-next", "panda-syntax",
    "paraiso-dark", "paraiso-light", "pastel-on-dark", "railscasts", "rubyblue", "seti", "shadowfox", "solarized-dark",
    "solarized-light", "the-matrix", "tomorrow-night-bright", "tomorrow-night-eighties", "ttcn", "twilight", "vibrant-ink",
    "xq-dark", "xq-light", "yeti", "yonce", "zenburn"
];
let cmThemesLoaded = [];

const props = defineProps({
    world: {
        type: Object,
        required: true,
    },
    editorWidth: {
        type: Number,
        default: 1080,
    },
    editorHeight: {
        type: Number,
        default: 800,
    },
    editorTheme: {
        type: String,
        default: 'default'
    }
});

const cmOptions = reactive({
    mode: "text/javascript", // Language mode
    theme: props.editorTheme,
});
const fileEditor = ref('settings');

const form = useForm({
    id: props.world.id,
    name: props.world.name,
    slug: props.world.slug,
    desc: props.world.desc,
    files : props.world.files
});
const mirrorChange = function(event) {
    // console.log(event);
}
const cmThemeChanged = function(event) {
    let theme = event.target.value;
    if (theme !== 'default' && !cmThemesLoaded.includes(theme)) {
        let file = document.createElement('link');
        file.rel = 'stylesheet';
        file.href = '/build/assets/theme/' + theme + '.css';
        document.head.appendChild(file)
        cmThemesLoaded.push(theme);
    }
}

const submit = () => {
    form.put(route("worlds.update", props.world.id));
};
onMounted(() => {
    console.log(props.world);
})
</script>
<template>
    <Head title="World Edit" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                World Edit
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <form @submit.prevent="submit">
                            <div class="mb-6">
                                <label for="name"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                    Name
                                </label>
                                <input
                                    type="text"
                                    v-model="form.name"
                                    name="name"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    placeholder=""/>
                                <div v-if="form.errors.name"
                                    class="text-sm text-red-600">
                                    {{ form.errors.name }}
                                </div>
                            </div>
                            <div class="mb-6">
                                <label for="slug"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                    Slug
                                </label>
                                <input type="text" v-model="form.slug" name="slug"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    placeholder=""/>
                                <div v-if="form.errors.slug"
                                    class="text-sm text-red-600">
                                    {{ form.errors.slug }}
                                </div>
                            </div>
                            <div class="mb-6">
                                <label for="desc"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                    Desc
                                </label>
                                <textarea type="text" v-model="form.desc" name="desc" id=""
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                </textarea>
                                <div v-if="form.errors.desc" class="text-sm text-red-600">
                                    {{ form.errors.desc }}
                                </div>
                            </div>
                            <div class="mb-6">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                    Files
                                </label>
                                <div class="inline mb-2">
                                    <label for="cmThemeSelect" class="mr-2">Theme</label>
                                    <select v-model="cmOptions.theme" class="mr-2" id="cmThemeSelect" @change="cmThemeChanged">
                                        <option>default</option>
                                        <option v-for="theme in cmThemes">{{theme}}</option>
                                    </select>
                                    <label for="fontSize" class="mr-2">Font Size</label>
                                    <input type="number" id="fontSize" v-model="cmFontSize" step="1" min="8" class="mr-2"/>

                                    <label for="fileSelect" class="mr-2">File</label>
                                    <select v-model="fileEditor" class="mr-2" id="fileSelect">
                                        <option v-for="(file, name) in world.files">{{name}}</option>
                                    </select>
                                </div>

                                <div v-for="(file, name) in world.files" class="mt-4">
                                    <Codemirror v-if="fileEditor === name" v-model:value="form.files[name]"
                                        :style="{'font-size' : cmFontSize + 'pt'}"
                                        :options="cmOptions" border
                                        placeholder="// write your code there"
                                        :height="editorHeight"
                                        :width="editorWidth"
                                        @change="mirrorChange"/>
                                </div>
                            </div>
                            <button type="submit"
                                class="text-white bg-blue-700  focus:outline-none  font-medium rounded-lg text-sm px-5 py-2.5 "
                                :disabled="form.processing" :class="{ 'opacity-25': form.processing }">
                                Submit
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
