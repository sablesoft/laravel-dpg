<script setup>
import { game } from "@/Components/Game/js/game";
import { shallowRef } from "vue";

const activeIndex = shallowRef(null);

let isActive = function(index) {
    return activeIndex.value === index;
}
let activate = function(note, index) {
    if (isActive(index)) {
        activeIndex.value = null;
        game.showInfo();
    } else {
        activeIndex.value = index;
        game.showAside(note.targetId, note.type);
    }
}
</script>
<style scoped>
    .notes {
        overflow: scroll;
        height: inherit;
    }
    .header {
        margin: 10px 10px 20px;
    }
    .header>.title {
        border: 3px solid black;
        border-radius: 10px;
        padding: 10px;
        font-weight: bold;
        text-align: center;
    }
    ol>li {
        border: 3px solid black;
        border-radius: 10px;
        margin: 10px;
        cursor: pointer;
    }
    ol>li>p {
        display: flex;
    }
    ol>li>p.note-desc {
        padding: 10px;
        border-top: 1px solid black;
        max-height: 250px;
        overflow: scroll;
    }
    ol>li.control-active>p.note-desc {
        border-top: 1px solid #ff00ea;
    }
    ol>li>p>span {
        padding: 10px;
        text-align: center;
        border-right: 1px solid black;
    }
    ol>li.control-active>p>span {
        border-right: 1px solid #ff00ea;
    }
    ol>li>p>span.note-actions {
        padding: 0;
    }
    .note-number {
        flex: 5%;
    }
    .note-code {
        flex: 12%;
    }
    .note-title {
        flex: 33%;
    }
    .note-author {
        flex: 25%
    }
    .note-datetime {
        flex: 15%
    }
    .note-actions {
        flex: 10%
    }
</style>
<template>
    <div class="header">
        <p class="title">
            {{ __('Journal') }}
        </p>
    </div>
    <div class="notes">
        <ol>
            <li v-for="(note, i) in game.journal"
                :class="{'control-active' : isActive(i)}"
                @click="activate(note, i)">
                <p>
                    <span class="note-number">{{ i + 1 }}</span>
                    <span class="note-code">{{ game.trans(note.code) }}</span>
                    <span class="note-title">{{ game.trans(note.type) }} - {{ note.name }}</span>
                    <span class="note-author">{{ __('Added by') }} : {{ note.authorId }}</span>
                    <span class="note-datetime">{{ __('At') }} - {{ note.timestamp }}</span>
                    <span class="note-actions">
                    <button class="control-btn control-edit" :title="__('Edit')">
                        <span class="material-icons">mode_edit</span>
                    </button>
                    <button class="control-btn control-remove" :title="__('Remove')">
                        <span class="material-icons">delete</span>
                    </button>
                </span>
                </p>
                <p class="note-desc" v-if="isActive(i) && note.desc">{{ note.desc }}</p>
            </li>
        </ol>
    </div>
</template>
