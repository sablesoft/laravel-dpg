<script setup>
    import { game } from "@/Components/Game/js/game";
</script>
<style scoped>
    .aside-edit input, .aside-edit textarea {
        width: 90%;
        border: 1px solid black;
    }
</style>
<template>
    <div class="aside shadow-sm sm:rounded-lg">
        <!-- name -->
        <div class="aside-content aside-name">
            {{ game.activeInfo.name }}
        </div>
        <div class="aside-content aside-edit">
            <input v-model="game.activeInfo.currentName">
        </div>
        <!-- image -->
        <div class="aside-content aside-image">
            <img :src="game.activeInfo.image" alt="">
        </div>
        <!-- desc -->
        <div v-if="game.activeInfo.desc" class="aside-content aside-desc">
            {{ game.activeInfo.desc }}
        </div>
        <div class="aside-content aside-edit">
            <textarea v-model="game.activeInfo.currentDesc"></textarea>
        </div>
        <!-- actions -->
        <div class="aside-content aside-actions">
            <button class="control-btn control-update" :title="__('Update')">
                <span class="material-icons" @click="game.updateCurrent()">save</span>
            </button>
        </div>
    </div>
</template>
