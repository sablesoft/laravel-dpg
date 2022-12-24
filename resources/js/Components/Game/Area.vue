<script setup>
    import { game } from "@/Components/Game/game";
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
        <div class="aside-content">
            <select v-model="game.selectedId" @change="game.selectScene($event)">
                <option :value="null" disabled>{{ __('Scenes') }}</option>
                <option v-for="scene in game.filteredScenes('area')" :value="scene.id">
                    {{ scene.name }}
                </option>
            </select>
        </div>
        <div class="aside-content">
            <select v-model="game.selectedId" @change="game.selectDeck($event)">
                <option :value="null" disabled>{{ __('Decks') }}</option>
                <option v-for="deck in game.filteredDecks('area')" :value="deck.id">
                    {{ deck.type + ' : ' + deck.target + ' - ' + deck.scope }}
                </option>
            </select>
        </div>
        <div class="aside-content">
            <select v-model="game.selectedId" @change="game.selectCard($event)">
                <option :value="null" disabled>{{ __('Cards') }}</option>
                <option v-for="card in game.filteredCards('area')" :value="card.id">
                    {{ card.name }}
                </option>
            </select>
        </div>
        <div v-if="game.isMaster() && game.mainTab === 'Map'"
             class="aside-content aside-actions">
<!--            <button v-if="!game.activeObject"-->
<!--                    class="control-btn control-remove" :title="__('Add')">-->
<!--                <span class="material-icons" @click="game.addBook()">add</span>-->
<!--            </button>-->
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
<!--            <button v-if="game.activeObject"-->
<!--                    class="control-btn control-remove" :title="__('Remove')">-->
<!--                <span class="material-icons" @click="game.remove()">delete</span>-->
<!--            </button>-->
        </div>
    </div>
</template>
