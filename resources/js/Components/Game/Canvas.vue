<!--suppress HtmlUnknownTarget -->
<script setup>
    import { game } from "@/Components/Game/game";
</script>
<style scoped>
    img.canvas-control {
        width: 25px;
        height: 25px;
        top: 10px;
        position: absolute;
        cursor: pointer;
    }
    img.control-out {
        left: 10px;
    }
    img.control-reset {
        left: 45px;
    }
    img.control-in {
        left: 80px;
    }
    img.control-left {
        left: 115px;
    }
    img.control-right {
        left: 150px;
    }
    img.control-top {
        left: 185px;
    }
    img.control-down {
        left: 220px;
    }
    img.control-save {
        right: 10px;
    }
</style>
<template>
    <div :style="game.canvasWrapperStyle()">
        <canvas :width="game.fabricWidth()" :height="game.fabricHeight()"></canvas>
    </div>
    <img class="canvas-control control-out" src="/img/control/out.svg" @click="game.scaleOut()" alt="Zoom Out"/>
    <img class="canvas-control control-reset" src="/img/control/reset.png" @click="game.scaleReset()" alt="Reset Scale"/>
    <img class="canvas-control control-in" src="/img/control/in.svg" @click="game.scaleIn()" alt="Zoom In"/>
    <img class="canvas-control control-left" src="/img/control/left.png" @click="game.moveLeft()" alt="Move Left"/>
    <img class="canvas-control control-right" src="/img/control/right.png" @click="game.moveRight()" alt="Move Right"/>
    <img class="canvas-control control-top" src="/img/control/top.png" @click="game.moveTop()" alt="Move Top"/>
    <img class="canvas-control control-down" src="/img/control/down.png" @click="game.moveBottom()" alt="Move Down"/>
    <img class="canvas-control control-save" src="/img/control/save.png" @click="game.saveCanvas()" alt="Save"/>
</template>
