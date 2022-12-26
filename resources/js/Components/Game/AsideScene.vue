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
        <div class="aside-content aside-name">
            {{ __('Scene') }}
        </div>
        <div class="aside-content aside-desc">
            {{ game.activeInfo.desc }}
        </div>
        <div class="aside-content" v-if="game.mainTab === 'MainScene'">
            <select v-model="game.selectedId" @change="game.selectScene($event)">
                <option :value="null" disabled>{{ __('Scenes') }}</option>
                <option v-for="scene in game.filteredScenes()" :value="scene.id">
                    {{ scene.name }}
                </option>
            </select>
        </div>
        <div class="aside-content">
            <select v-model="game.selectedId" @change="game.selectDeck($event)">
                <option :value="null" disabled>{{ __('Decks') }}</option>
                <option v-for="deck in game.filteredDecks('scenes')" :value="deck.id">
                    {{ deck.type + ' : ' + deck.target + ' - ' + deck.scope }}
                </option>
            </select>
        </div>
        <div class="aside-content">
            <select v-model="game.selectedId" @change="game.selectCard($event)">
                <option :value="null" disabled>{{ __('Cards') }}</option>
                <option v-for="card in game.filteredCards('scenes')" :value="card.id">
                    {{ card.name }}
                </option>
            </select>
        </div>
        <div v-if="game.isMaster() && game.mainTab !== 'MainBoard'"
             class="aside-content aside-actions">
            <button v-if="!game.isActivated()" class="control-btn control-public" :title="__('Activate')">
                <span class="material-icons" @click="game.activateSpace()">public</span>
            </button>
            <button v-if="game.isActivated()" class="control-btn control-public" :title="__('Deactivate')">
                <span class="material-icons" @click="game.activateSpace(false)">public_off</span>
            </button>
        </div>
        <div v-if="game.mainTab === 'MainBoard'" class="aside-content aside-actions">
            <button v-if="game.isMaster() || game.visibleCardIds.includes(game.activeInfo.scopeId)"
                    class="control-btn control-forward" :title="__('Show Card')">
                <span class="material-icons"
                      @click="game.switchCard(game.activeInfo.scopeId)">content_copy</span>
            </button>
            <button v-if="game.isMaster() && !game.isActivated()" class="control-btn control-public"
                    :title="__('Activate')">
                <span class="material-icons" @click="game.activateSpace()">public</span>
            </button>
            <button v-if="game.isMaster() && game.isActivated()" class="control-btn control-public"
                    :title="__('Deactivate')">
                <span class="material-icons" @click="game.activateSpace(false)">public_off</span>
            </button>
        </div>
    </div>
</template>
