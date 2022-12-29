<script setup>
    import { game } from "@/Components/Game/js/game";
</script>
<template>
    <div class="aside shadow-sm sm:rounded-lg">
        <div class="aside-content aside-name">
            {{ game.activeInfo.currentName }}
        </div>
        <div class="aside-content aside-image">
            <img :src="game.activeInfo.image" alt="">
        </div>
        <div class="aside-content aside-name">
            {{ __('Land') }}
        </div>
        <div class="aside-content aside-desc">
            {{ game.activeInfo.currentDesc }}
        </div>

        <!-- selects -->
        <div class="aside-selects">
            <div v-if="Object.keys(game.filteredAreas('lands')).length" class="aside-content">
                <select v-model="game.selectedId" @change="game.selectArea($event)">
                    <option :value="null" disabled>{{ __('Areas') }}</option>
                    <option v-for="area in game.filteredAreas('lands')" :value="area.id">
                        {{ game.getAreaName(area) }}
                    </option>
                </select>
            </div>
            <div v-if="Object.keys(game.filteredScenes('lands')).length"
                 class="aside-content">
                <select v-model="game.selectedId" @change="game.selectScene($event)">
                    <option :value="null" disabled>{{ __('Scenes') }}</option>
                    <option v-for="scene in game.filteredScenes('lands')" :value="scene.id">
                        {{ game.getSceneName(scene) }}
                    </option>
                </select>
            </div>
            <div v-if="Object.keys(game.filteredSources('lands')).length" class="aside-content">
                <select v-model="game.selectedId" @change="game.selectBook($event)">
                    <option :value="null" disabled>{{ __('Books') }}</option>
                    <option v-for="book in game.filteredSources('lands')" :value="book.id">
                        {{ game.getBookName(book) }}
                    </option>
                </select>
            </div>
            <div v-if="Object.keys(game.filteredDecks('lands')).length" class="aside-content">
                <select v-model="game.selectedId" @change="game.selectDeck($event)">
                    <option :value="null" disabled>{{ __('Decks') }}</option>
                    <option v-for="deck in game.filteredDecks('lands')" :value="deck.id">
                        {{ deck.type + ' : ' + deck.target + ' - ' + deck.scope }}
                    </option>
                </select>
            </div>
            <div v-if="Object.keys(game.filteredCards('lands')).length" class="aside-content">
                <select v-model="game.selectedId" @change="game.selectCard($event)">
                    <option :value="null" disabled>{{ __('Cards') }}</option>
                    <option v-for="card in game.filteredCards('lands')" :value="card.id">
                        {{ game.getCardName(card) }}
                    </option>
                </select>
            </div>
        </div>

        <!-- actions -->
        <div class="aside-content aside-actions">
            <button v-if="game.isMaster() || game.visibleLandIds.includes(game.activeInfo.scopeId)"
                    class="control-btn control-forward" :title="__('Show Card')">
                <span class="material-icons" @click="game.switchCard(game.activeInfo.scopeId)">content_copy</span>
            </button>
            <button v-if="game.isMaster()" class="control-btn control-edit" :title="__('Edit')">
                <span class="material-icons" @click="game.editCurrent()">mode_edit</span>
            </button>
        </div>
    </div>
</template>
