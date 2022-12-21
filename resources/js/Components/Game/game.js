import {shallowReactive, toRaw} from 'vue';
import {fabric} from "fabric-with-erasing";
import './fabric.card';
import './fabric.area';

/**
 * @typedef {Object} CanvasConfig
 * @property {number} scale
 * @property {Object} style
 */

/**
 * @typedef {Object} GameOptions
 * @property {number} width
 * @property {number} height
 * @property {string} role
 */

/**
 * @typedef {Object} ActiveCard
 * @property {?number} id
 * @property {?string} name
 * @property {?string} scopeName
 * @property {?string} desc
 * @property {?string} image
 * @property {?string} scopeImage
 * @property {boolean} tapped
 */

/**
 * @typedef {Object} GameCard
 * @property {number} id
 * @property {number} scope_id
 * @property {string} name
 * @property {?string} desc
 * @property {?string} info
 * @property {?string} code
 * @property {string} currentName
 * @property {?string} currentDesc
 * @property {?CanvasConfig} canvas
 * @property {?string} image
 * @property {?string} scopeImage
 * @property {?string} scopeName
 * @property {?fabric.Card} fabricObject
 */

/**
 * @typedef {Object} Deck
 * @property {number} id
 * @property {number} scope_id
 * @property {number} target_id
 * @property {?string} desc
 * @property {number} type
 * @property {?CanvasConfig} canvas
 * @property {?string} image
 * @property {Object.<number, number>} cards
 */

/**
 * @typedef {Object} Book
 * @property {number} id
 * @property {string} name
 * @property {?string} desc
 * @property {?CanvasConfig} canvas
 * @property {?string} image
 * @property {number[]} dome_ids
 * @property {number[]} scene_ids
 * @property {number[]} card_ids
 * @property {number[]} deck_ids
 * @property {number[]} source_ids
 */

/**
 * @typedef {Object} FabricCanvasProps
 * @property {?number} fullWidth
 * @property {?number} fullHeight
 * @property {?number} scaleRatio
 */

/**
 * @typedef {fabric.Canvas & FabricCanvasProps} FabricCanvas
 */

/**
 * @typedef {Object} Dome
 * @property {number} id
 * @property {number} scope_id
 * @property {string} name
 * @property {?string} desc
 * @property {?string} image
 * @property {?CanvasConfig} canvas
 * @property {number} area_height
 * @property {number} area_width
 * @property {?number[]} area_mask
 * @property {number} top_step
 * @property {number} left_step
 * @property {number|string} map_width
 * @property {number|string} map_height
 * @property {number[]} land_ids
 * @property {number[]} area_ids
 * @property {number[]} card_ids
 * @property {number[]} deck_ids
 * @property {number[]} source_ids
 */

/**
 * @typedef {Object} Land
 * @property {number} id
 * @property {number} scope_id
 * @property {string} name
 * @property {?string} desc
 * @property {?CanvasConfig} canvas
 * @property {?string} image
 * @property {number} dome_id
 * @property {number[]} area_ids
 * @property {number[]} card_ids
 * @property {number[]} deck_ids
 * @property {number[]} source_ids
 */

/**
 * @typedef {Object} GameArea
 * @property {number} id
 * @property {number} scope_id
 * @property {string} name
 * @property {?string} desc
 * @property {?CanvasConfig} canvas
 * @property {?string} image
 * @property {number} dome_id
 * @property {number} top
 * @property {number} top_step
 * @property {number} left
 * @property {number} left_step
 * @property {number[]} card_ids
 * @property {number[]} deck_ids
 * @property {number[]} source_ids
 * @property {?fabric.Card} fabricObject
 */

/**
 * @typedef {Object} Scene
 * @property {number} id
 * @property {number} scope_id
 * @property {string} name
 * @property {?string} desc
 * @property {?CanvasConfig} canvas
 * @property {?string} image
 * @property {number[]} card_ids
 * @property {number[]} deck_ids
 * @property {number[]} source_ids
 */

export const game = shallowReactive({
    /**
     * @member {?number} - game id
     */
    id: null,
    /**
     * @member {?ActiveCard} - game info
     */
    info: null,
    /**
     * @member {?string} - user role code
     */
    role: null,
    /**
     * State of card component
     * @member {ActiveCard}
     */
    activeCard: {
        id: null,
        name: null,
        desc: null,
        image: null,
        scopeImage: null,
        scopeName: null,
        tapped: false
    },
    /**
     * @member {?string} - board image
     */
    boardImage: null,
    /**
     * @member {?string} - cards back image
     */
    cardsBack: null,
    /**
     * @member {?number} - main quest id
     */
    questId: null,
    /**
     * @member {?number[]} - game hero ids
     */
    heroIds: null,
    /**
     * @member {?number[]} - game custom card ids
     */
    cardIds: null,
    /**
     * @member {?number[]} - game custom deck ids
     */
    deckIds: null,
    /**
     * @member {?number} - active dome id
     */
    activeDomeId: null,
    /**
     * @member {?number} - active area id
     */
    activeAreaId: null,
    /**
     * @member {?number} - active scene id
     */
    activeSceneId: null,
    /**
     * @member {?number[]} - open dome ids
     */
    openDomeIds: null,
    /**
     * @member {?number[]} - open land ids
     */
    openLandIds: null,
    /**
     * @member {?number[]} - open area ids
     */
    openAreaIds: null,
    /**
     * @member {?number[]} - open scene ids
     */
    openSceneIds: null,
    /**
     * @member {?number[]} - open deck ids
     */
    openDeckIds: null,
    /**
     * @member {?number[]} - open card ids
     */
    openCardIds: null,
    /**
     * @member {Object.<number, Book>}
     */
    books: null,
    /**
     * @member {Object.<number, GameCard>}
     */
    cards: null,
    /**
     * @member {Object.<number, Deck>}
     */
    decks: null,
    /**
     * @member {Object.<number, Dome>}
     */
    domes: null,
    /**
     * @member {Object.<number, Land>}
     */
    lands: null,
    /**
     * @member {Object.<number, GameArea>}
     */
    areas: null,
    /**
     * @member {Object.<number, Scene>}
     */
    scenes: null,
    /**
     * @member {?FabricCanvas}
     */
    fabricBoard: null,
    /**
     * @member {?FabricCanvas}
     */
    fabricMap: null,
    /**
     * @member {?FabricCanvas}
     */
    fabricScene: null,
    fabricConfig: null,
    /**
     * @member {string}
     */
    mainTab: 'Board',
    /**
     * @member {string}
     */
    asideTab: 'Card',
    /**
     * Screen width
     * @member {?number}
     */
    width: null,
    /**
     * Screen height
     * @member {?number}
     */
    height: null,
    minLeft: null,
    maxLeft: null,
    minTop: null,
    maxTop: null,
    top: null,
    left: null,
    /**
     * @member {?CanvasConfig}
     */
    canvas: null,

    // canvas control modes:
    modeErase: false,
    modeEraseUndo: false,
    modeMove: false,
    modeScale: false,
    modeSave: false,
    fogColor: '#ffffff',
    brushWidth: 50,
    scaleRatio: 1,
    minRatio: 1,
    maxRatio: 1,
    /**
     * @param {Object.<string, any>} data
     * @param {GameOptions} options
     */
    init(data, options) {
        for (const [key, value] of Object.entries(data)) {
            this[key] = toRaw(value);
        }
        this.activeCard = this.info;
        this.activeCard.id = null;
        this.activeCard.tapped = false;
        this.width = options.width;
        this.height = options.height;
        this.role = options.role;
    },
    isMaster() {
        return this.role === 'master';
    },
    /**
     * @param {?number} id
     * @return {void}
     */
    setActiveCard(id = null) {
        if (!id) {
            this.activeCard = this.info;
            return true;
        }
        if (!this.cards[id]) {
            throw new Error('Card not found: ' + id);
        }
        this.activeCard = this.cards[id];
        console.debug('Active card: ', this.activeCard);
    },
    activeCardTap() {
        this.activeCard.tapped = this.cardTap(this.activeCard.id);
    },
    activeCardUntap() {
        this.activeCard.tapped = !this.cardUntap(this.activeCard.id);
    },
    activeCardForward() {
        return this.cardForward(this.activeCard.id);
    },
    activeCardBackward() {
        return this.cardBackward(this.activeCard.id);
    },
    /**
     * @param {number} id
     * @return {boolean}
     */
    cardTap(id) {
        console.debug('Tap card: ' + id);
        return this._cardObject(id).tap();
    },
    /**
     * @param {number} id
     * @return {boolean}
     */
    cardUntap(id) {
        console.debug('Untap card: ' + id);
        return this._cardObject(id).untap();
    },
    /**
     * @param {number} id
     * @return {void}
     */
    cardForward(id) {
        let co = this._cardObject(id);
        console.debug('Forward card: ' + id);
        co.bringForward(true);
        co.canvas.requestRenderAll();
    },
    /**
     * @param {number} id
     * @return {void}
     */
    cardBackward(id) {
        let co = this._cardObject(id);
        console.debug('Backward card: ' + id);
        co.sendBackwards(true);
        co.canvas.requestRenderAll();
    },
    /**
     * @param {number} id
     * @param {Object.<string, any>} options
     * @param {?boolean} add
     * @return {fabric.Card}
     */
    createCardFabric(id, options, add = true) {
        if (!this.cards[id]) {
            throw new Error('Card not found: ' + id);
        }
        options || (options = {});
        options.back_image = toRaw(this.cardsBack);
        let o = new fabric.Card(toRaw(this.cards[id]), options);
        if (add) {
            this.fb().add(o);
            this.fb().requestRenderAll();
        }

        return this.cards[id].fabricObject = o;
    },
    /**
     * @param {number} id
     * @param {?Object.<string, any>} options
     * @param {?boolean} add
     * @return {fabric.Area}
     */
    createAreaFabric(id, options = null, add = true) {
        /**
         * @type {GameArea}
         */
        let area = toRaw(this.areas[id]);
        if (!area) {
            throw new Error('Area not found: ' + id);
        }
        options || (options = {});
        let dome = toRaw(this.domes[area.dome_id]);
        if (!dome) {
            throw new Error('Dome for area not found: ' + id);
        }
        options.width = dome.area_width;
        options.height = dome.area_height;
        options.mask = Array.from(dome.area_mask);
        let o = new fabric.Area(area, options);
        if (add) {
            this.fb().add(o);
            this.fb().requestRenderAll();
        }

        return this.areas[id].fabricObject = o;
    },
    showBoard() {
        if (this.mainTab === 'Board') {
            return;
        }
        if (this.modeErase) {
            this.eraseMode();
        }
        if (this.modeEraseUndo) {
            this.eraseUndoMode();
        }
        if (this.modeMove) {
            this.moveMode();
        }
        if (this.modeScale) {
            this.scaleMode();
        }
        this.saveCanvas();
        this.mainTab = 'Board';
        this.setActiveCard();
    },
    showMap() {
        if (this.mainTab === 'Map') {
            return;
        }
        if (this.modeErase) {
            this.eraseMode();
        }
        if (this.modeEraseUndo) {
            this.eraseUndoMode();
        }
        if (this.modeMove) {
            this.moveMode();
        }
        if (this.modeScale) {
            this.scaleMode();
        }
        this.saveCanvas();
        this.mainTab = 'Map';
        let dome = this.domes[this.activeDomeId];
        if (!dome) {
            throw new Error('Active scene not found!');
        }
        this.setActiveCard(dome.scope_id);
    },
    showScene() {
        if (this.mainTab === 'Scene') {
            return;
        }
        if (this.modeErase) {
            this.eraseMode();
        }
        if (this.modeEraseUndo) {
            this.eraseUndoMode();
        }
        if (this.modeMove) {
            this.moveMode();
        }
        if (this.modeScale) {
            this.scaleMode();
        }
        this.saveCanvas();
        this.mainTab = 'Scene';
        let scene = this.scenes[this.activeSceneId];
        if (!scene) {
            throw new Error('Active scene not found!');
        }
        this.setActiveCard(scene.scope_id);
    },
    /**
     * @returns {?Dome}
     */
    activeDome() {
        return this.domes[this.activeDomeId] || null;
    },
    /**
     * @returns {?GameArea}
     */
    activeArea() {
        return this.areas[this.activeAreaId] || null;
    },
    /**
     * @return {?Scene}
     */
    activeScene() {
        return this.scenes[this.activeSceneId] || null;
    },
    scaleMode() {
        if (this.modeErase) {
            this.eraseMode();
        }
        if (this.modeEraseUndo) {
            this.eraseUndoMode();
        }
        if (this.modeMove) {
            this.moveMode();
        }
        if (!this.modeScale) {
            this.scaleRatio = this.getScale();
            let fullWidth = this.fb().fullWidth;
            let fullHeight = this.fb().fullHeight;
            this.minRatio = this.width / fullWidth > this.height / fullHeight ?
                this.width / fullWidth : this.height / fullHeight;
            this.maxRatio = 1.5;
        } else {
            this.scaleRatio = 1;
            this.minRatio = 1;
            this.maxRatio = 1;
        }
        this.modeScale = !this.modeScale;
    },
    moveMode() {
        if (this.modeErase) {
            this.eraseMode();
        }
        if (this.modeEraseUndo) {
            this.eraseUndoMode();
        }
        if (this.modeScale) {
            this.scaleMode();
        }
        if (this.modeMove) {
            this.minTop = null;
            this.maxTop = null;
            this.minLeft = null;
            this.maxLeft = null;
            this.top = null;
            this.left = null;
        } else {
            this.minTop = -this.fb().fullHeight * this.getScale() + this.height;
            // console.log('minTop: -' + this.fb().fullHeight + ' * '
            //     + this.getScale() + ' + ' + this.height + ' = ', this.minTop);
            this.maxTop = 0;
            this.minLeft = -this.fb().fullWidth * this.getScale() + this.width;
            // console.log('minLeft: -' + this.fb().fullWidth + ' * '
            //     + this.getScale() + ' + ' + this.width + ' = ', this.minLeft);
            this.maxLeft = 0;
            this.left = Number(this.getCanvasStyle('left').slice(0, -2));
            this.top = Number(this.getCanvasStyle('top').slice(0, -2));
        }
        this.modeMove = !this.modeMove;
    },
    eraseMode() {
        if (this.modeMove) {
            this.moveMode();
        }
        if (this.modeScale) {
            this.scaleMode();
        }
        if (this.modeEraseUndo) {
            this.eraseUndoMode();
        }
        this.modeErase = !this.modeErase;
        let canvas = this.fb();
        if (this.modeErase) {
            canvas.freeDrawingBrush = new fabric.EraserBrush(canvas);
            this.setBrushWidth();
            canvas.isDrawingMode = true;
        } else {
            canvas.isDrawingMode = false;
        }
    },
    eraseUndoMode() {
        if (this.modeMove) {
            this.moveMode();
        }
        if (this.modeScale) {
            this.scaleMode();
        }
        if (this.modeErase) {
            this.eraseMode();
        }
        this.modeEraseUndo = !this.modeEraseUndo;
        let canvas = this.fb();
        if (this.modeEraseUndo) {
            canvas.freeDrawingBrush = new fabric.EraserBrush(canvas);
            this.setBrushWidth();
            canvas.freeDrawingBrush.inverted = true;
            canvas.isDrawingMode = true;
            this.setFogOpacity(1);
        } else {
            canvas.isDrawingMode = false;
            this.setFogOpacity(0.5);
        }
    },
    saveCanvas() {
        this.modeSave = true;
        let canvas = this._canvases()[0];
        let style = {
            left: canvas.style.left,
            top: canvas.style.top
        }
        let data = {
            gameId : this.id,
            fields: ['canvas'],
            canvas : {
                style: style,
                scale: this.getScale(),
                json: this.fb().toObject()
            },
        }
        switch(this.mainTab) {
            case 'Map':
                data['process'] = 'dome';
                data['processId'] = this.activeDomeId;
                this.domes[this.activeDomeId].canvas = data['canvas'];
                break;
            case 'Scene':
                data['process'] = 'scene';
                data['processId'] = this.activeSceneId;
                this.scenes[this.activeSceneId].canvas = data['canvas'];
                break;
            case 'Board':
                data['process'] = 'game';
                this.canvas = data['canvas'];
                break;
            default:
                throw new Error('Invalid main tab');
        }
        if (this.isMaster()) {
            let self = this;
            axios.patch('/game', data)
                .then(res => {
                    self.modeSave = false;
                }).catch(err => {
                    self.modeSave = false;
                    console.error(err);
                });
        } else {
            this.modeSave = false;
        }
    },
    /**
     * @returns {?number}
     */
    fabricWidth() {
        let fabric = this.fb();
        if (!fabric || !fabric.fullWidth) {
            return this.width;
        }
        return fabric.fullWidth;
    },
    /**
     * @returns {?number}
     */
    fabricHeight() {
        let fabric = this.fb();
        if (!fabric || !fabric.fullHeight) {
            return this.height;
        }
        return fabric.fullHeight;
    },
    /**
     * @returns {{overflow: string, width: string, height: string}}
     */
    canvasWrapperStyle() {
        return {
            height: game.height + 'px',
            width: game.width + 'px',
            overflow: 'hidden !important'
        }
    },
    /**
     * @param {?Object.<string, any>} options
     * @param {?Object.<string, any>} config
     * @return {FabricCanvas}
     */
    initFabric(options = null, config = null) {
        let canvas = document.getElementsByTagName('canvas')[0];
        let fc = new fabric.Canvas(canvas);
        config = config ? config : {};
        if (config.json) {
            fc.loadFromJSON(config.json, fc.renderAll.bind(fc));
        }
        if (!options) {
            options = config.options || {};
        }
        options['preserveObjectStacking'] = true;
        for (const [key, value] of Object.entries(options)) {
            fc[key] = value;
        }
        config.options = options;
        this.fabricConfig = config;
        let name = 'fabric' + this.mainTab;
        return this[name] = fc;
    },
    /**
     * @returns {?FabricCanvas}
     */
    fb() {
        let fabricName = 'fabric' + this.mainTab;
        return this[fabricName] || null;
    },
    renderAll() {
        if (!this.fb()) {
            throw new Error('Fabric canvas is not initiated!')
        }
        return this.fb().renderAll();
    },
    requestRenderAll() {
        if (!this.fb()) {
            throw new Error('Fabric canvas is not initiated!')
        }
        return this.fb().requestRenderAll();
    },
    resetCanvas() {
        // todo
        this.scale(1, true);
    },
    getScale() {
        if (!this.fb()) {
            return 1;
        }
        return this.fb().scaleRatio ?
            this.fb().scaleRatio : 1;
    },
    /**
     * @param {?number} ratio
     * @param {?boolean} aroundCenter
     */
    scale(ratio = null, aroundCenter = false) {
        ratio = ratio ? ratio : 1;
        let fb = this.fb();
        fb.setDimensions({
            width: fb.fullWidth * ratio,
            height: fb.fullHeight * ratio
        });
        if (aroundCenter) {
            fb.zoomToPoint(this._viewCenter(), ratio);
        } else {
            fb.setZoom(ratio);
        }
        fb.scaleRatio = ratio;
        this.scaleRatio = ratio;
    },
    freezeFog() {
        this.fb().getObjects().forEach(function(o) {
            if (o.type === 'rect') {
                o.set('hasControls', false);
                o.set('hasBorders', false);
                o.set('lockMovementX', true);
                o.set('lockMovementY', true);
                o.set('lockScalingX', true);
                o.set('lockScalingY', true);
                o.set('lockRotation', true);
                o.set('selectable', false);
                o.set('hoverCursor', 'default');
                o.bringForward();
                console.debug('Fog freeze!');
            }
        });
    },
    addFog(width, height) {
        let self = this;
        setTimeout(function() {
            console.debug('Add fog');
            let fog = new fabric.Rect({
                originX: 'left',
                originY: 'top',
                fill: 'white',
                width: width,
                height: height,
                stroke: null,
                evented: false,
                opacity: self.isMaster() ? 0.5 : 1,
            });
            self.fb().add(fog);
            self.freezeFog();
        }, 1000);
    },
    setFogOpacity(value) {
        this.fb().getObjects().forEach(function(o) {
            if (o.type === 'rect') {
                o.set('opacity', value);
            }
        });
    },
    setCanvasConfig() {
        if (!this.fabricConfig) {
            return;
        }
        let self = this;
        setTimeout(function () {
            self.setCanvasStyle(self.fabricConfig.style);
            self.scale(self.fabricConfig.scale);
        }, 300);
    },
    /**
     * @param {string} name
     */
    getCanvasStyle(name) {
        return this._canvases()[0].style[name];
    },
    /**
     * @param {Object.<string, string>} style
     */
    setCanvasStyle(style) {
        if (!style) {
            return;
        }
        for (const [key, value] of Object.entries(style)) {
            for (const canvas of this._canvases()) {
                canvas.style[key] = value;
            }
        }
    },
    /**
     * @param {number} value
     */
    setCanvasLeft(value) {
        this.left = value;
        this.setCanvasStyle({left : value + 'px'});
    },
    /**
     * @param {number} value
     */
    setCanvasTop(value) {
        this.top = value;
        this.setCanvasStyle({top : value + 'px'});
    },
    /**
     * @param {?number} width
     */
    setBrushWidth(width = null) {
        this.brushWidth = width ? width : this.brushWidth;
        if (!this.fb().freeDrawingBrush) {
            throw new Error('Drawing brush did not initiated!');
        }
        this.fb().freeDrawingBrush.width = this.brushWidth;
        this.requestRenderAll();
    },
    /**
     * @return {HTMLCollectionOf<HTMLCanvasElement>}
     * @private
     */
    _canvases() {
        return document.getElementsByTagName('canvas');
    },
    /**
     * @param {number} id
     * @return {?fabric.Card}
     */
    _cardObject(id) {
        if (!this.cards[id]) {
            throw new Error('Card not found: ' + id);
        }
        if (!this.cards[id].fabricObject) {
            throw new Error('Fabric object for card not found: ' + id);
        }

        return this.cards[id].fabricObject;
    },
    /**
     * @return {fabric.Point}
     * @private
     */
    _viewCenter() {
        let x = parseInt(this.width / 2 - Number(this.getCanvasStyle('left').slice(0, -2)));
        let y = parseInt(this.height / 2 - Number(this.getCanvasStyle('top').slice(0, -2)));
        return new fabric.Point(x, y);
    }
});
