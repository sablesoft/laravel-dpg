<!--suppress HtmlUnknownTarget -->
<script setup>
    import { game } from "@/Components/Game/game";
</script>
<style scoped>
    .material-icons {
        /*width: 25px;*/
        /*height: 25px;*/
        position: absolute;
        top: 10px;
        cursor: pointer;
    }
    .control-out {
        left: 10px;
    }
    .control-reset {
        left: 45px;
    }
    .control-in {
        left: 80px;
    }
    .control-left {
        left: 115px;
    }
    .control-right {
        left: 150px;
    }
    .control-top {
        left: 185px;
    }
    .control-down {
        left: 220px;
    }
    .control-save {
        right: 10px;
    }
</style>
<template>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <div :style="game.canvasWrapperStyle()">
        <canvas :width="game.fabricWidth()" :height="game.fabricHeight()"></canvas>
    </div>
    <span class="material-icons control-out" @click="game.scaleOut()">close_fullscreen</span>
    <span class="material-icons control-reset" @click="game.scaleReset()">restore</span>
    <span class="material-icons control-in" @click="game.scaleIn()">open_in_full</span>
    <span class="material-icons control-left" @click="game.moveLeft()">arrow_back</span>
    <span class="material-icons control-right" @click="game.moveRight()">arrow_forward</span>
    <span class="material-icons control-top" @click="game.moveTop()">arrow_upward</span>
    <span class="material-icons control-down" @click="game.moveBottom()">arrow_downward</span>
    <span class="material-icons control-save" @click="game.saveCanvas()">save</span>
</template>
