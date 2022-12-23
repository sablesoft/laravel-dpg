import {shallowReactive, toRaw} from 'vue';
import {fabric} from "fabric-with-erasing";
import './fabric.card';
import './fabric.area';
import './fabric.marker';
import './fabric.book';

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
 * @typedef {Object} ActiveBook
 * @property {?number} id
 * @property {?string} name
 * @property {?string} desc
 * @property {?string} image
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
 * @property {?fabric.Card} card
 * @property {?fabric.Marker} marker
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
 * @property {?fabric.Book} book
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
 * @property {?fabric.Area} area
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
    cursorName: null,
    cursorScope: null,
    activeCardTapped: false,
    activeObjectType: null,
    activeObjectHidden: false,
    selectedId: null,
    /**
     * State of Card component
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
     * State of Book component
     * @member {ActiveBook}
     */
    activeBook: {
        id: null,
        name: null,
        desc: null,
        image: null,
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
     * @member {?fabric.Canvas}
     */
    fabricBoard: null,
    /**
     * @member {?fabric.Canvas}
     */
    fabricMap: null,
    /**
     * @member {?fabric.Canvas}
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
     * Screen width
     * @member {?number}
     */
    width: null,
    /**
     * Screen height
     * @member {?number}
     */
    height: null,
    /**
     * @member {?CanvasConfig}
     */
    canvas: null,
    // canvas control modes:
    modeErase: false,
    modeEraseUndo: false,
    modeTransform: false,
    modeSave: false,
    modeMarkers: false,
    hideOpacity: 0.5,
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
        this.info.id = null;
        this.info.tapped = false;
        this.info.isMarker = false;
        this.activeCard = this.info;
        this.width = options.width;
        this.height = options.height;
        this.role = options.role;
    },
    /**
     * @param {?Object.<string, any>} options
     * @param {?Object.<string, any>} config
     * @return {fabric.Canvas}
     */
    initFabric(options = null, config = null) {
        let canvas = document.getElementsByTagName('canvas')[0];
        let fc = new fabric.Canvas(canvas);
        if (config) {
            fc.loadFromJSON(config, fc.renderAll.bind(fc));
        }
        options = options || {};
        options['preserveObjectStacking'] = true;
        for (const [key, value] of Object.entries(options)) {
            fc[key] = value;
        }
        let self = this;
        setTimeout(function() {
            fc.getObjects().forEach(function(o) {
                if (o.type === 'area') {
                    o.sendBackwards(true);
                }
                if (o.type === 'marker' && self.isMaster()) {
                    o.unlockMovement();
                }
            });
        }, 500);
        let name = 'fabric' + this.mainTab;
        this[name] = fc;
        fc.on({
            'selection:created': function(event) {
                self._selection(event);
                console.debug('selection:created', event);
            },
            'selection:updated': function(event) {
                self._selection(event);
                console.debug('selection:updated', event);
            },
            'selection:cleared': function(event) {
                self._selection();
                console.log('selection:cleared', event);
            },
        });
        fc.on('mouse:down', function(opt) {
            // console.debug('mouse:down', opt);
            let evt = opt.e;
            if (self.modeTransform === true) {
                this.isDragging = true;
                this.selection = false;
                this.lastPosX = evt.clientX;
                this.lastPosY = evt.clientY;
            }
            if (!opt.target) {
                self.setActiveCard();
            }
        });
        fc.on('mouse:move', function(opt) {
            // console.debug('mouse:move', opt);
            if (this.isDragging) {
                let e = opt.e;
                let vpt = this.viewportTransform;
                vpt[4] += e.clientX - this.lastPosX;
                vpt[5] += e.clientY - this.lastPosY;
                this.requestRenderAll();
                this.lastPosX = e.clientX;
                this.lastPosY = e.clientY;
            }
            let target = opt.target;
            if (!target) {
                self.cursorName = null;
                self.cursorScope = null;
                return;
            }
            if (target.card_id) {
                let card = self.cards[target.card_id];
                self.cursorName = card.name;
                self.cursorScope = card.scopeName;
            } else if (target.book_id) {
                let book = self.books[target.book_id];
                self.cursorName = book.name;
                self.cursorScope = 'Book'; // todo - add translate
            }
        });
        fc.on('mouse:up', function(opt) {
            // console.debug('mouse:up', opt);
            this.setViewportTransform(this.viewportTransform);
            this.isDragging = false;
            this.selection = true;
        });
        fc.on('mouse:wheel', function(opt) {
            // console.debug('mouse:wheel', opt);
            if (self.modeTransform) {
                let delta = opt.e.deltaY;
                if (self.activeObjectType === 'marker') {
                    let o = self._findObject(self.activeCard.id, 'cards', 'marker');
                    let scale = o.get('scaleX');
                    scale *= 0.999 ** delta;
                    if (scale > 20) scale = 20;
                    if (scale < 0.01) scale = 0.01;
                    o.scale(scale);
                    fc.requestRenderAll();
                    console.debug('scale marker', o);
                } else {
                    let zoom = fc.getZoom();
                    zoom *= 0.999 ** delta;
                    if (zoom > 20) zoom = 20;
                    if (zoom < 0.01) zoom = 0.01;
                    fc.zoomToPoint({ x: opt.e.offsetX, y: opt.e.offsetY }, zoom);
                }
                opt.e.preventDefault();
                opt.e.stopPropagation();
            }
        });

        return fc;
    },
    isMaster() {
        return this.role === 'master';
    },
    setActiveBook(id) {
        let book = this.books[id];
        console.debug('Select Book', book);
        if (!book) {
            throw new Error('Book not found: ' + id);
        }
        this.activeBook = {
            id: book.id,
            name: book.name,
            desc: book.desc,
            image: book.image
        };
        this.asideTab = 'Book';
    },
    /**
     * @param {?number} id
     * @param {boolean} hidden
     * @return {void}
     */
    setActiveCard(id = null, hidden = false) {
        console.debug('Select Card', id);
        this.asideTab = 'Card';
        if (!id) {
            this.activeObjectType = null;
            switch (this.mainTab) {
                case 'Board':
                    this.activeCard = this.info;
                    this.activeCardTapped = false;
                    return;
                case 'Map':
                    let dome = this.domes[this.activeDomeId];
                    return this.setActiveCard(dome.scope_id);
                case 'Scene':
                    let scene = this.scenes[this.activeSceneId];
                    return this.setActiveCard(scene.scope_id);
                default:
                    throw new Error('Invalid tab type: ' + this.mainTab);
            }
        }
        if (!this.cards[id]) {
            throw new Error('Card not found: ' + id);
        }
        this.activeCard = this.cards[id];
        this.activeObjectHidden = hidden;
        this.activeCardTapped = this.activeCard.tapped;
        console.debug('Active card: ', this.activeCard);
    },
    activeCardTap() {
        this.activeCard.tapped = this._findObject(this.activeCard.id, 'cards', 'card').tap();
        this.activeCardTapped = this.activeCard.tapped;
    },
    activeCardUntap() {
        this.activeCard.tapped = !this._findObject(this.activeCard.id, 'cards', 'card').untap();
        this.activeCardTapped = this.activeCard.tapped;
    },
    /**
     * @param {string} type
     * @param {boolean} hide
     */
    opacity(type, hide = false) {
        this._opacity(this.activeCard.id, 'cards', type, hide);
    },
    /**
     * @param {string} type
     */
    forward(type) {
        this._forward(this.activeCard.id, 'cards', type);
    },
    /**
     * @param {string} type
     */
    backward(type) {
        this._backward(this.activeCard.id, 'cards', type);
    },
    remove(type) {
        let o = this._findObject(this.activeCard.id, 'cards', type);
        console.debug('Remove object for', this.activeCard.name,  o);
        this.fb().remove(o, this.fb().renderAll.bind(this.fb()));
        this.setActiveCard();
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

        return this.cards[id].card = o;
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
            o.sendBackwards(true);
            this.fb().requestRenderAll();
        }

        return this.areas[id].area = o;
    },
    /**
     * @param {number} id
     * @param {?Object.<string, any>} options
     * @param {?boolean} add
     * @return {fabric.Marker}
     */
    createMarkerFabric(id, options = null, add = true) {
        if (!this.cards[id]) {
            throw new Error('Card not found: ' + id);
        }
        let o = new fabric.Marker(toRaw(this.cards[id]), options);
        if (add) {
            this.fb().add(o);
            this.fb().requestRenderAll();
        }

        return this.cards[id].marker = o;
    },
    /**
     * @param {number} id
     * @param {?Object.<string, any>} options
     * @param {?boolean} add
     * @return {fabric.Book}
     */
    createBookFabric(id, options = null, add = true) {
        if (!this.books[id]) {
            throw new Error('Card not found: ' + id);
        }
        options = options || {};
        options.back_image = options.back_image || this.cardsBack;
        options.scopeName = 'Book'; // todo - add dictionary from backend
        let o = new fabric.Book(toRaw(this.books[id]), options);
        if (add) {
            this.fb().add(o);
            this.fb().requestRenderAll();
        }
        console.debug('Book object', o);

        return this.books[id].book = o;
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
        if (this.modeTransform) {
            this.transformMode();
        }
        if (this.modeMarkers) {
            this.markersMode();
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
        if (this.modeTransform) {
            this.transformMode();
        }
        if (this.modeMarkers) {
            this.markersMode();
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
        if (this.modeTransform) {
            this.transformMode();
        }
        if (this.modeMarkers) {
            this.markersMode();
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
    transformMode() {
        if (this.modeErase) {
            this.eraseMode();
        }
        if (this.modeEraseUndo) {
            this.eraseUndoMode();
        }
        if (this.modeMarkers) {
            this.markersMode();
        }
        this.modeTransform = !this.modeTransform;
    },
    eraseMode() {
        if (this.modeTransform) {
            this.transformMode();
        }
        if (this.modeEraseUndo) {
            this.eraseUndoMode();
        }
        if (this.modeMarkers) {
            this.markersMode();
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
        if (this.modeTransform) {
            this.transformMode();
        }
        if (this.modeErase) {
            this.eraseMode();
        }
        if (this.modeMarkers) {
            this.markersMode();
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
    markersMode() {
        if (this.modeTransform) {
            this.transformMode();
        }
        if (this.modeErase) {
            this.eraseMode();
        }
        if (this.modeEraseUndo) {
            this.eraseUndoMode();
        }
        this.modeMarkers = !this.modeMarkers;
        this.selectedId = null;
        this.setActiveCard();
    },
    addMarker() {
        console.debug('Add marker for: ', this.activeCard.name);
        let center = this._center();
        let o = this.createMarkerFabric(this.selectedId, {
            left: center.x,
            top: center.y
        });
        this.fb().renderAll();
        if (this.isMaster()) {
            o.unlockMovement();
        }
    },
    saveCanvas() {
        this.modeSave = true;
        let data = {
            gameId : this.id,
            fields: ['canvas'],
            canvas : this.fb().toObject(['viewportTransform'])
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
     * @returns {?fabric.Canvas}
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
        console.log('RESET IS TODO');
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
                o.set('evented', false);
                o.set('hoverCursor', 'default');
                o.bringForward();
                console.debug('Fog freeze!');
            }
        });
    },
    /**
     * @param {number} id
     * @return {Object<number, any>}
     */
    bookDomes(id) {
        let book = this.books[id];
        if (!book) {
            throw new Error('Book not exists: ' + id);
        }
        let filtered = {};
        let self = this;

        // todo - filter by openDomeIds if no master

        book.dome_ids.forEach(function(id) {
            filtered[id] = toRaw(self.domes[id]);
        });

        return filtered;
    },
    /**
     * @param {number} id
     * @return {Object<number, any>}
     */
    bookScenes(id) {
        let book = this.books[id];
        if (!book) {
            throw new Error('Book not exists: ' + id);
        }
        let filtered = {};
        let self = this;

        // todo - filter by openSceneIds if no master

        book.scene_ids.forEach(function(id) {
            filtered[id] = toRaw(self.scenes[id]);
        });

        return filtered;
    },
    /**
     * @param {number} id
     * @return {Object<number, any>}
     */
    bookDecks(id) {
        let book = this.books[id];
        if (!book) {
            throw new Error('Book not exists: ' + id);
        }
        let filtered = {};
        let self = this;

        // todo - filter by openDeckIds if no master

        book.deck_ids.forEach(function(id) {
            let deck = toRaw(self.decks[id]);
            let scope = self.cards[deck.scope_id];
            let target = self.cards[deck.target_id];
            filtered[id] = {
                id: id,
                scope: scope.name,
                target: target.name
            }
        });
        console.log('Decks', filtered);

        return filtered;
    },
    /**
     * @param {number} id
     * @return {Object<number, any>}
     */
    bookCards(id) {
        let book = this.books[id];
        if (!book) {
            throw new Error('Book not exists: ' + id);
        }
        let filtered = {};
        let self = this;

        // todo - filter by openCardIds if no master

        book.card_ids.forEach(function(id) {
            filtered[id] = toRaw(self.cards[id]);
        });

        return filtered;
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
    selectDome(event) {
        this.selectedId = null;
        this.fb().discardActiveObject();
        let dome = this.domes[event.target.value];
        console.debug('Selected Dome', dome);
        // todo
    },
    selectScene(event) {
        this.selectedId = null;
        this.fb().discardActiveObject();
        let scene = this.scenes[event.target.value];
        console.debug('Selected Scene', scene);
        // todo
    },
    selectDeck(event) {
        this.selectedId = null;
        this.fb().discardActiveObject();
        let deck = this.decks[event.target.value];
        console.debug('Selected Deck', deck);
        // todo
    },
    selectCard(event) {
        this.selectedId = null;
        this.fb().discardActiveObject();
        this.setActiveCard(event.target.value);
    },
    /**
     * @return {HTMLCollectionOf<HTMLCanvasElement>}
     * @private
     */
    _canvases() {
        return document.getElementsByTagName('canvas');
    },
    /**
     *
     * @param {number} id
     * @param {string} entity
     * @param {string} type
     * @return {*}
     * @private
     */
    _findObject(id, entity, type) {
        if (!this[entity][id]) {
            throw new Error('Entity not found: ' + entity + ' : ' + id);
        }
        let model = this[entity][id];
        if (!model[type]) {
            let found = null;
            this.fb().forEachObject(function(o) {
                if (found) {
                    return;
                }
                if (o.type === type && Number(o.get('card_id')) === Number(id)) {
                    found = o;
                }
            });
            if (!found) {
                throw new Error('Fabric object in '+ entity +' not found: ' + type + ' : ' + id);
            }
            model[type] = found;
            this[entity][id] = model;
        }
        return model[type];
    },
    /**
     * @param {number} id
     * @param {string} entity
     * @param {string} type
     * @private
     */
    _forward(id, entity, type) {
        console.debug('Forward for', entity, type, id);
        this._findObject(id, entity, type).bringForward(true);
        this.fb().renderAll();
    },
    /**
     * @param {number} id
     * @param {string} entity
     * @param {string} type
     * @private
     */
    _backward(id, entity, type) {
        console.debug('Backward for', entity, type, id);
        this._findObject(id, entity, type).sendBackwards(true);
        this.fb().renderAll();
    },
    /**
     * @param {number} id
     * @param {string} entity
     * @param {string} type
     * @param {boolean} hide
     * @private
     */
    _opacity(id, entity, type, hide = false) {
        let opacity = 1;
        if (hide) {
            opacity = this.isMaster() ? this.hideOpacity : 0;
        }
        this._findObject(id, entity, type).set('opacity', opacity);
        this.fb().requestRenderAll();
        this.activeObjectHidden = hide;
    },
    _selection(event = null) {
        if (this.modeMarkers) {
            return;
        }
        if (!event) {
            this.setActiveCard();
            return;
        }
        let o = event.selected[0];
        if (!o) {
            this.setActiveCard();
        } else if (o.card_id) {
            this.activeObjectType = o.type;
            if (o.type === 'card' && !o.opened) {
                this.setActiveCard();
            } else {
                let hidden = Number(o.get('opacity')) < 1;
                this.setActiveCard(o.card_id, hidden);
            }
        } else if (o.book_id) {
            this.setActiveBook(o.book_id);
        } else {
            this.setActiveCard();
        }
    },
    _center() {
        let port = this.fb().calcViewportBoundaries();
        return {
            x: parseInt(port.tl.x + (port.br.x - port.tl.x)/2),
            y: parseInt(port.tl.y + (port.br.y - port.tl.y)/2)
        }
    }
});
