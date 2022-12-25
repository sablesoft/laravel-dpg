<script setup>
import GameLayout from '@/Layouts/GameLayout.vue';

// main tabs:
import Board from '@/Components/Game/Board.vue';
import Map from '@/Components/Game/Map.vue';
import Scene from '@/Components/Game/Scene.vue';

// aside tabs:
import Info from '@/Components/Game/Info.vue';
import Card from '@/Components/Game/Card.vue';
import Book from '@/Components/Game/Book.vue';
import Dome from '@/Components/Game/Dome.vue';
import Area from '@/Components/Game/Area.vue';

import { Head } from '@inertiajs/inertia-vue3';
import { game } from "@/Components/Game/game";
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
    Info,
    Card,
    Book,
    Dome,
    Area
}
const mainTabs = {
    Board,
    Map,
    Scene
}

onMounted(() => {
    let options = {
        width: boardRef.value.offsetWidth,
        height: window.innerHeight - 100,
        role: props.role
    }
    game.init(props.data, options);
    console.debug('INITIAL DATA', toRaw(game));
});
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
.aside-column {
    flex: 24%;
    text-align: center;
}
.action-column>img {
    width: 50px;
    margin-left: auto;
    margin-right: auto;
    margin-top: 130px;
    cursor: pointer;
}
.control-btn {
    flex-shrink:0;
    width:1.5em;
    height:1.5em;
    font-size:24px;
    padding:.25em;
    display:flex;
    justify-content:center;
    align-items:center;
    border-radius:8px;
    background:rgba(255,255,255,.8);
    transition:.5s all;
    margin: auto auto 10px;
}
.control-btn:hover {
    background:rgba(255,255,255,1);
}
.control-btn .material-icons {
    font-size:1em;
    line-height:1em
}
</style>

<template>
    <!--suppress HtmlRequiredTitleElement -->
    <Head :title="data.info.name" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <GameLayout>
        <div class="mx-auto sm:px-6 lg:px-8 row">
            <div ref="boardRef" class="board-column bg-white overflow-hidden shadow-lg sm:rounded-lg">
                <component :is="mainTabs[game.mainTab]"></component>
            </div>
            <div class="action-column">
                <button v-if="game.canMap || game.canScene"
                        class="control-btn control-board"
                        :disabled="game.mainTab === 'Board'"
                        :title="__('Board')">
                    <span class="material-icons" @click="game.showMain('Board')">local_library</span>
                </button>
                <button v-if="game.canMap"
                        class="control-btn control-map"
                        :disabled="game.mainTab === 'Map'"
                        :title="__('Map')">
                    <span class="material-icons" @click="game.showMain('Map')">map</span>
                </button>
                <button v-if="game.canScene"
                        class="control-btn control-scene"
                        :disabled="game.mainTab === 'Scene'"
                        :title="__('Scene')">
                    <span class="material-icons" @click="game.showMain('Scene')">my_location</span>
                </button>
            </div>
            <div class="aside-column bg-white shadow-sm sm:rounded-lg">
                <component :is="asideTabs[game.asideTab]"></component>
            </div>
        </div>
    </GameLayout>
</template>
