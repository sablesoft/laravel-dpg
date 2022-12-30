<script setup>
    import { game } from "@/Components/Game/js/game";
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
    .control-btn .material-icons {
        font-size:1em;
        line-height:1em
    }
    .control-more {
        min-width: 8em;
        height:1.5em;
        font-size:24px;
        border-radius:8px;
        background:rgba(255,255,255,.1);
        transition:.5s all;
        backdrop-filter: brightness(1.2) blur(10px);
    }
    .control-more .control-range {
        min-width: 8em;
    }
    .control-more label {
        display: inline;
    }
    .info-wrap {
        position: absolute;
        bottom: 10px;
        right: 10px;
        font-weight: normal;
    }
    .info-wrap p {
        padding: 5px;
        border-radius: 8px;
        background: rgba(255,255,255,.1);
        transition:.5s all;
        backdrop-filter: brightness(1.2) blur(10px);
    }
</style>
<template>
    <div :style="game.canvasWrapperStyle()">
        <canvas :width="game.width" :height="game.height"></canvas>
    </div>
    <div class="control-wrap">
        <!-- Transform Mode -->
        <button class="control-btn control-position"
                :class="{'control-active' : game.modeTransform}"
                :title="__('Transform Mode')">
            <span class="material-icons" @click="game.switchTransform()">open_with</span>
        </button>

        <!-- Erase Mode -->
        <button v-if="game.isMaster() && game.mainTab !== 'MainBoard'"  class="control-btn control-erase"
                :class="{'control-active' : game.modeErase}"
                :title="__('Erase Mode')">
            <span class="material-icons" @click="game.switchErase()">visibility</span>
        </button>
        <button v-if="game.isMaster() && game.mainTab !== 'MainBoard'"  class="control-btn control-erase-undo"
                :class="{'control-active' : game.modeEraseUndo}"
                :title="__('Erase Undo Mode')">
            <span class="material-icons" @click="game.switchEraseUndo()">visibility_off</span>
        </button>
        <div class="control-more" v-if="game.modeErase || game.modeEraseUndo" >
            <label for="brush-width">{{ __('Brush Size')}}</label>
            <input id="brush-width" class="control-btn control-range"
                   type="range" min="1" max="200" step="1"
                   :value="game.brushWidth" @input="event => game.setBrushWidth(event.target.value)">
        </div>
        <button v-if="game.modeEraseUndo || game.modeErase || game.modeTransform"
                class="control-btn control-reset" :title="__('Undo')">
            <span class="material-icons" @click="game.canvasUndo()">undo</span>
        </button>
        <button v-if="game.modeEraseUndo || game.modeErase || game.modeTransform"
                class="control-btn control-reset" :title="__('Redo')">
            <span class="material-icons" @click="game.canvasRedo()">redo</span>
        </button>


    </div>
    <div class="info-wrap">
        <p v-if="game.cursorName">
            <span v-if="game.cursorScope">{{ game.cursorScope }} : </span>{{ game.cursorName }}
        </p>
    </div>
</template>
