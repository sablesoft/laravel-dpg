<script setup>
    import { game } from "@/Components/Game/game";
</script>
<style scoped>
    .control-wrap {
        position: absolute;
        top:16px;
        left:16px;
        display:flex;
        gap:4px
    }
    .control-btn {
        flex-shrink:0;
        width:1.5em;
        height:1.5em;
        font-size:24px;
        padding:.25em;
        display:flex;
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
</style>
<template>
    <div :style="game.canvasWrapperStyle()">
        <canvas :width="game.fabricWidth()" :height="game.fabricHeight()"></canvas>
    </div>
    <div class="control-wrap">
        <button class="control-btn control-out">
            <span class="material-icons" @click="game.scaleOut()">close_fullscreen</span>
        </button>
        <button class="control-btn control-reset">
            <span class="material-icons" @click="game.scaleReset()">restore</span>
        </button>
        <button class="control-btn control-in">
            <span class="material-icons" @click="game.scaleIn()">open_in_full</span>
        </button>
        <button class="control-btn control-left">
            <span class="material-icons" @click="game.moveLeft()">arrow_back</span>
        </button>
        <button class="control-btn control-right">
            <span class="material-icons" @click="game.moveRight()">arrow_forward</span>
        </button>
        <button class="control-btn control-top">
            <span class="material-icons" @click="game.moveTop()">arrow_upward</span>
        </button>
        <button class="control-btn control-down">
            <span class="material-icons" @click="game.moveBottom()">arrow_downward</span>
        </button>
        <button v-if="game.isMaster()" class="control-btn control-save">
            <span class="material-icons" @click="game.saveCanvas()">save</span>
        </button>
    </div>
</template>
