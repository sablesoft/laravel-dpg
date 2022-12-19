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
        background:rgba(255,255,255,.1);
        transition:.5s all;
        backdrop-filter: brightness(1.2) blur(10px);
    }
    .control-btn:hover {
        background:rgba(255,255,255,1);
    }
    .control-active {
        border: 3px solid #ff00ea;
    }
    .control-btn .material-icons {
        font-size:1em;
        line-height:1em
    }
    .control-range {
        height:1.5em;
        font-size:24px;
        border-radius:8px;
        background:rgba(255,255,255,.1);
        transition:.5s all;
        backdrop-filter: brightness(1.2) blur(10px);
    }
    .control-range input {
        min-width: 8em;
    }
</style>
<template>
    <div :style="game.canvasWrapperStyle()">
        <canvas :width="game.fabricWidth()" :height="game.fabricHeight()"></canvas>
    </div>
    <div class="control-wrap">
        <button class="control-btn control-out" :title="__('Scale Out')">
            <span class="material-icons" @click="game.scaleOut()">close_fullscreen</span>
        </button>
        <button class="control-btn control-reset" :title="__('Reset')">
            <span class="material-icons" @click="game.scaleReset()">restore</span>
        </button>
        <button class="control-btn control-in" :title="__('Scale In')">
            <span class="material-icons" @click="game.scaleIn()">open_in_full</span>
        </button>

        <!-- Move Mode -->
        <button class="control-btn control-position"
                :class="{'control-active' : game.modeMove}"
                :title="__('Move Mode')">
            <span class="material-icons" @click="game.moveMode()">open_with</span>
        </button>
        <div class="control-range" v-if="game.modeMove" >
            <label for="move-top">{{ __('Top') }}</label>
            <input id="move-top" class="control-btn"
                   type="range" :min="game.minTop" :max="game.maxTop" step="1"
                   :value="game.top" @input="event => game.setCanvasTop(event.target.value)">
        </div>
        <div class="control-range" v-if="game.modeMove" >
            <label for="move-left">{{ __('Left') }}</label>
            <input id="move-left" class="control-btn" style="width: 5em;"
                   type="range" :min="game.minLeft" :max="game.maxLeft" step="1"
                   :value="game.left" @input="event => game.setCanvasLeft(event.target.value)">
        </div>

        <!-- Erase Mode -->
        <button v-if="game.isMaster()"  class="control-btn control-erase"
                :class="{'control-active' : game.modeErase}"
                :title="__('Erase Mode')">
            <span class="material-icons" @click="game.eraseMode()">visibility</span>
        </button>
        <button v-if="game.isMaster()"  class="control-btn control-erase-undo"
                :class="{'control-active' : game.modeEraseUndo}"
                :title="__('Erase Undo Mode')">
            <span class="material-icons" @click="game.eraseUndoMode()">visibility_off</span>
        </button>
        <div class="control-range" v-if="game.modeErase || game.modeEraseUndo" >
            <label for="brush-width">{{ __('Brush Width') }}</label>
            <input id="brush-width" class="control-btn"
                   type="range" min="1" max="200" step="1"
                   :value="game.brushWidth" @input="event => game.setBrushWidth(event.target.value)">
        </div>

        <button v-if="game.isMaster() && !game.modeEraseUndo && !game.modeErase && !game.modeMove"
                class="control-btn control-save" :title="__('Save')">
            <span class="material-icons" @click="game.saveCanvas()">save</span>
        </button>
    </div>
</template>
