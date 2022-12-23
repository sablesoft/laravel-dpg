<script setup>
    import { game } from "@/Components/Game/game";
</script>
<template>
    <div class="aside shadow-sm sm:rounded-lg">
        <div class="aside-content aside-name">
            {{ game.activeInfo.name }}
        </div>
        <div class="aside-content aside-image">
            <img :src="game.activeInfo.image" alt="">
        </div>
        <div v-if="!game.activeInfo.scopeImage" class="aside-content aside-name aside-scope">
            {{ game.activeCard.scopeName }}
        </div>
        <div v-if="game.activeInfo.scopeImage" class="aside-content aside-image scope-image">
            <img :src="game.activeInfo.scopeImage"
                 :alt="game.activeInfo.scopeName"
                 :title="game.activeInfo.scopeName">
        </div>
        <div class="aside-content aside-desc">
            {{ game.activeInfo.desc }}
        </div>
        <div class="aside-content aside-actions">
            <button class="control-btn control-forward" :title="__('TODO')">
                <span class="material-icons">upload</span>
            </button>
            <button class="control-text">{{ __('TODO') }}</button>
        </div>
    </div>
</template>
