<script setup>
import { game } from "@/Components/Game/js/game";
import { shallowRef } from "vue";

const activeIndex = shallowRef(null);

let isActive = function(index) {
    return activeIndex.value === index;
}
let activate = function(note, index) {
    if (isActive(index)) {
        if (game.mainTab === 'MainPost') {
            return;
        }
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
        border: 3px solid black;
        border-radius: 10px;
    }
    .header>.title {
        padding: 10px;
        font-weight: bold;
        text-align: center;
        border-bottom: 1px solid black;
    }
    .header>.control {
        padding: 10px;
        width: 50%;
        border-top: 1px solid black;
        display: inline-block;
    }
    .header>.control>span {
        font-weight: bold;
    }
    .header>.control>button {
        cursor: pointer;
    }
    .header>.control>span,
    .header>.control>label,
    .header>.control>input,
    .header>.control>button,
    .header>.control>select {
        margin-left: 20px;
    }
    .header>.ordering {
        border-right: 1px solid black;
    }
    .header>.filtering {
        border-left: 1px solid black;
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
        padding: 6px;
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
        flex: 4%;
    }
    .note-code {
        flex: 13%;
    }
    .note-type {
        flex: 13%;
    }
    .note-title {
        flex: 30%;
    }
    .note-author {
        flex: 22%
    }
    .note-datetime {
        flex: 15%
    }
    .note-actions {
        flex: 4%
    }
    .control-btn {
        margin-bottom: 0;
        font-size: 21px;
    }
    .control-btn>.material-icons {
        font-size: 0.8em;
    }
</style>
<template>
    <div class="header">
        <p class="title">
            {{ __('Journal') }}
        </p>
        <div class="control ordering">
            <span>{{ __('Sort')}} </span>
            <select v-model="game.journalSortField">
                <option v-for="field in game.getJournalFields()" :value="field.code">
                    {{ field.name }}
                </option>
            </select>
            <label for="desc">DESC</label>
            <input type="radio" id="desc" value="desc" v-model="game.journalSortDirection">
            <label for="desc">ASC</label>
            <input type="radio" id="asc" value="asc" v-model="game.journalSortDirection">
        </div>
        <div class="control filtering">
            <span>{{ __('Filter')}} </span>
            <select @change="game.updateJournalFilter()"
                    v-model="game.journalFilter['code']">
                <option :value="null">{{ __('All') }}</option>
                <option v-for="value in game.getJournalValues('code')" :value="value">
                    {{ game.trans(value) }}
                </option>
            </select>
            <select @change="game.updateJournalFilter()"
                    v-model="game.journalFilter['type']">
                <option :value="null">{{ __('All') }}</option>
                <option v-for="value in game.getJournalValues('type')" :value="value">
                    {{ game.trans(value) }}
                </option>
            </select>
            <button type="button" @click="game.resetJournalFilter()">{{ __('Reset')}}</button>
        </div>
    </div>
    <div class="notes">
        <ol>
            <li v-for="(note, i) in game.getFilteredJournal()"
                :class="getClass(note, i)"
                @click="activate(note, i)">
                <p>
                    <span class="note-number">{{ i + 1 }}</span>
                    <span class="note-code">{{ game.trans(note.code) }}</span>
                    <span class="note-type">{{ game.trans(note.type) }}</span>
                    <span class="note-title">{{ game._toLocale(note.name) }}</span>
                    <span class="note-author">{{ note.author_id }}</span>
                    <span class="note-datetime">{{ note.created_at ? createdAt(note.created_at) : __('New Note') }}</span>
                    <span class="note-actions">
                        <button v-if="!note.created_at"
                            class="control-btn control-edit"
                                @click="game.editNote(i)"
                                :title="__('Edit')">
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
