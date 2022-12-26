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
            {{ __('Dome') }}
        </div>
        <div class="aside-content aside-desc">
            {{ game.activeInfo.desc }}
        </div>
        <div class="aside-content">
            <select v-model="game.selectedId" @change="game.selectArea($event)">
                <option :value="null" disabled>{{ __('Areas') }}</option>
                <option v-for="area in game.filteredAreas('domes')" :value="area.id">
                    {{ area.name }}
                </option>
            </select>
        </div>
        <div class="aside-content">
            <select v-model="game.selectedId" @change="game.selectBook($event)">
                <option :value="null" disabled>{{ __('Books') }}</option>
                <option v-for="book in game.filteredSources('domes')" :value="book.id">
                    {{ book.name }}
                </option>
            </select>
        </div>
        <div class="aside-content">
            <select v-model="game.selectedId" @change="game.selectDeck($event)">
                <option :value="null" disabled>{{ __('Decks') }}</option>
                <option v-for="deck in game.filteredDecks('domes')" :value="deck.id">
                    {{ deck.type + ' : ' + deck.target + ' - ' + deck.scope }}
                </option>
            </select>
        </div>
        <div class="aside-content">
            <select v-model="game.selectedId" @change="game.selectCard($event)">
                <option :value="null" disabled>{{ __('Cards') }}</option>
                <option v-for="card in game.filteredCards('domes')" :value="card.id">
                    {{ card.name }}
                </option>
            </select>
        </div>
        <div v-if="game.isMaster() && game.mainTab === 'MainBoard'"
             class="aside-content aside-actions">
            <button v-if="!game.activeObject"
                    class="control-btn control-remove" :title="__('Add')">
                <span class="material-icons" @click="game.addDome()">add</span>
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
            <button class="control-btn control-forward" :title="__('Show Card')">
                <span class="material-icons" @click="game.showCard(game.activeInfo.scopeId)">content_copy</span>
            </button>
            <button v-if="!game.isActivated()" class="control-btn control-public" :title="__('Activate')">
                <span class="material-icons" @click="game.activateSpace()">public</span>
            </button>
            <button v-if="game.isActivated()" class="control-btn control-public" :title="__('Deactivate')">
                <span class="material-icons" @click="game.activateSpace(false)">public_off</span>
            </button>
            <button v-if="game.activeObject"
                    class="control-btn control-remove" :title="__('Remove')">
                <span class="material-icons" @click="game.remove()">delete</span>
            </button>
        </div>
        <div v-if="!game.isMaster() && game.mainTab === 'MainBoard'" class="aside-content aside-actions">
            <button v-if="game.visibleCardIds.includes(game.activeInfo.scopeId)"
                    class="control-btn control-forward" :title="__('Show Card')">
                <span class="material-icons"
                      @click="game.switchCard(game.activeInfo.scopeId)">content_copy</span>
            </button>
        </div>
    </div>
</template>
