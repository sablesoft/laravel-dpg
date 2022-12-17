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
    /**
     * @member {string}
     */
    mainTab: 'Board',
    /**
     * @member {string}
     */
    asideTab: 'Card',
    /**
     * @member {?number}
     */
    width: null,
    /**
     * @member {?number}
     */
    height: null,
    /**
     * @member {?CanvasConfig}
     */
    canvas: null,
    /**
     * @member {number}
     */
    canvasMoveStep: 20,
    /**
     * @member {number}
     */
    canvasScaleStep: 0.1,
    isEraseMode: false,
    isEraseUndoMode: false,
    fogColor: '#ffffff',
    brushWidth: 50,
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
            this.fabric().add(o);
            this.fabric().requestRenderAll();
        }

        return this.cards[id].fabricObject = o;
    },
    /**
     * @param {number} id
     * @param {?Object.<string, any>} options
     * @param {?boolean} add
     * @return {fabric.Area}
     */
    createAreaFabric(id, options, add = true) {
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
        options.fogColor = toRaw(this.fogColor);
        options.fogOpacity = this.isMaster() ? 0.4 : 1;
        // options.fogOpacity = this.isMaster() ? 1 : 1;
        let o = new fabric.Area(area, options);
        if (add) {
            this.fabric().add(o);
            this.fabric().requestRenderAll();
        }

        return this.areas[id].fabricObject = o;
    },
    showBoard() {
        this.saveCanvas();
        this.mainTab = 'Board';
        this.setActiveCard();
    },
    showMap() {
        this.saveCanvas();
        this.mainTab = 'Map';
        let dome = this.domes[this.activeDomeId];
        if (!dome) {
            throw new Error('Active scene not found!');
        }
        this.setActiveCard(dome.scope_id);
    },
    showScene() {
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
    moveLeft() {
        for (const canvas of this._canvases()) {
            this._canvasMoveX(-this.canvasMoveStep, canvas);
        }
    },
    moveRight() {
        for (const canvas of this._canvases()) {
            this._canvasMoveX(this.canvasMoveStep, canvas);
        }
    },
    moveTop() {
        for (const canvas of this._canvases()) {
            this._canvasMoveY(-this.canvasMoveStep, canvas);
        }
    },
    moveBottom() {
        for (const canvas of this._canvases()) {
            this._canvasMoveY(this.canvasMoveStep, canvas);
        }
    },
    eraseMode() {
        this.isEraseMode = !this.isEraseMode;
        let canvas = this.fabric();
        if (this.isEraseMode) {
            this.isEraseUndoMode = false;
            canvas.freeDrawingBrush = new fabric.EraserBrush(canvas);
            canvas.freeDrawingBrush.width = this.brushWidth;
            canvas.isDrawingMode = true;
        } else {
            canvas.isDrawingMode = false;
        }
    },
    eraseUndoMode() {
        this.isEraseUndoMode = !this.isEraseUndoMode;
        let canvas = this.fabric();
        if (this.isEraseUndoMode) {
            this.isEraseMode = false;
            canvas.freeDrawingBrush = new fabric.EraserBrush(canvas);
            canvas.freeDrawingBrush.width = this.brushWidth;
            canvas.freeDrawingBrush.inverted = true;
            canvas.isDrawingMode = true;
        } else {
            canvas.isDrawingMode = false;
        }
    },
    saveCanvas() {
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
                json: this.fabric().toDatalessJSON()
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
            axios.patch('/game', data)
                .then(res => {
                    console.log(res.data);
                }).catch(err => {
                console.error(err);
            });
        }
    },
    /**
     * @returns {?number}
     */
    fabricWidth() {
        let fabric = this.fabric();
        if (!fabric || !fabric.fullWidth) {
            return this.width;
        }
        return fabric.fullWidth;
    },
    /**
     * @returns {?number}
     */
    fabricHeight() {
        let fabric = this.fabric();
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
     * @param {Object.<string, any>} options
     * @param {?Object.<string, any>} json
     * @return {FabricCanvas}
     */
    initFabric(options = {}, json = null) {
        let canvas = document.getElementsByTagName('canvas')[0];
        let fabricCanvas = new fabric.Canvas(canvas);
        if (json) {
            fabricCanvas.loadFromJSON(json, fabricCanvas.renderAll.bind(fabricCanvas));
        }
        for (const [key, value] of Object.entries(options)) {
            fabricCanvas[key] = value;
        }
        let name = 'fabric' + this.mainTab;

        return game[name] = fabricCanvas;
    },
    /**
     * @returns {?FabricCanvas}
     */
    fabric() {
        let fabric = 'fabric' + this.mainTab;
        return this[fabric] || null;
    },
    renderAll() {
        this.fabric().renderAll();
    },
    requestRenderAll() {
        this.fabric().requestRenderAll();
    },
    scaleIn() {
        this.scale(1 + this.canvasScaleStep);
    },
    scaleOut() {
        this.scale(1 - this.canvasScaleStep);
    },
    scaleReset() {
        this.scale();
    },
    getScale() {
        if (!this.fabric()) {
            return 1;
        }
        return this.fabric().scaleRatio ?
            this.fabric().scaleRatio : 1;
    },
    /**
     * @param {?number} multiplier
     */
    scale(multiplier = null) {
        this.fabric().scaleRatio = multiplier ?
            this.getScale() * multiplier : 1;
        this._zoom();
    },
    /**
     * @param {CanvasConfig} config
     */
    setCanvasConfig(config) {
        if (!config) {
            return;
        }
        setTimeout(function() {
            game.setCanvasStyle(config.style);
            game.setScale(config.scale);
        }, 100);
    },
    /**
     * @param {?number} scale
     */
    setScale(scale = null) {
        scale = scale || 1;
        this.fabric().scaleRatio = scale;
        this._zoom();
    },
    /**
     * @param {Object.<string, string>} style
     */
    setCanvasStyle(style) {
        if (!style instanceof Object) {
            return;
        }
        for (const [key, value] of Object.entries(style)) {
            for (const canvas of this._canvases()) {
                canvas.style[key] = value;
            }
        }
    },
    _zoom() {
        let fabric = this.fabric();
        fabric.setDimensions({
            width: fabric.fullWidth * fabric.scaleRatio,
            height: fabric.fullHeight * fabric.scaleRatio
        });
        fabric.setZoom(fabric.scaleRatio);
    },
    /**
     * @param {number} value
     * @param {HTMLCanvasElement} canvas
     * @private
     */
    _canvasMoveX(value, canvas) {
        let current = Number(canvas.style.left.slice(0, -2));
        canvas.style.left = current + value + 'px';
    },
    /**
     * @param {number} value
     * @param {HTMLCanvasElement} canvas
     * @private
     */
    _canvasMoveY(value, canvas) {
        let current = Number(canvas.style.top.slice(0, -2));
        canvas.style.top = current + value + 'px';
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
    }
});
