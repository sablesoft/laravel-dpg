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
            {{ __('Dome') }}
        </div>

        <!-- selects -->
        <div class="aside-selects">
            <div v-if="Object.keys(game.filteredLands('domes')).length" class="aside-content">
                <select v-model="game.selectedId" @change="game.selectLand($event)">
                    <option :value="null" disabled>{{ __('Lands') }}</option>
                    <option v-for="land in game.filteredLands('domes')" :value="land.id">
                        {{ game.getLandName(land) }}
                    </option>
                </select>
            </div>
            <div v-if="Object.keys(game.filteredAreas('domes')).length" class="aside-content">
                <select v-model="game.selectedId" @change="game.selectArea($event)">
                    <option :value="null" disabled>{{ __('Areas') }}</option>
                    <option v-for="area in game.filteredAreas('domes')" :value="area.id">
                        {{ game.getAreaName(area) }}
                    </option>
                </select>
            </div>
            <div v-if="Object.keys(game.filteredScenes('domes')).length"
                 class="aside-content">
                <select v-model="game.selectedId" @change="game.selectScene($event)">
                    <option :value="null" disabled>{{ __('Scenes') }}</option>
                    <option v-for="scene in game.filteredScenes('domes')" :value="scene.id">
                        {{ game.getSceneName(scene) }}
                    </option>
                </select>
            </div>
            <div v-if="Object.keys(game.filteredSources('domes')).length" class="aside-content">
                <select v-model="game.selectedId" @change="game.selectBook($event)">
                    <option :value="null" disabled>{{ __('Books') }}</option>
                    <option v-for="book in game.filteredSources('domes')" :value="book.id">
                        {{ game.getBookName(book) }}
                    </option>
                </select>
            </div>
            <div v-if="game.mainTab === 'MainBoard' && Object.keys(game.filteredDecks('domes')).length"
                 class="aside-content">
                <select v-model="game.selectedId" @change="game.selectDeck($event)">
                    <option :value="null" disabled>{{ __('Decks') }}</option>
                    <option v-for="deck in game.filteredDecks('domes')" :value="deck.id">
                        {{ deck.type + ' : ' + deck.target + ' - ' + deck.scope }}
                    </option>
                </select>
            </div>
            <div v-if="Object.keys(game.filteredCards('domes')).length" class="aside-content">
                <select v-model="game.selectedId" @change="game.selectCard($event)">
                    <option :value="null" disabled>{{ __('Cards') }}</option>
                    <option v-for="card in game.filteredCards('domes')" :value="card.id">
                        {{ game.getCardName(card) }}
                    </option>
                </select>
            </div>
        </div>

        <!-- actions -->
        <div v-if="game.isMaster()" class="aside-content aside-actions">
            <button v-if="game.mainTab === 'MainBoard' && !game.activeObject"
                    class="control-btn control-remove" :title="__('Add')">
                <span class="material-icons" @click="game.addDome()">add</span>
            </button>
            <button v-if="game.mainTab === 'MainBoard' && game.activeObject"
                    class="control-btn control-forward" :title="__('Forward')">
                <span class="material-icons" @click="game.forward()">upload</span>
            </button>
            <button v-if="game.mainTab === 'MainBoard' && game.activeObject"
                    class="control-btn control-forward" :title="__('Backward')">
                <span class="material-icons" @click="game.backward()">download</span>
            </button>
            <button v-if="game.mainTab === 'MainBoard' && game.activeObject && game.activeObjectHidden"
                    class="control-btn control-forward" :title="__('Show')">
                <span class="material-icons" @click="game.visibility()">visibility</span>
            </button>
            <button v-if="game.mainTab === 'MainBoard' && game.activeObject && !game.activeObjectHidden"
                    class="control-btn control-forward" :title="__('Hide')">
                <span class="material-icons" @click="game.visibility(false)">visibility_off</span>
            </button>
            <button v-if="!game.isActivated()" class="control-btn control-public" :title="__('Activate')">
                <span class="material-icons" @click="game.activateSpace()">public</span>
            </button>
            <button v-if="game.isActivated()" class="control-btn control-public" :title="__('Deactivate')">
                <span class="material-icons" @click="game.activateSpace(false)">public_off</span>
            </button>
            <button class="control-btn control-forward" :title="__('Show Card')">
                <span class="material-icons" @click="game.showCard(game.activeInfo.scopeId, true)">content_copy</span>
            </button>
            <button v-if="game.getFilteredJournal('active').length"
                    class="control-btn control-journal"
                    :class="{'control-active' : game.isActiveJournalFilter()}"
                    :disabled="game.isActiveJournalFilter()"
                    :title="__('Journal')">
                <span class="material-icons" @click="game.showFilteredJournal('active')">local_library</span>
            </button>
            <button class="control-btn control-edit" :title="__('Edit')">
                <span class="material-icons" @click="game.editCurrent()">mode_edit</span>
            </button>
            <button v-if="game.activeObject"
                    class="control-btn control-remove" :title="__('Remove')">
                <span class="material-icons" @click="game.remove()">delete</span>
            </button>
        </div>
        <div v-if="!game.isMaster()" class="aside-content aside-actions">
            <button v-if="game.isExpert() || game.visibleCardIds.includes(game.activeInfo.scopeId)"
                    class="control-btn control-forward" :title="__('Show Card')">
                <span class="material-icons"
                      @click="game.switchCard(game.activeInfo.scopeId)">content_copy</span>
            </button>
            <button v-if="game.getFilteredJournal('active').length"
                    class="control-btn control-journal"
                    :class="{'control-active' : game.isActiveJournalFilter()}"
                    :disabled="game.isActiveJournalFilter()"
                    :title="__('Journal')">
                <span class="material-icons" @click="game.showFilteredJournal('active')">local_library</span>
            </button>
        </div>
    </div>
</template>
