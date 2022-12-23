<script setup>
    import { game } from "@/Components/Game/game";
</script>
<style scoped>
.book {
    text-align: center;
}
.book-name {
    font-weight: bold;
}
.book-scope {
    height: 20px;
    line-height: 20px;
    margin: 15px;
}
.book-content {
    margin-top: 10px;
}
.book-content select {
    width: 90%;
}
.book-image {
    max-height: 250px;
}
.book-image>img {
    display: block;
    margin-left: auto;
    margin-right: auto;
    border-radius: 0.5rem;
}
.book-desc {
    height: 130px;
    text-align: left;
    margin-left: 20px;
    margin-right: 20px;
    white-space: pre-line;
    overflow: auto;
}
.book-actions {
    background-color: antiquewhite;
    font-weight: bold;
    font-size: 18px;
    padding-top: 5px;
    margin-top: 0;
}
.book-actions>button {
    margin-left: 15px;
}
.control-btn {
    flex-shrink:0;
    width:1.5em;
    height:1.5em;
    font-size:24px;
    display: inline;
    padding:.25em;
    justify-content:center;
    align-items:center;
    border-radius:8px;
    background:rgba(255,255,255,.8);
    transition:.5s all;
}
.control-btn:hover {
    background:rgba(255,255,255,1);
}
.control-btn .material-icons {
    font-size:1em;
    line-height:1em
}
.control-text {
    vertical-align: super;
}
</style>
<template>
    <div class="book shadow-sm sm:rounded-lg">
        <div class="book-content book-name">
            {{ game.activeBook.name }}
        </div>
        <div class="book-content book-image">
            <img :src="game.activeBook.image" alt="">
        </div>
        <div class="book-content book-name book-scope">
            {{ __('Book') }}
        </div>
        <div class="book-content book-desc">
            {{ game.activeBook.desc }}
        </div>
        <div class="book-content">
            <select v-model="game.selectedId" @change="game.selectDome($event)">
                <option :value="null" disabled>{{ __('Select Dome') }}</option>
                <option v-for="dome in game.bookDomes(game.activeBook.id)" :value="dome.id">
                    {{ dome.name }}
                </option>
            </select>
        </div>
        <div class="book-content">
            <select v-model="game.selectedId" @change="game.selectScene($event)">
                <option :value="null" disabled>{{ __('Select Scene') }}</option>
                <option v-for="scene in game.bookScenes(game.activeBook.id)" :value="scene.id">
                    {{ scene.name }}
                </option>
            </select>
        </div>
        <div class="book-content">
            <select v-model="game.selectedId" @change="game.selectDeck($event)">
                <option :value="null" disabled>{{ __('Select Deck') }}</option>
                <option v-for="deck in game.bookDecks(game.activeBook.id)" :value="deck.id">
                    {{ deck.target + ' - ' + deck.scope }}
                </option>
            </select>
        </div>
        <div class="book-content">
            <select v-model="game.selectedId" @change="game.selectCard($event)">
                <option :value="null" disabled>{{ __('Select Card') }}</option>
                <option v-for="card in game.bookCards(game.activeBook.id)" :value="card.id">
                    {{ card.name }}
                </option>
            </select>
        </div>
    </div>
</template>
