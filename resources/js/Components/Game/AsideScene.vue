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
            {{ __('Scene') }}
        </div>
        <div class="aside-content aside-desc">
            {{ game.activeInfo.currentDesc }}
        </div>

        <!-- selects -->
        <div class="aside-selects">
            <div v-if="game.mainTab === 'MainScene'" class="aside-content">
                <select v-model="game.selectedId" @change="game.selectScene($event)">
                    <option :value="null" disabled>{{ __('Scenes') }}</option>
                    <option v-for="scene in game.filteredScenes()" :value="scene.id">
                        {{ game.getSceneName(scene) }}
                    </option>
                </select>
            </div>
            <div v-if="game.mainTab === 'MainBoard' && Object.keys(game.filteredDecks('scenes')).length"
                 class="aside-content">
                <select v-model="game.selectedId" @change="game.selectDeck($event)">
                    <option :value="null" disabled>{{ __('Decks') }}</option>
                    <option v-for="deck in game.filteredDecks('scenes')" :value="deck.id">
                        {{ deck.type + ' : ' + deck.target + ' - ' + deck.scope }}
                    </option>
                </select>
            </div>
            <div v-if="Object.keys(game.filteredCards('scenes')).length" class="aside-content">
                <select v-model="game.selectedId" @change="game.selectCard($event)">
                    <option :value="null" disabled>{{ __('Cards') }}</option>
                    <option v-for="card in game.filteredCards('scenes')" :value="card.id">
                        {{ game.getCardName(card) }}
                    </option>
                </select>
            </div>
        </div>

        <!-- actions -->
        <div v-if="game.isMaster() && game.mainTab !== 'MainBoard'"
             class="aside-content aside-actions">
            <button v-if="!game.isActivated()" class="control-btn control-public" :title="__('Activate')">
                <span class="material-icons" @click="game.activateSpace()">public</span>
            </button>
            <button v-if="game.isActivated()" class="control-btn control-public" :title="__('Deactivate')">
                <span class="material-icons" @click="game.activateSpace(false)">public_off</span>
            </button>
            <button class="control-btn control-forward" :title="__('Show Card')">
                <span class="material-icons"
                      @click="game.switchCard(game.activeInfo.scopeId)">content_copy</span>
            </button>
            <button v-if="game.activeInfo.id && game.getFilteredJournal('active').length"
                    class="control-btn control-journal"
                    :class="{'control-active' : game.isActiveJournalFilter()}"
                    :disabled="game.isActiveJournalFilter()"
                    :title="__('Journal')">
                <span class="material-icons" @click="game.showFilteredJournal('active')">local_library</span>
            </button>
            <button class="control-btn control-edit" :title="__('Edit')">
                <span class="material-icons" @click="game.editCurrent()">mode_edit</span>
            </button>
        </div>
        <div v-if="game.mainTab === 'MainBoard'" class="aside-content aside-actions">
            <button v-if="game.isMaster() && !game.isActivated()" class="control-btn control-public"
                    :title="__('Activate')">
                <span class="material-icons" @click="game.activateSpace()">public</span>
            </button>
            <button v-if="game.isMaster() && game.isActivated()" class="control-btn control-public"
                    :title="__('Deactivate')">
                <span class="material-icons" @click="game.activateSpace(false)">public_off</span>
            </button>
            <button v-if="game.isMaster() || game.visibleCardIds.includes(game.activeInfo.scopeId)"
                    class="control-btn control-forward" :title="__('Show Card')">
                <span class="material-icons"
                      @click="game.switchCard(game.activeInfo.scopeId)">content_copy</span>
            </button>
            <button v-if="game.activeInfo.id && game.getFilteredJournal('active').length"
                    class="control-btn control-journal"
                    :class="{'control-active' : game.isActiveJournalFilter()}"
                    :disabled="game.isActiveJournalFilter()"
                    :title="__('Journal')">
                <span class="material-icons" @click="game.showFilteredJournal('active')">local_library</span>
            </button>
            <button v-if="game.isMaster()" class="control-btn control-edit" :title="__('Edit')">
                <span class="material-icons" @click="game.editCurrent()">mode_edit</span>
            </button>
        </div>
        <div v-if="!game.isMaster() && game.mainTab !== 'MainBoard'"
             class="aside-content aside-actions">
            <button v-if="game.visibleCardIds.includes(game.activeInfo.scopeId)"
                    class="control-btn control-forward" :title="__('Show Card')">
                <span class="material-icons"
                      @click="game.switchCard(game.activeInfo.scopeId)">content_copy</span>
            </button>
            <button v-if="game.activeInfo.id && game.getFilteredJournal('active').length"
                    class="control-btn control-journal"
                    :class="{'control-active' : game.isActiveJournalFilter()}"
                    :disabled="game.isActiveJournalFilter()"
                    :title="__('Journal')">
                <span class="material-icons" @click="game.showFilteredJournal('active')">local_library</span>
            </button>
        </div>
    </div>
</template>
