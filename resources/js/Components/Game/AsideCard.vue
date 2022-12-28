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
        <div v-if="!game.activeInfo.scopeImage" :class="{ visible : game.visible('card') }"
             @click="game.visible('card', game.activeInfo.scopeId) ?
                    game.showCard(game.activeInfo.scopeId) : function() {}"
             class="aside-content aside-name aside-scope">
            {{ game.activeInfo.scopeName }}
        </div>
        <div v-if="game.activeInfo.scopeImage" :class="{ visible : game.visible('card') }"
             @click="game.visible('card', game.activeInfo.scopeId) ?
                    game.showCard(game.activeInfo.scopeId) : function() {}"
             class="aside-content aside-image scope-image">
            <img :src="game.activeInfo.scopeImage"
                 :alt="game.activeInfo.scopeName"
                 :title="game.activeInfo.scopeName">
        </div>
        <!-- desc -->
        <div class="aside-content aside-desc">
            {{ game.activeInfo.desc }}
        </div>
        <!-- selects -->
        <div class="aside-selects">
            <div v-if="game.mainTab === 'MainBoard' &&
                        Object.keys(game.filteredDecks('.target_id')).length"
                 class="aside-content">
                <select v-model="game.selectedId" @change="game.selectDeck($event)">
                    <option :value="null" disabled>{{ __('Decks') }}</option>
                    <option v-for="deck in game.filteredDecks('.target_id')"
                            :value="deck.id">
                        {{ deck.type + ' : ' + deck.target + ' - ' + deck.scope }}
                    </option>
                </select>
            </div>
            <div v-if="Object.keys(game.filteredCards('.scope_id')).length"
                 class="aside-content">
                <select v-model="game.selectedId" @change="game.selectCard($event)">
                    <option :value="null" disabled>{{ __('Scope') }}</option>
                    <option v-for="card in game.filteredCards('.scope_id')"
                            :value="card.id">
                        {{ game.getCardName(card) }}
                    </option>
                </select>
            </div>
        </div>
        <!-- actions -->
        <div v-if="game.isMaster() || game.mainTab === 'MainBoard'"
             class="aside-content aside-actions">
            <button v-if="game.isMaster() && game.mainTab === 'MainBoard'"
                    class="control-btn control-remove" :title="__('Add')">
                <span class="material-icons" @click="game.addCard()">add</span>
            </button>
            <button v-if="game.isMaster() && game.mainTab !== 'MainBoard'"
                    class="control-btn control-marker" :title="__('Add')" >
                <span class="material-icons" @click="game.addMarker()">place</span>
            </button>
            <button v-if="game.activeObject" class="control-btn control-forward" :title="__('Forward')">
                <span class="material-icons" @click="game.forward()">upload</span>
            </button>
            <button v-if="game.activeObject" class="control-btn control-forward" :title="__('Backward')">
                <span class="material-icons" @click="game.backward()">download</span>
            </button>
            <button v-if="game.activeObject && game.mainTab === 'MainBoard' && !game.activeCardTapped"
                    class="control-text" :title="__('Tap')" >
                <span class="material-icons" @click="game.activeCardTap()">swipe_down</span>
            </button>
            <button v-if="game.activeObject && game.mainTab === 'MainBoard' && game.activeCardTapped"
                    class="control-text" :title="__('Untap')">
                <span class="material-icons" @click="game.activeCardUntap()">pinch</span>
            </button>
            <button v-if="game.activeObject && game.isMaster() && game.activeObjectHidden"
                    class="control-btn control-forward" :title="__('Show')">
                <span class="material-icons" @click="game.visibility()">visibility</span>
            </button>
            <button v-if="game.activeObject && game.isMaster() && !game.activeObjectHidden"
                    class="control-btn control-forward" :title="__('Hide')">
                <span class="material-icons" @click="game.visibility(false)">visibility_off</span>
            </button>
            <button v-if="game.activeObject && game.mainTab !== 'MainBoard'"
                    class="control-btn control-center" :title="__('Center')">
                <span class="material-icons" @click="game.moveToCenter()">filter_center_focus</span>
            </button>
            <button v-if="game.activeObject && game.isMaster()"
                    class="control-btn control-remove" :title="__('Remove')">
                <span class="material-icons" @click="game.remove()">delete</span>
            </button>
        </div>
        <div v-if="!game.isMaster() && game.mainTab !== 'MainBoard'"
             class="aside-content aside-actions">
            <button v-if="game.activeObject"
                    class="control-btn control-center" :title="__('Center')">
                <span class="material-icons" @click="game.moveToCenter()">filter_center_focus</span>
            </button>
        </div>
    </div>
</template>
