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
            {{ __('Book') }}
        </div>
        <div class="aside-content aside-desc">
            {{ game.activeInfo.currentDesc }}
        </div>

        <!-- selects -->
        <div class="aside-selects">
            <div v-if="Object.keys(game.filteredDomes('books')).length" class="aside-content">
                <select v-model="game.selectedId" @change="game.selectDome($event)">
                    <option :value="null" disabled>{{ __('Domes') }}</option>
                    <option v-for="dome in game.filteredDomes('books')" :value="dome.id">
                        {{ game.getDomeName(dome) }}
                    </option>
                </select>
            </div>
            <div v-if="Object.keys(game.filteredScenes('books')).length" class="aside-content">
                <select v-model="game.selectedId" @change="game.selectScene($event)">
                    <option :value="null" disabled>{{ __('Scenes') }}</option>
                    <option v-for="scene in game.filteredScenes('books')" :value="scene.id">
                        {{ game.getSceneName(scene) }}
                    </option>
                </select>
            </div>
            <div v-if="game.mainTab === 'MainBoard' && Object.keys(game.filteredDecks('books')).length"
                 class="aside-content">
                <select v-model="game.selectedId" @change="game.selectDeck($event)">
                    <option :value="null" disabled>{{ __('Decks') }}</option>
                    <option v-for="deck in game.filteredDecks('books')" :value="deck.id">
                        {{ deck.type + ' : ' + deck.target + ' - ' + deck.scope }}
                    </option>
                </select>
            </div>
            <div v-if="Object.keys(game.filteredCards('books')).length" class="aside-content">
                <select v-model="game.selectedId" @change="game.selectCard($event)">
                    <option :value="null" disabled>{{ __('Cards') }}</option>
                    <option v-for="card in game.filteredCards('books')" :value="card.id">
                        {{ game.getCardName(card) }}
                    </option>
                </select>
            </div>
        </div>

        <!-- actions -->
        <div v-if="game.isMaster() && game.mainTab === 'MainBoard'"
             class="aside-content aside-actions">
            <button v-if="!game.activeObject"
                    class="control-btn control-remove" :title="__('Add')">
                <span class="material-icons" @click="game.addBook()">add</span>
            </button>
            <button v-if="game.activeObject" class="control-btn control-forward" :title="__('Forward')">
                <span class="material-icons" @click="game.forward()">upload</span>
            </button>
            <button v-if="game.activeObject"
                    class="control-btn control-forward" :title="__('Backward')">
                <span class="material-icons" @click="game.backward()">download</span>
            </button>
            <button v-if="game.activeObject && game.activeObjectHidden"
                    class="control-btn control-forward" :title="__('Show')">
                <span class="material-icons" @click="game.visibility()">visibility</span>
            </button>
            <button v-if="game.activeObject && !game.activeObjectHidden"
                    class="control-btn control-forward" :title="__('Hide')">
                <span class="material-icons" @click="game.visibility(false)">visibility_off</span>
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
        <div v-if="game.isMaster() && game.mainTab !== 'MainBoard'"
             class="aside-content aside-actions">
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
        </div>
        <div v-if="!game.isMaster()" class="aside-content aside-actions">
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
