<script setup>
    import { game } from "@/Components/Game/game";
</script>
<template>
    <button @click="game.zoomIn()">In</button>
    <button @click="game.zoomReset()">Reset</button>
    <button @click="game.zoomOut()">Out</button>
    <button @click="game.moveLeft()">Left</button>
    <button @click="game.moveRight()">Right</button>
    <button @click="game.moveTop()">Top</button>
    <button @click="game.moveBottom()">Bottom</button>
    <div :style="game.canvasWrapperStyle()">
        <canvas :width="game.fabricWidth()" :height="game.fabricHeight()"></canvas>
    </div>
</template>
