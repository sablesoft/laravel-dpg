<script setup>
    import { game } from "@/Components/Game/js/game";
</script>
<template>
    <div class="aside shadow-sm sm:rounded-lg">
        <div class="aside-content aside-name">
            {{ game.activeInfo.name }}
        </div>
        <div class="aside-content aside-image">
            <img :src="game.activeInfo.image" alt="">
        </div>
        <div v-if="!game.activeInfo.scopeImage" class="aside-content aside-name">
            {{ __(game.activeInfo.scopeName) }}
        </div>
        <div v-if="game.activeInfo.scopeImage" class="aside-content aside-image scope-image">
            <img :src="game.activeInfo.scopeImage"
                 :alt="game.activeInfo.scopeName"
                 :title="game.activeInfo.scopeName">
        </div>
        <div class="aside-content aside-desc">
            {{ game.activeInfo.desc }}
        </div>
        <div class="aside-content" v-if="game.mainTab !== 'MainBoard'">
            <select v-model="game.selectedId" @change="game.selectBook($event)">
                <option :value="null" disabled>{{ __('All Books') }}</option>
                <option v-for="book in game.filteredSources('all')" :value="book.id">
                    {{ book.name }}
                </option>
            </select>
        </div>
        <div class="aside-content" v-if="game.mainTab !== 'MainScene'">
            <select v-model="game.selectedId" @change="game.selectDome($event)">
                <option :value="null" disabled>{{ __('Domes') }}</option>
                <option v-for="dome in game.filteredDomes()" :value="dome.id">
                    {{ game.cards[dome.scope_id].name }}
                </option>
            </select>
        </div>
        <div class="aside-content" v-if="game.mainTab === 'MainDome'">
            <select v-model="game.selectedId" @change="game.selectArea($event)">
                <option :value="null" disabled>{{ __('Areas') }}</option>
                <option v-for="area in game.filteredAreas()" :value="area.id">
                    {{ game.cards[area.scope_id].name }}
                </option>
            </select>
        </div>
        <div class="aside-content">
            <select v-model="game.selectedId" @change="game.selectScene($event)">
                <option :value="null" disabled>{{ __('Scenes') }}</option>
                <option v-for="scene in game.filteredScenes()" :value="scene.id">
                    {{ game.cards[scene.scope_id].name }}
                </option>
            </select>
        </div>
        <div class="aside-content">
            <select v-model="game.selectedId" @change="game.selectBook($event)">
                <option :value="null" disabled>{{ __('Books') }}</option>
                <option v-for="book in game.filteredSources()" :value="book.id">
                    {{ book.name }}
                </option>
            </select>
        </div>
        <div class="aside-content" v-if="game.mainTab === 'MainBoard'">
            <select v-model="game.selectedId" @change="game.selectDeck($event)">
                <option :value="null" disabled>{{ __('Decks') }}</option>
                <option v-for="deck in game.filteredDecks()" :value="deck.id">
                    {{ deck.type + ' : ' + deck.target + ' - ' + deck.scope }}
                </option>
            </select>
        </div>
        <div class="aside-content">
            <select v-model="game.selectedId" @change="game.selectCard($event)">
                <option :value="null" disabled>{{ __('Cards') }}</option>
                <option v-for="card in game.filteredCards()" :value="card.id">
                    {{ card.name }}
                </option>
            </select>
        </div>
    </div>
</template>
