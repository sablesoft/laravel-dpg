<script setup>
    import { game } from "@/Components/Game/game";
</script>
<style scoped>
    .card {
        text-align: center;
    }
    .card-name {
        font-weight: bold;
    }
    .card-scope {
        height: 80px;
        line-height: 80px;
        margin: 15px;
    }
    .card-content {
        margin-top: 10px;
    }
    .card-image {
        max-height: 250px;
    }
    .scope-image {
        height: 40px;
        margin: 15px;
    }
    .scope-image>img {
        height: 40px;
        margin: 10px;
    }
    .card-image>img {
        display: block;
        margin-left: auto;
        margin-right: auto;
        border-radius: 0.5rem;
    }
    .card-desc {
        height: 250px;
        text-align: left;
        margin-left: 20px;
        margin-right: 20px;
        white-space: pre-line;
        overflow: auto;
    }
    .card-actions {
        background-color: antiquewhite;
        font-weight: bold;
        font-size: 18px;
        padding-top: 5px;
        margin-top: 0;
    }
    .card-actions>button {
        margin-left: 15px;
    }
    .control-btn {
        flex-shrink:0;
        width:1.5em;
        height:1.5em;
        font-size:24px;
        display: inline;
        padding:.25em;
        justify-content:center;
        align-items:center;
        border-radius:8px;
        background:rgba(255,255,255,.8);
        transition:.5s all;
    }
    .control-btn:hover {
        background:rgba(255,255,255,1);
    }
    .control-btn .material-icons {
        font-size:1em;
        line-height:1em
    }
    .control-text {
        vertical-align: super;
    }
</style>
<template>
    <div v-if="game.activeCard" class="card shadow-sm sm:rounded-lg">
        <div class="card-content card-name">
            {{ game.activeCard.name }}
        </div>
        <div class="card-content card-image">
            <img :src="game.activeCard.image" alt="">
        </div>
        <div v-if="!game.activeCard.scopeImage" class="card-content card-name card-scope">
            {{ game.activeCard.scopeName }}
        </div>
        <div v-if="game.activeCard.scopeImage" class="card-content card-image scope-image">
            <img :src="game.activeCard.scopeImage"
                 :alt="game.activeCard.scopeName"
                 :title="game.activeCard.scopeName">
        </div>
        <div class="card-content card-desc">
            {{ game.activeCard.desc }}
        </div>
        <div v-if="game.activeCard.id !== null && game.mainTab === 'Board'" class="card-content card-actions">
            <button class="control-btn control-forward" :title="__('Forward')">
                <span class="material-icons" @click="game.activeCardForward()">upload</span>
            </button>
            <button class="control-text" v-if="!game.activeCard.tapped" @click="game.activeCardTap()">{{ __('Tap') }}</button>
            <button class="control-text" v-if="game.activeCard.tapped" @click="game.activeCardUntap()">{{ __('Untap') }}</button>
            <button class="control-btn control-forward" :title="__('Backward')">
                <span class="material-icons" @click="game.activeCardBackward()">download</span>
            </button>
        </div>
    </div>
</template>
