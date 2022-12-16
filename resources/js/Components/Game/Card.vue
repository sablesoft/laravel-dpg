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
        height: 250px;
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
        padding-bottom: 5px;
        padding-top: 5px;
        margin-top: 0;
    }
    .card-actions>button {
        margin-left: 15px;
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
        <div v-if="game.activeCard.id !== null" class="card-content card-actions">
            <button @click="game.activeCardForward()">{{ __('Forward') + '  >  ' }}</button>
            <button v-if="!game.activeCard.tapped" @click="game.activeCardTap()">{{ __('Tap') }}</button>
            <button v-if="game.activeCard.tapped" @click="game.activeCardUntap()">{{ __('Untap') }}</button>
            <button @click="game.activeCardBackward()">{{ '  <  ' + __('Backward') }}</button>
        </div>
    </div>
</template>
