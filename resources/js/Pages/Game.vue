<script setup>
import GameLayout from '@/Layouts/GameLayout.vue';

// main tabs:
import MainBoard from '@/Components/Game/MainBoard.vue';
import MainDome from '@/Components/Game/MainDome.vue';
import MainScene from '@/Components/Game/MainScene.vue';

// aside tabs:
import AsideInfo from '@/Components/Game/AsideInfo.vue';
import AsideCard from '@/Components/Game/AsideCard.vue';
import AsideBook from '@/Components/Game/AsideBook.vue';
import AsideDome from '@/Components/Game/AsideDome.vue';
import AsideLand from '@/Components/Game/AsideLand.vue';
import AsideArea from '@/Components/Game/AsideArea.vue';
import AsideScene from '@/Components/Game/AsideScene.vue';

import {Head, usePage} from '@inertiajs/inertia-vue3';
import { game } from "@/Components/Game/js/game";
import {onMounted, shallowRef, toRaw} from "vue";

const boardRef = shallowRef(null);

const props = defineProps({
    data: {
        type: Object,
        required: true
    },
    role: {
        type: String,
        required: true
    }
});
const asideTabs = {
    AsideInfo,
    AsideCard,
    AsideBook,
    AsideDome,
    AsideLand,
    AsideArea,
    AsideScene
}
const mainTabs = {
    MainBoard,
    MainDome,
    MainScene
}

onMounted(() => {
    let options = {
        width: boardRef.value.offsetWidth,
        height: window.innerHeight - 100,
        role: props.role,
        locale: usePage().props.value.locale,
        dictionary: usePage().props.value.language
    }
    game.init(props.data, options);
    console.debug('INITIAL DATA', toRaw(game));
});
let pageName = function() {
    let raw = props.data.info.name;
    return raw[usePage().props.value.locale] ?
        raw[usePage().props.value.locale] : raw['en'];
}
</script>

<style scoped>
.row {
    display: flex;
    padding: 1rem;
}
.board-column {
    flex: 72%;
    position: relative;
}
.action-column {
    flex: 4%;
}
.action-column .control-btn {
    display: flex;
}
.aside-column {
    flex: 24%;
    text-align: center;
}
</style>

<template>
    <!--suppress HtmlRequiredTitleElement -->
    <Head :title="pageName()" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <GameLayout>
        <div class="mx-auto sm:px-6 lg:px-8 row">
            <div ref="boardRef" class="board-column bg-white overflow-hidden shadow-lg sm:rounded-lg">
                <component :is="mainTabs[game.mainTab]"></component>
            </div>
            <div class="action-column">
                <button v-if="game.activeDomeId || game.activeSceneId"
                        class="control-btn control-board"
                        :disabled="game.mainTab === 'MainBoard'"
                        :title="__('Board')">
                    <span class="material-icons" @click="game.showMain('MainBoard')">local_library</span>
                </button>
                <button v-if="game.activeDomeId"
                        class="control-btn control-dome"
                        :disabled="game.mainTab === 'MainDome'"
                        :title="__('Dome')">
                    <span class="material-icons" @click="game.showMain('MainDome')">map</span>
                </button>
                <button v-if="game.activeSceneId"
                        class="control-btn control-scene"
                        :disabled="game.mainTab === 'MainScene'"
                        :title="__('Scene')">
                    <span class="material-icons" @click="game.showMain('MainScene')">my_location</span>
                </button>
            </div>
            <div class="aside-column bg-white shadow-sm sm:rounded-lg">
                <component :is="asideTabs[game.asideTab]"></component>
            </div>
        </div>
    </GameLayout>
</template>
