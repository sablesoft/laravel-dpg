<script setup>
import GameLayout from '@/Layouts/GameLayout.vue';

// main tabs:
import Board from '@/Components/Game/Board.vue';
import Map from '@/Components/Game/Map.vue';
import Scene from '@/Components/Game/Scene.vue';

// aside tabs:
import Card from '@/Components/Game/Card.vue';
import Book from '@/Components/Game/Book.vue';

import { Head } from '@inertiajs/inertia-vue3';
import { game } from "@/Components/Game/game";
import {onMounted, shallowRef} from "vue";

const boardRef = shallowRef(null);

const props = defineProps({
    data: {
        type: Object,
        required: true
    }
});
const asideTabs = {
    Card,
    Book
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
    }
    game.init(props.data, options);
    console.debug(game);
});
</script>

<style scoped>
.row {
    display: flex;
    padding: 1rem;
}
.board-column {
    flex: 70%;
    position: relative;
}
.action-column {
    flex: 6%;
}
.info-column {
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
</style>

<template>
    <!--suppress HtmlRequiredTitleElement -->
    <Head :title="data.info.name" />
    <GameLayout>
        <div class="mx-auto sm:px-6 lg:px-8 row">
            <div ref="boardRef" class="board-column bg-white overflow-hidden shadow-lg sm:rounded-lg">
                <component :is="mainTabs[game.mainTab]"></component>
            </div>
            <div class="action-column">
                <img @click="game.showBoard()" src="/img/svg/card-play.svg" alt="Open Board">
                <img v-if="game.activeDomeId" @click="game.showMap()" src="/img/svg/treasure-map.svg" alt="Open Map">
                <img v-if="game.activeSceneId" @click="game.showScene()" src="/img/svg/magnifying-glass.svg" alt="Open Scene">
            </div>
            <div class="info-column bg-white shadow-sm sm:rounded-lg">
                <component :is="asideTabs[game.asideTab]"></component>
            </div>
        </div>
    </GameLayout>
</template>
