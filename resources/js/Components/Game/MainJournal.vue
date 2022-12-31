<script setup>
import { game } from "@/Components/Game/js/game";
import { shallowRef } from "vue";

const activeIndex = shallowRef(null);

let isActive = function(index) {
    return activeIndex.value === index;
}
let activate = function(note, index) {
    // console.debug('Activate', index, note);
    if (isActive(index)) {
        activeIndex.value = null;
        if (!game.isActiveJournalFilter()) {
            game.showInfo();
        }
    } else {
        activeIndex.value = index;
        game.showAside(note.id, note.type);
    }
}
let getClass = function(note, index) {
    let c = 'note-code-' + note.code;
    if (isActive(index)) {
        c += ' control-active';
    }

    return c;
}
let createdAt = function(string) {
    if (!string) {
        return __('New')
    }
    let date = new Date(string);
    let options = {
        year: '2-digit',
        month: '2-digit',
        day: '2-digit',
        hour: '2-digit',
        minute: '2-digit',
    };

    return date.toLocaleString(game.locale, options);
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
        flex: 36%;
    }
    .note-author {
        flex: 26%
    }
    .note-datetime {
        flex: 17%
    }
    .note-actions {
        flex: 5%
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
            <li v-for="(note, i) in game.getFilteredJournal()"
                :class="getClass(note, i)"
                @click="activate(note, i)">
                <p>
                    <span class="note-number">{{ i + 1 }}</span>
                    <span class="note-code">{{ game.trans(note.code) }}</span>
                    <span class="note-title">{{ game.trans(note.type) }} - {{ game._toLocale(note.name) }}</span>
                    <span class="note-author">{{ __('Added by') }} : {{ note.author_id }}</span>
                    <span class="note-datetime">{{ createdAt(note.created_at) }}</span>
                    <span class="note-actions">
                    <button class="control-btn control-edit" :title="__('Edit')">
                        <span class="material-icons">mode_edit</span>
                    </button>
                </span>
                </p>
                <p class="note-desc" v-if="isActive(i) && game._toLocale(note.desc)">
                    {{ game._toLocale(note.desc) }}
                </p>
            </li>
        </ol>
    </div>
</template>
