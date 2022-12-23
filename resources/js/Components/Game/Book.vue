<script setup>
    import { game } from "@/Components/Game/game";
</script>
<style scoped>
.aside-desc {
    height: 130px;
}
</style>
<template>
    <div class="aside shadow-sm sm:rounded-lg">
        <div class="aside-content aside-name">
            {{ game.activeBook.name }}
        </div>
        <div class="aside-content aside-image">
            <img :src="game.activeBook.image" alt="">
        </div>
        <div class="aside-content aside-name">
            {{ __('Book') }}
        </div>
        <div class="aside-content aside-desc">
            {{ game.activeBook.desc }}
        </div>
        <div class="aside-content">
            <select v-model="game.selectedId" @change="game.selectDome($event)">
                <option :value="null" disabled>{{ __('Domes') }}</option>
                <option v-for="dome in game.bookDomes(game.activeBook.id)" :value="dome.id">
                    {{ dome.name }}
                </option>
            </select>
        </div>
        <div class="aside-content">
            <select v-model="game.selectedId" @change="game.selectScene($event)">
                <option :value="null" disabled>{{ __('Scenes') }}</option>
                <option v-for="scene in game.bookScenes(game.activeBook.id)" :value="scene.id">
                    {{ scene.name }}
                </option>
            </select>
        </div>
        <div class="aside-content">
            <select v-model="game.selectedId" @change="game.selectDeck($event)">
                <option :value="null" disabled>{{ __('Decks') }}</option>
                <option v-for="deck in game.bookDecks(game.activeBook.id)" :value="deck.id">
                    {{ deck.target + ' - ' + deck.scope }}
                </option>
            </select>
        </div>
        <div class="aside-content">
            <select v-model="game.selectedId" @change="game.selectCard($event)">
                <option :value="null" disabled>{{ __('Cards') }}</option>
                <option v-for="card in game.bookCards(game.activeBook.id)" :value="card.id">
                    {{ card.name }}
                </option>
            </select>
        </div>
    </div>
</template>
