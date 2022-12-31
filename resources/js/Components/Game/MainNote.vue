<script setup>
    import { game } from "@/Components/Game/js/game";
    import {shallowRef} from "vue";
    const nameLength = shallowRef(36);
</script>
<style scoped>
    .note {
        height: inherit;
    }
    .note-content {
        margin: 20px;
        width: 90%;
    }
    .note-name {
        text-align: center;
        font-weight: bold;
    }
    .note-desc {
        height: 200px;
        text-align: left;
        white-space: pre-line;
        overflow: scroll;
    }
    input, textarea {
        width: 100%;
        padding: 10px;
        border: 1px solid black;
    }
    textarea {
        height: 200px;
    }
</style>
<template>
    <div class="note">
        <!-- name -->
        <div class="note-content note-name">
            {{ game.activeNote.name }}
        </div>
        <div class="note-content note-edit">
            <input v-model="game.activeNote.name" :maxlength="nameLength">
        </div>
        <!-- desc -->
        <div v-if="game.activeNote.desc" class="note-content note-desc">
            {{ game.activeNote.desc }}
        </div>
        <div class="note-content note-edit">
            <textarea v-model="game.activeNote.desc"></textarea>
        </div>
        <!-- actions -->
        <div class="note-content note-actions">
            <button class="control-btn control-update" :title="__('Update')">
                <span class="material-icons" @click="game.updateNote()">save</span>
            </button>
        </div>
    </div>
</template>
