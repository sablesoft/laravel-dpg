<script setup>
    import { game } from "@/Components/Game/game";
</script>
<template>
    <div v-if="game.modeMarkers" class="aside shadow-sm sm:rounded-lg">
        <div class="aside-content">
            <select v-model="game.selectedId" @change="game.selectCard($event)">
                <option v-for="card in game.cards" :value="card.id">
                    {{ card.name }}
                </option>
            </select>
        </div>
    </div>
    <div class="aside shadow-sm sm:rounded-lg">
        <div class="aside-content aside-name">
            {{ game.activeCard.name }}
        </div>
        <div class="aside-content aside-image">
            <img :src="game.activeCard.image" alt="">
        </div>
        <div v-if="!game.activeCard.scopeImage" class="aside-content aside-name aside-scope">
            {{ game.activeCard.scopeName }}
        </div>
        <div v-if="game.activeCard.scopeImage" class="aside-content aside-image scope-image">
            <img :src="game.activeCard.scopeImage"
                 :alt="game.activeCard.scopeName"
                 :title="game.activeCard.scopeName">
        </div>
        <div class="aside-content aside-desc">
            {{ game.activeCard.desc }}
        </div>
        <div v-if="game.modeMarkers && game.selectedId" class="aside-content aside-actions">
            <button class="control-text" @click="game.addMarker()">{{ __('Add Marker') }}</button>
        </div>
        <div v-if="game.activeObject && !game.modeMarkers" class="aside-content aside-actions">
            <button class="control-btn control-forward" :title="__('Forward')">
                <span class="material-icons" @click="game.forward()">upload</span>
            </button>
            <button class="control-text" v-if="game.activeObjectType === 'card' && !game.activeCardTapped"
                    @click="game.activeCardTap()">{{ __('Tap') }}</button>
            <button class="control-text" v-if="game.activeObjectType === 'card' && game.activeCardTapped"
                    @click="game.activeCardUntap()">{{ __('Untap') }}</button>
            <button v-if="game.isMaster() && game.activeObjectHidden"
                    class="control-btn control-forward" :title="__('Show')">
                <span class="material-icons" @click="game.visibility()">visibility</span>
            </button>
            <button v-if="game.isMaster() && !game.activeObjectHidden"
                    class="control-btn control-forward" :title="__('Hide')">
                <span class="material-icons" @click="game.visibility(false)">visibility_off</span>
            </button>
            <button v-if="game.isMaster()" class="control-btn control-remove" :title="__('Remove')">
                <span class="material-icons" @click="game.remove()">delete</span>
            </button>
            <button class="control-btn control-forward" :title="__('Backward')">
                <span class="material-icons" @click="game.backward()">download</span>
            </button>
        </div>
    </div>
</template>
