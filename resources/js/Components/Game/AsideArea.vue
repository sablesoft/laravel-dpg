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
            {{ __('Area') }}
        </div>
        <div class="aside-content aside-desc">
            {{ game.activeInfo.desc }}
        </div>

        <!-- selects -->
        <div class="aside-selects">
            <div v-if="Object.keys(game.filteredScenes('areas')).length" class="aside-content">

                <select v-model="game.selectedId" @change="game.selectScene($event)">
                    <option :value="null" disabled>{{ __('Scenes') }}</option>
                    <option v-for="scene in game.filteredScenes('areas')" :value="scene.id">
                        {{ game.getSceneName(scene) }}
                    </option>
                </select>
            </div>
            <div v-if="Object.keys(game.filteredDecks('areas')).length" class="aside-content">
                <select v-model="game.selectedId" @change="game.selectDeck($event)">
                    <option :value="null" disabled>{{ __('Decks') }}</option>
                    <option v-for="deck in game.filteredDecks('areas')" :value="deck.id">
                        {{ deck.type + ' : ' + deck.target + ' - ' + deck.scope }}
                    </option>
                </select>
            </div>
            <div v-if="Object.keys(game.filteredCards('areas')).length" class="aside-content">
                <select v-model="game.selectedId" @change="game.selectCard($event)">
                    <option :value="null" disabled>{{ __('Cards') }}</option>
                    <option v-for="card in game.filteredCards('areas')" :value="card.id">
                        {{ game.getCardName(card) }}
                    </option>
                </select>
            </div>
        </div>

        <!-- actions -->
        <div v-if="game.isMaster() && game.mainTab === 'MainDome'"
             class="aside-content aside-actions">
            <button v-if="game.activeObject" class="control-btn control-forward" :title="__('Forward')">
                <span class="material-icons" @click="game.forward()">upload</span>
            </button>
            <button v-if="game.activeObject"
                    class="control-btn control-backward" :title="__('Backward')">
                <span class="material-icons" @click="game.backward()">download</span>
            </button>
            <button v-if="game.activeObject && game.activeObjectHidden"
                    class="control-btn control-show" :title="__('Show')">
                <span class="material-icons" @click="game.visibility()">visibility</span>
            </button>
            <button v-if="game.activeObject && !game.activeObjectHidden"
                    class="control-btn control-hide" :title="__('Hide')">
                <span class="material-icons" @click="game.visibility(false)">visibility_off</span>
            </button>
            <button v-if="game.activeObject"
                    class="control-btn control-center" :title="__('Center')">
                <span class="material-icons" @click="game.moveToCenter()">filter_center_focus</span>
            </button>
            <button v-if="!game.isActivated()" class="control-btn control-activate" :title="__('Activate')">
                <span class="material-icons" @click="game.activateSpace()">public</span>
            </button>
            <button v-if="game.isActivated()" class="control-btn control-deactivate" :title="__('Deactivate')">
                <span class="material-icons" @click="game.activateSpace(false)">public_off</span>
            </button>
        </div>
        <div v-if="!game.isMaster() && game.mainTab === 'MainDome'"
             class="aside-content aside-actions">
            <button v-if="game.activeObject"
                    class="control-btn control-center" :title="__('Center')">
                <span class="material-icons" @click="game.moveToCenter()">filter_center_focus</span>
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
