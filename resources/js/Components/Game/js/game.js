import {shallowReactive, toRaw} from 'vue';
import {fabric} from "fabric-with-erasing";
import './fabric.card';
import './fabric.area';
import './fabric.marker';
import './fabric.book';
import './fabric.dome';
import './fabric.fog';

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
 * @property {string} locale
 * @property {Object} dictionary
 */

/**
 * @typedef {Object} ActiveInfo
 * @property {?number} id
 * @property {?number} scopeId
 * @property {?string} type
 * @property {?string} name
 * @property {?string} currentName
 * @property {?string} scopeName
 * @property {?string} desc
 * @property {?string} currentDesc
 * @property {?string} image
 * @property {?string} scopeImage
 */

/**
 * @typedef {Object} ActiveCard
 * @property {?number} id
 * @property {?string} name
 * @property {?string} scopeName
 * @property {?string} desc
 * @property {?string} image
 * @property {?string} scopeImage
 */

/**
 * @typedef {Object} ActiveBook
 * @property {?number} id
 * @property {?string} name
 * @property {?string} desc
 * @property {?string} image
 */

/**
 * @typedef {Object} ActiveArea
 * @property {?number} id
 * @property {?string} name
 * @property {?string} desc
 * @property {?string} image
 */

/**
 * @typedef {Object} GameCard
 * @property {number} id
 * @property {number} scope_id
 * @property {?Object.<string, string>} name
 * @property {?Object.<string, string>} desc
 * @property {?string} info
 * @property {?string} code
 * @property {?Object.<string, string>} currentName
 * @property {?Object.<string, string>} currentDesc
 * @property {?CanvasConfig} canvas
 * @property {?string} image
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
 * @property {string} currentName
 * @property {?string} desc
 * @property {?string} currentDesc
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
 * @property {number[]} scene_ids
 * @property {number[]} card_ids
 * @property {number[]} deck_ids
 * @property {number[]} source_ids
 */

/**
 * @typedef {Object} Land
 * @property {number} id
 * @property {number} scope_id
 * @property {?string} desc
 * @property {?CanvasConfig} canvas
 * @property {?string} image
 * @property {number} dome_id
 * @property {number[]} area_ids
 * @property {number[]} scene_ids
 * @property {number[]} card_ids
 * @property {number[]} deck_ids
 * @property {number[]} source_ids
 */

/**
 * @typedef {Object} GameArea
 * @property {number} id
 * @property {number} scope_id
 * @property {?string} desc
 * @property {?CanvasConfig} canvas
 * @property {?string} image
 * @property {number} dome_id
 * @property {number} top
 * @property {number} top_step
 * @property {number} left
 * @property {number} left_step
 * @property {number[]} scene_ids
 * @property {number[]} card_ids
 * @property {number[]} deck_ids
 * @property {number[]} source_ids
 * @property {?fabric.Area} area
 */

/**
 * @typedef {Object} Scene
 * @property {number} id
 * @property {number} scope_id
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
     * @member {?ActiveInfo} - game info
     */
    info: {
        id: null,
        scopeId: null,
        type: 'game',
        name: null,
        currentName: null,
        desc: null,
        currentDesc: null,
        image: null,
        scopeImage: null,
        scopeName: null
    },
    locale: 'en',
    fallbackLocale: 'en',
    dictionary: {},
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
     * @member {?fabric.Object}
     */
    activeObject: null,
    /**
     * @member {?ActiveInfo} - mainTab info
     */
    activeInfo: {
        id: null,
        scopeId: null,
        type: null,
        name: null,
        currentName: null,
        desc: null,
        currentDesc: null,
        image: null,
        scopeImage: null,
        scopeName: null
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
     * @member {number[]} - open book ids
     */
    visibleBookIds: [],
    /**
     * @member {number[]} - open dome ids
     */
    visibleDomeIds: [],
    /**
     * @member {number[]} - open land ids
     */
    visibleLandIds: [],
    /**
     * @member {number[]} - open area ids
     */
    visibleAreaIds: [],
    /**
     * @member {number[]} - open scene ids
     */
    visibleSceneIds: [],
    /**
     * @member {number[]} - open deck ids
     */
    visibleDeckIds: [],
    /**
     * @member {number[]} - open card ids
     */
    visibleCardIds: [],
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
    fbBoard: null,
    /**
     * @member {?fabric.Canvas}
     */
    fbMap: null,
    /**
     * @member {?fabric.Canvas}
     */
    fbScene: null,
    /**
     * @member {string}
     */
    mainTab: 'MainBoard',
    /**
     * @member {string}
     */
    asideTab: 'AsideInfo',
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
    hideOpacity: 0.5,
    brushWidth: 50,
    initiated: false,
    _updateRequest: {},
    /**
     * @param {Object.<string, any>} data
     * @param {GameOptions} options
     */
    init(data, options) {
        for (const [key, value] of Object.entries(data)) {
            this[key] = toRaw(value);
        }
        this.width = options.width;
        this.height = options.height;
        this.role = options.role;
        this.locale = options.locale;
        this.dictionary = options.dictionary;
        this.showInfo();
        this.initiated = true;

        console.debug('Game initiated', this);
    },
    /**
     * @param {?Object.<string, any>} json
     * @param {?function} callback
     * @return {fabric.Canvas}
     */
    initCanvas(json = null, callback = null) {
        let canvas = document.getElementsByTagName('canvas')[0];
        let fc = new fabric.Canvas(canvas);
        let self = this;
        if (json) {
            fc.loadFromJSON(json, function () {
                fc.renderAll.bind(fc);
                setTimeout(function() {
                    self.updateCanvas(fc);
                }, 3000);
                if (typeof callback === 'function') {
                    callback(fc);
                }
            });
        }
        fc['preserveObjectStacking'] = true;
        let name = 'fb' + this.mainTab;
        this[name] = fc;
        fc.on('selection:created', function(opt) {
            // console.debug('selection:created', opt);
            self._selection(opt);
        });
        fc.on('selection:updated', function(opt) {
            // console.debug('selection:updated', opt);
            self._selection(opt);
        });
        fc.on('selection:cleared', function() {
            // console.debug('selection:cleared', opt);
            self._selection();
        });
        fc.on('mouse:wheel', function(opt) {
            // console.debug('mouse:wheel', opt);
            if (self.modeTransform) {
                let delta = opt.e.deltaY;
                if (self.activeObjectType === 'marker') {
                    let o = self.activeObject;
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
        fc.on('mouse:down', function(opt) {
            console.debug('mouse:down', opt);
            let evt = opt.e;
            if (self.modeTransform === true) {
                this.isDragging = true;
                this.selection = false;
                this.lastPosX = evt.clientX;
                this.lastPosY = evt.clientY;
            }
            let o = opt.target;
            // check selected area by polygons:
            if (o && o.type === 'area') {
                o = self._findArea(o, opt.absolutePointer);
                if (o) {
                    self.setActiveObject(o);
                    self.showAside(o);
                }
            }
            // clear aside if no target:
            if (!o) {
                self.showInfo();
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
            self._cursor(opt);
        });
        fc.on('mouse:out', function() {
            // console.debug('mouse:out', opt);
            self._cursor();
        });
        fc.on('mouse:up', function() {
            // console.debug('mouse:up', this);
            this.setViewportTransform(this.viewportTransform);
            this.isDragging = false;
            this.selection = true;
        });
        if (!json && typeof callback === 'function') {
            callback(fc);
        }

        return fc;
    },
    updateCanvas(fc = null) {
        fc = fc ? fc: this.fb();
        fc.getObjects().forEach(function(o) {
            // console.debug('Check object update', o);
            // console.debug('Type of update', typeof o.update);
            if (typeof o.update === 'function') {
                // console.debug('Updating object', o);
                o.update();
            }
        });
    },
    isMaster() {
        return this.role === 'master';
    },
    activateSpace(activate = true) {
        let id = Number(this.activeInfo.id);
        switch(this.activeInfo.type) {
            case 'dome':
                this.activeDomeId = activate ? id : null;
                if (this.mainTab === 'MainDome') {
                    if (!this.activeDomeId) {
                        this.mainTab = 'MainBoard';
                    } else {
                        this.mainTab = 'MainBoard';
                        this.mainTab = 'MainDome';
                    }
                }
                break;
            case 'area':
                this.activeAreaId = activate ? id : null;
                this.activateArea();
                break;
            case 'scene':
                this.activeSceneId = activate ? id : null;
                if (this.mainTab === 'MainScene') {
                    if (!this.activeSceneId) {
                        this.mainTab = 'MainBoard';
                    } else {
                        this.mainTab = 'MainBoard';
                        this.mainTab = 'MainScene';
                    }
                }
                break;
            default:
                console.error('Invalid active info for makeActive', this.activeInfo);
                throw new Error('Invalid active info for makeActive');
        }
    },
    activateArea() {
        let self = this;
        console.debug('Activate area', self.activeAreaId);
        this.fb().getObjects('area').forEach(function(o) {
            // console.debug('Check area is active', o);
            if (self.activeAreaId && Number(self.activeAreaId) === Number(o.area_id)) {
                // console.debug('Activate!');
                self.moveToCenter(o);
                o.activate();
            } else {
                // console.debug('Deactivate!')
                o.activate(false);
            }
        });
    },
    isActivated() {
        let id = Number(this.activeInfo.id);
        switch(this.activeInfo.type) {
            case 'dome':
                // console.debug('Active dome', this.activeDomeId);
                return this.activeDomeId === id;
            case 'area':
                // console.debug('Active area', this.activeAreaId);
                return this.activeAreaId === id;
            case 'scene':
                // console.debug('Active scene', this.activeSceneId);
                return this.activeSceneId === id;
            default:
                console.error('Invalid active info for isActivated', this.activeInfo);
                throw new Error('Invalid active info for isActivated');
        }
    },
    showInfo() {
        this.asideTab = 'AsideInfo';
        if (this.fb()) {
            this.setActiveObject();
        }
        let scopeCard = null;
        switch (this.mainTab) {
            case 'MainBoard':
                this.activeInfo = {
                    id: null,
                    scopeId: null,
                    type: 'game',
                    name: this._toLocale(this.info.name),
                    currentName: this._toLocale(this.info.currentName),
                    desc: this._toLocale(this.info.desc),
                    currentDesc: this._toLocale(this.info.currentDesc),
                    image: this.info.image,
                    scopeImage: null,
                    scopeName: this.trans('Game')
                };
                return;
            case 'MainDome':
                let dome = this.findDome(this.activeDomeId);
                let domeCard = this.findCard(dome.scope_id);
                scopeCard = this.findCard(domeCard.scope_id, false);
                this.activeInfo = {
                    id: dome.id,
                    scopeId: dome.scope_id,
                    type: 'dome',
                    name: this._toLocale(domeCard.name),
                    currentName: this._toLocale(domeCard.currentName),
                    desc: this._toLocale(domeCard.desc),
                    currentDesc: this._toLocale(domeCard.currentDesc),
                    image: domeCard.image,
                    scopeImage: scopeCard ? scopeCard.image : null,
                    scopeName: scopeCard ? this._toLocale(scopeCard.name) : null
                };
                return;
            case 'MainScene':
                let scene = this.findScene(this.activeSceneId);
                let sceneCard = this.findCard(scene.scope_id);
                scopeCard = this.findCard(sceneCard.scope_id, false);
                this.activeInfo = {
                    id: scene.id,
                    scopeId: scene.scope_id,
                    type: 'scene',
                    name: this._toLocale(sceneCard.name),
                    currentName: this._toLocale(sceneCard.currentName),
                    desc: this._toLocale(sceneCard.desc),
                    currentDesc: this._toLocale(sceneCard.currentDesc),
                    image: sceneCard.image,
                    scopeImage: scopeCard ? scopeCard.image : null,
                    scopeName: scopeCard ? this._toLocale(scopeCard.name) : null
                };
                return;
            default:
                throw new Error('Invalid main tab: ' + this.mainTab);
        }
    },
    /**
     * @param {string} tab
     */
    showMain(tab) {
        if (this.mainTab === tab) {
            return;
        }
        this._offModes();
        this.saveCanvas();
        this.mainTab = tab;
        this.showInfo();
    },
    /**
     * @param {?fabric.Object|number} o
     * @param {?string} type
     * @return {Object}
     */
    showAside(o = null, type = null) {
        if (!o) {
            return this.showInfo();
        }
        let id = null;
        if (typeof o === 'object') {
            type = o.type;
            let field = type + '_id';
            id = o[field];
        } else {
            id = o;
        }
        if (!id || !type) {
            return this.showInfo();
        }
        // noinspection FallThroughInSwitchStatementJS
        switch (type) {
            case 'book':
                return this.showBook(id);
            case 'card':
                if (o) {
                    if (!o.get('opened') && !this.isMaster()) {
                        return this.showInfo();
                    }
                    this.activeCardTapped = Boolean(o.get('tapped'));
                }
            case 'marker':
                return this.showCard(id);
            case 'area':
                return this.showArea(id);
            case 'dome':
                return this.showDome(id);
            default:
                throw new Error('Unknown object type: ' + type);
        }
    },
    showBook(id) {
        let book = this.findBook(id);
        // console.debug('Show Book', book);
        this.activeInfo = {
            id: book.id,
            type: 'book',
            name: this._toLocale(book.name),
            currentName: this._toLocale(book.currentName),
            desc: this._toLocale(book.desc),
            currentDesc: this._toLocale(book.currentDesc),
            image: book.image,
            scopeImage: null,
            scopeName: null
        };
        let self = this;
        this.fb().getObjects('book').forEach(function(o) {
            if (o.get('book_id') === Number(id)) {
                self.setActiveObject(o);
            }
        });
        this.asideTab = 'AsideBook';

        return this;
    },
    showCard(id, discardObject = false) {
        let card = this.findCard(id);
        let scopeCard = this.findCard(card.scope_id, false);
        // console.debug('Show Card', card);
        if (discardObject) {
            this.setActiveObject();
        }
        this.activeInfo = {
            id: card.id,
            scopeId: card.scope_id,
            type: 'card',
            name: this._toLocale(card.name),
            currentName: this._toLocale(card.currentName),
            desc: this._toLocale(card.desc),
            currentDesc: this._toLocale(card.currentDesc),
            image: card.image,
            scopeImage: scopeCard ? scopeCard.image : null,
            scopeName: scopeCard ? this._toLocale(scopeCard.currentName) : null,
        };
        this.asideTab = 'AsideCard';

        return this;
    },
    showDome(id) {
        let dome = this.findDome(id);
        // console.debug('Show Dome', dome);
        let domeCard = this.findCard(dome.scope_id);
        this.activeInfo = {
            id: dome.id,
            scopeId: dome.scope_id,
            type: 'dome',
            name: this._toLocale(domeCard.name),
            currentName: this._toLocale(domeCard.currentName),
            desc: this._toLocale(domeCard.desc),
            currentDesc: this._toLocale(domeCard.currentDesc),
            image: domeCard.image,
            scopeImage: null,
            scopeName: null
        };
        let self = this;
        this.fb().getObjects('dome').forEach(function(o) {
            if (o.get('dome_id') === Number(id)) {
                self.setActiveObject(o);
            }
        });
        this.asideTab = 'AsideDome';

        return this;
    },
    showLand(id) {
        let land = this.findLand(id);
        // console.debug('Show Land', land);
        let landCard = this.findCard(land.scope_id);
        this.activeInfo = {
            id: land.id,
            scopeId: land.scope_id,
            type: 'dome',
            name: this._toLocale(landCard.name),
            currentName: this._toLocale(landCard.currentName),
            desc: this._toLocale(landCard.desc),
            currentDesc: this._toLocale(landCard.currentDesc),
            image: landCard.image,
            scopeImage: null,
            scopeName: null
        };
        this.asideTab = 'AsideLand';

        return this;
    },
    showArea(id) {
        let area = this.findArea(id);
        // console.debug('Show Area', area);
        let areaCard = this.findCard(area.scope_id);
        let scopeCard = this.findCard(areaCard.scope_id);
        this.activeInfo = {
            id: area.id,
            scopeId: area.scope_id,
            type: 'area',
            name: this._toLocale(areaCard.name),
            currentName: this._toLocale(areaCard.currentName),
            desc: this._toLocale(areaCard.desc),
            currentDesc: this._toLocale(areaCard.currentDesc),
            image: areaCard.image,
            scopeImage: scopeCard ? scopeCard.image : null,
            scopeName: scopeCard ? this._toLocale(scopeCard.currentName) : null,
        };
        this.asideTab = 'AsideArea';

        return this;
    },
    showScene(id) {
        let scene = this.findScene(id);
        // console.debug('Show Scene', scene);
        let sceneCard = this.findCard(scene.scope_id);
        let scopeCard = this.findCard(sceneCard.scope_id, false);
        this.activeInfo = {
            id: scene.id,
            scopeId: scene.scope_id,
            type: 'scene',
            name: this._toLocale(sceneCard.name),
            currentName: this._toLocale(sceneCard.currentName),
            desc: this._toLocale(sceneCard.desc),
            currentDesc: this._toLocale(sceneCard.currentDesc),
            image: sceneCard.image,
            scopeImage: scopeCard ? scopeCard.image: null,
            scopeName: scopeCard ? this._toLocale(sceneCard.name) : null,
        };
        this.asideTab = 'AsideScene';

        return this;
    },
    activeCardTap() {
        this.activeCardTapped = this.activeObject.tap();
    },
    activeCardUntap() {
        this.activeCardTapped = !this.activeObject.untap();
    },
    /**
     * @param {boolean} show
     */
    visibility(show = true) {
        let o = this.activeObject;
        if (!o) {
            throw new Error('Active object not found for opacity!');
        }
        this.activeObjectHidden = !show;
        if (typeof o.visibility === 'function') {
            o.visibility(show);
        } else {
            let opacity = show ? 1 : (this.isMaster() ? this.hideOpacity : 0);
            o.set('opacity', opacity);
            this.activeObjectHidden = opacity < 1;
            this.fb().renderAll();
        }
        switch (o.type) {
            case 'card':
                this._visibility('card', o.get('card_id'), show);
                break;
            case 'marker':
                this._visibility('card', o.get('marker_id'), show);
                break;
            case 'dome':
                this._visibility('dome', o.get('dome_id'), show);
                break;
            case 'area':
                this._visibility('area', o.get('area_id'), show);
                break;
            case 'book':
                this._visibility('book', o.get('book_id'), show);
                break;
            default:
                console.warn('Unknown object for visibility: ', o);
        }
    },
    forward() {
        let o = this.activeObject;
        if (!o) {
            throw new Error('Active object for forward not found!');
        }
        console.debug('Forward object', o);
        o.bringForward(true);
        this.fb().renderAll();
    },
    backward() {
        let o = this.activeObject;
        if (!o) {
            throw new Error('Active object for backward not found!');
        }
        console.debug('Backward object', o);
        o.sendBackwards(true);
        this.fb().renderAll();
    },
    remove() {
        let o = this.activeObject;
        if (!o) {
            throw new Error('Active object for removing not found!');
        }
        console.debug('Remove object', o);
        this.fb().remove(o, this.fb().renderAll.bind(this.fb()));
        this.setActiveObject();
        this.showInfo();
    },
    moveToCenter(o = null) {
        o = o ? o : this.activeObject;
        if (!o) {
            throw new Error('Active object not found for moveToCenter!');
        }
        let fc = this.fb();
        let zoom = fc.getZoom();
        fc.setZoom(1);
        let vpw = fc.width / zoom;
        let vph = fc.height / zoom;
        let p = o.getCenterPoint();
        p.x = p.x - vpw / 2;
        p.y = p.y - vph / 2;
        fc.absolutePan(p);
        fc.setZoom(zoom);
        this.fb().requestRenderAll();

        return this;
    },
    /**
     * @param {number} id
     * @param {Object.<string, any>} options
     * @param {?boolean} add
     * @return {fabric.Card}
     */
    createCardFabric(id, options, add = true) {
        let o = new fabric.Card(id, options);
        if (add) {
            this.fb().add(o);
            this.fb().requestRenderAll();
        }
        // console.debug('Created card object', o);

        return o;
    },
    /**
     * @param {number} id
     * @param {?Object.<string, any>} options
     * @param {?boolean} add
     * @return {fabric.Area}
     */
    createAreaFabric(id, options = null, add = true) {
        let o = new fabric.Area(id, options);
        if (add) {
            this.fb().add(o);
            // o.sendBackwards(true);
            this.fb().requestRenderAll();
        }
        // console.debug('Created area object', o);

        return o;
    },
    /**
     * @param {number} id
     * @param {Object.<string, any>} options
     * @param {?boolean} add
     * @return {fabric.Marker}
     */
    createMarkerFabric(id, options, add = true) {
        let o = new fabric.Marker(id, options);
        if (add) {
            this.fb().add(o);
            this.fb().requestRenderAll();
        }
        // console.debug('Created marker object', o);

        return o;
    },
    /**
     * @param {number} id
     * @param {Object.<string, any>} options
     * @param {?boolean} add
     * @return {fabric.Book}
     */
    createBookFabric(id, options, add = true) {
        let o = new fabric.Book(id, options);
        if (add) {
            this.fb().add(o);
            this.fb().requestRenderAll();
        }
        // console.debug('Created book object', o);

        return o;
    },
    /**
     * @param {number} id
     * @param {Object.<string, any>} options
     * @param {?boolean} add
     * @return {fabric.Book}
     */
    createDomeFabric(id, options, add = true) {
        let o = new fabric.Dome(id, options);
        if (add) {
            this.fb().add(o);
            this.fb().requestRenderAll();
        }
        // console.debug('Created dome object', o);

        return o;
    },
    createFog(width, height) {
        let self = this;
        setTimeout(function() {
            console.debug('Add fog');
            let fog = new fabric.Fog({
                width: width,
                height: height
            });
            self.fb().add(fog);
            fog.bringForward(true);
            self.fb().requestRenderAll();
        }, 5000);
    },
    addDome() {
        let center = this._center();
        this.createDomeFabric(this.activeInfo.id, {
            left: center.x,
            top: center.y
        });
        this.showDome(this.activeInfo.id);
    },
    addBook() {
        let center = this._center();
        this.createBookFabric(this.activeInfo.id, {
            left: center.x,
            top: center.y
        });
        this.showBook(this.activeInfo.id);
    },
    addCard() {
        let center = this._center();
        let o = this.createCardFabric(this.activeInfo.id, {
            left: center.x,
            top: center.y
        });
        this.setActiveObject(o);
        this.showCard(this.activeInfo.id);
    },
    addMarker() {
        let center = this._center();
        let o = this.createMarkerFabric(this.activeInfo.id, {
            left: center.x,
            top: center.y
        });
        this.setActiveObject(o);
        this.showCard(this.activeInfo.id);
    },
    getBookName(id, current = true) {
        let book = null;
        if (typeof id === 'number') {
            book = this.findBook(id);
        } else {
            book = id;
        }
        return current ? this._toLocale(book.currentName) : this._toLocale(book.name);

    },
    /**
     *
     * @param {number|GameCard} id
     * @param current
     * @return {?string}
     */
    getCardName(id, current = true) {
        let card = null;
        if (typeof id === 'number') {
            card = this.findCard(id);
        } else {
            card = id;
        }
        return current ? this._toLocale(card.currentName) : this._toLocale(card.name);

    },
    getDomeName(id, current = true) {
        let dome = null;
        if (typeof id === 'number') {
            dome = this.findDome(id);
        } else {
            dome = id;
        }
        return this.getCardName(this.findCard(dome.scope_id), current);
    },
    getLandName(id, current = true) {
        let land = null;
        if (typeof id === 'number') {
            land = this.findLand(id);
        } else {
            land = id;
        }
        return this.getCardName(this.findCard(land.scope_id), current);
    },
    getAreaName(id, current = true) {
        let area = null;
        if (typeof id === 'number') {
            area = this.findArea(id);
        } else {
            area = id;
        }
        return this.getCardName(this.findCard(area.scope_id), current);
    },
    getSceneName(id, current = true) {
        let scene = null;
        if (typeof id === 'number') {
            scene = this.findScene(id);
        } else {
            scene = id;
        }
        return this.getCardName(this.findCard(scene.scope_id), current);
    },
    switchTransform() {
        this._offModes('Transform');
        this.modeTransform = !this.modeTransform;
    },
    switchErase() {
        this._offModes('Erase');
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
    switchEraseUndo() {
        this._offModes('EraseUndo');
        this.modeEraseUndo = !this.modeEraseUndo;
        let canvas = this.fb();
        if (this.modeEraseUndo) {
            canvas.freeDrawingBrush = new fabric.EraserBrush(canvas);
            this.setBrushWidth();
            canvas.freeDrawingBrush.inverted = true;
            canvas.isDrawingMode = true;
            this.previewFog();
        } else {
            canvas.isDrawingMode = false;
            this.previewFog(false);
        }
    },
    saveCanvas() {
        let canvas = this.fb().toObject(['viewportTransform']);
        switch(this.mainTab) {
            case 'MainDome':
                this.domes[this.activeDomeId].canvas = canvas;
                break;
            case 'MainScene':
                this.scenes[this.activeSceneId].canvas = canvas;
                break;
            case 'MainBoard':
                this.canvas = canvas;
                break;
            default:
                throw new Error('Invalid main tab');
        }

        return canvas;
    },
    save() {
        this.modeSave = true;
        let gameRequest = {};
        gameRequest[this.id] = this._data();
        let request = {
            game: gameRequest
        };
        let canvas = this.saveCanvas();
        switch(this.mainTab) {
            case 'MainDome':
                request['dome'] = {};
                request['dome'][this.activeDomeId] = {
                    canvas: canvas
                };
                break;
            case 'MainScene':
                request['scene'] = {};
                request['scene'][this.activeSceneId] = {
                    canvas: canvas
                };
                break;
            case 'MainBoard':
                request['game'][this.id]['canvas'] = canvas;
                break;
            default:
                throw new Error('Invalid main tab');
        }
        if (this.isMaster()) {
            let self = this;
            request = this._prepareUpdateRequest(request);
            console.debug('Save request', request);
            axios.patch('/game', request)
                .then(() => {
                    self._updateRequest = {};
                    self.modeSave = false;
                }).catch(err => {
                    self.modeSave = false;
                    console.error(err);
                });
        } else {
            this.modeSave = false;
        }
    },
    editCurrent() {
        this.asideTab = 'AsideEdit';
    },
    updateCurrent() {
        let card;
        switch (this.activeInfo.type) {
            case 'game':
                this.info['currentName'][this.locale] = this.activeInfo.currentName ?
                    this.activeInfo.currentName : this.activeInfo.name;
                this.info['currentDesc'][this.locale] = this.activeInfo.currentDesc ?
                    this.activeInfo.currentDesc : this.activeInfo.desc;
                this.showInfo();
                return;
            case 'book':
                let book = this.findBook(this.activeInfo.id);
                book['currentName'][this.locale] = this.activeInfo.currentName ?
                    this.activeInfo.currentName : this.activeInfo.name;
                book['currentDesc'][this.locale] = this.activeInfo.currentDesc ?
                    this.activeInfo.currentDesc : this.activeInfo.desc;
                this._update('book', book);
                this.updateCanvas();
                this.asideTab = 'AsideBook';
                return;
            case 'card':
                card = this.findCard(this.activeInfo.id);
                break;
            default:
                card = this.findCard(this.activeInfo.scopeId);
                break;
        }
        card['currentName'][this.locale] = this.activeInfo.currentName ?
            this.activeInfo.currentName : this.activeInfo.name;
        card['currentDesc'][this.locale] = this.activeInfo.currentDesc ?
            this.activeInfo.currentDesc : this.activeInfo.desc;
        this._update('card', card);
        this.updateCanvas();
        this.switchCard(card.id);
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
        let fabricName = 'fb' + this.mainTab;
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
    canvasUndo() {
        // todo
        console.log('TODO - canvas undo');
    },
    canvasRedo() {
        // todo
        console.log('TODO - canvas redo');
    },
    /**
     * @param {?string} filter
     * @param {?any} value
     * @return {Object<number, any>}
     */
    filteredSources(filter = null, value = null) {
        let ids = this.isMaster() ?
            Object.keys(this.books) : Array.from(this.visibleBookIds);
        if (!filter) {
            switch (this.mainTab) {
                case 'MainBoard':
                    filter = 'all';
                    break;
                case 'MainDome':
                    filter = 'domes';
                    break;
                case 'MainScene':
                    filter = 'scenes';
                    break;
                default:
                    console.error('Unknown main tab!', this.mainTab);
                    throw new Error('Unknown main tab!');
            }
        }
        let isField = filter[0] === '.';
        if (isField) {
            filter = filter.slice(1);
            value = value ? value : this.activeInfo.id;
        }
        if (!isField && filter !== 'all') {
            ids = this._sourceFilter(ids, filter, 'source_ids');
        }
        let self = this;
        let filtered = {};
        ids.forEach(function(id) {
            let book = self.findBook(id);
            if (isField && book[filter] !== value) {
                return;
            }
            filtered[id] = book;
        });

        return filtered;
    },
    /**
     * @param {?string} filter
     * @param {?any} value
     * @return {Object<number, any>}
     */
    filteredDomes(filter = null, value = null) {
        let ids = this.isMaster() ?
            Object.keys(this.domes) : Array.from(this.visibleDomeIds);
        if (!filter) {
            filter = 'all';
        }
        let isField = filter[0] === '.';
        if (isField) {
            filter = filter.slice(1);
            value = value ? value : this.activeInfo.id;
        }
        if (!isField && filter !== 'all') {
            ids = this._sourceFilter(ids, filter, 'dome_ids');
        }
        let self = this;
        let filtered = {};
        ids.forEach(function(id) {
            let dome = self.findDome(id);
            if (isField && dome[filter] !== value) {
                return;
            }
            filtered[id] = dome;
        });

        return filtered;
    },
    /**
     * @param {?string} filter
     * @param {?any} value
     * @return {Object<number, any>}
     */
    filteredLands(filter = null, value = null) {
        let ids = this.isMaster() ?
            Object.keys(this.lands) : Array.from(this.visibleLandIds);
        if (!filter) {
            switch (this.mainTab) {
                case 'MainBoard':
                    filter = 'all'
                    break;
                case 'MainDome':
                    filter = 'domes';
                    break;
                case 'MainScene':
                    filter = 'all';
                    break;
                default:
                    console.error('Unknown main tab!', this.mainTab);
                    throw new Error('Unknown main tab!');
            }
        }
        let isField = filter[0] === '.';
        if (isField) {
            filter = filter.slice(1);
            value = value ? value : this.activeInfo.id;
        }
        if (!isField && filter !== 'all') {
            ids = this._sourceFilter(ids, filter, 'land_ids');
        }
        let self = this;
        let filtered = {};
        ids.forEach(function(id) {
            let land = self.findLand(id);
            if (isField && land[filter] !== value) {
                return;
            }
            filtered[id] = land;
        });

        return filtered;
    },
    /**
     * @param {?string} filter
     * @param {?any} value
     * @return {Object<number, any>}
     */
    filteredAreas(filter = null, value = null) {
        let ids = this.isMaster() ?
            Object.keys(this.areas) : Array.from(this.visibleAreaIds);
        if (!filter) {
            switch (this.mainTab) {
                case 'MainBoard':
                    filter = 'all'
                    break;
                case 'MainDome':
                    filter = 'domes';
                    break;
                case 'MainScene':
                    filter = 'all';
                    break;
                default:
                    console.error('Unknown main tab!', this.mainTab);
                    throw new Error('Unknown main tab!');
            }
        }
        let isField = filter[0] === '.';
        if (isField) {
            filter = filter.slice(1);
            value = value ? value : this.activeInfo.id;
        }
        if (!isField && filter !== 'all') {
            ids = this._sourceFilter(ids, filter, 'area_ids');
        }
        let self = this;
        let filtered = {};
        ids.forEach(function(id) {
            let area = self.findArea(id);
            if (isField && area[filter] !== value) {
                return;
            }
            filtered[id] = area;
        });

        return filtered;
    },
    /**
     * @param {?string} filter
     * @param {?any} value
     * @return {Object<number, any>}
     */
    filteredScenes(filter = null, value = null) {
        let ids = this.isMaster() ?
            Object.keys(this.scenes) : Array.from(this.visibleSceneIds);
        if (!filter) {
            switch (this.mainTab) {
                case 'MainBoard':
                    filter = 'all';
                    break;
                case 'MainDome':
                    filter = 'domes';
                    break;
                case 'MainScene':
                    filter = 'all';
                    break;
                default:
                    console.error('Unknown main tab!', this.mainTab);
                    throw new Error('Unknown main tab!');
            }
        }
        let isField = filter[0] === '.';
        if (isField) {
            filter = filter.slice(1);
            value = value ? value : this.activeInfo.id;
        }
        if (!isField && filter !== 'all') {
            ids = this._sourceFilter(ids, filter, 'scene_ids');
        }
        let self = this;
        let filtered = {};
        ids.forEach(function(id) {
            let scene = self.findScene(id);
            if (isField && scene[filter] !== value) {
                return;
            }
            filtered[id] = scene;
        });

        return filtered;
    },
    /**
     * @param {?string} filter
     * @param {?any} value
     * @return {Object<number, any>}
     */
    filteredDecks(filter = null, value = null) {
        let ids = this.isMaster() ?
            Object.keys(this.decks) : Array.from(this.visibleDeckIds);
        if (!filter) {
            switch (this.mainTab) {
                case 'MainBoard':
                    filter = 'all';
                    break;
                case 'MainDome':
                    filter = 'domes';
                    break;
                case 'MainScene':
                    filter = 'scenes';
                    break;
                default:
                    console.error('Unknown main tab!', this.mainTab);
                    throw new Error('Unknown main tab!');
            }
        }
        let isField = filter[0] === '.';
        if (isField) {
            filter = filter.slice(1);
            value = value ? value : this.activeInfo.id;
        }
        if (!isField && filter !== 'all') {
            ids = this._sourceFilter(ids, filter, 'deck_ids');
        }
        let self = this;
        let filtered = {};
        ids.forEach(function(id) {
            let deck = self.findDeck(id);
            // apply fields filter:
            if (isField && deck[filter] !== value) {
                    return;
            }
            let scope = self.findCard(deck.scope_id);
            let target = self.findCard(deck.target_id);
            filtered[id] = {
                id: deck.id,
                type: self._deckType(deck.type),
                scope: self._toLocale(scope.name),
                target: self._toLocale(target.name)
            }
        });

        return filtered;
    },
    /**
     * @param {?string} filter
     * @param {?any} value
     * @return {Object<number, any>}
     */
    filteredCards(filter = null, value = null) {
        let ids = this.isMaster() ?
            Object.keys(this.cards) : Array.from(this.visibleCardIds);
        if (!filter) {
            switch (this.mainTab) {
                case 'MainBoard':
                    filter = 'all';
                    break;
                case 'MainDome':
                    filter = 'domes';
                    break;
                case 'MainScene':
                    filter = 'scenes';
                    break;
                default:
                    console.error('Unknown main tab!', this.mainTab);
                    throw new Error('Unknown main tab!');
            }
        }
        let isField = filter[0] === '.';
        if (isField) {
            filter = filter.slice(1);
            value = value ? value : this.activeInfo.id;
        }
        if (!isField && filter !== 'all') {
            ids = this._sourceFilter(ids, filter, 'card_ids');
        }
        let self = this;
        let filtered = {};
        ids.forEach(function(id) {
            let card = self.findCard(id);
            // apply fields filter:
            if (isField && card[filter] !== value) {
                return;
            }
            filtered[id] = card;
        });

        return filtered;
    },
    /**
     * @param {boolean} enable
     */
    previewFog(enable = true) {
        let fog = this._fog();
        if (!fog) {
            return;
        }
        fog.preview(enable);
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
    setActiveObject(o = null) {
        if (!o) {
            this.activeObject = null;
            this.activeObjectHidden = null;
            this.activeObjectType = null;
            if (this.fb()) {
                this.fb().discardActiveObject();
            }
        } else {
            this.activeObject = o;
            this.activeObjectHidden = o.get('opacity') < 1;
            this.activeObjectType = o.type;
            this.fb().setActiveObject(o);
        }
        // console.debug('Active Object', o, {
        //     hidden: this.activeObjectHidden,
        //     type: this.activeObjectType
        // });

        return this;
    },
    selectBook(event) {
        this.selectedId = null;
        this.fb().discardActiveObject();
        this.showBook(event.target.value);
    },
    selectDome(event) {
        this.selectedId = null;
        this.fb().discardActiveObject();
        this.showDome(event.target.value);
    },
    selectLand(event) {
        this.selectedId = null;
        this.fb().discardActiveObject();
        this.showLand(event.target.value);
    },
    selectArea(event) {
        this.selectedId = null;
        this.fb().discardActiveObject();
        this.showArea(event.target.value);
    },
    selectScene(event) {
        this.selectedId = null;
        this.fb().discardActiveObject();
        this.showScene(event.target.value);
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
        this.showCard(event.target.value);
    },
    switchCard(id) {
        this.setActiveObject();
        this.showCard(id);
    },
    findCard(id, required = true) {
        if (!this.cards[id]) {
            if (required) {
                throw new Error('Card not found: ' + id);
            } else {
                return null;
            }
        }
        return toRaw(this.cards[id]);
    },
    findScene(id) {
        if (!this.scenes[id]) {
            throw new Error('Scene not found: ' + id);
        }
        return toRaw(this.scenes[id]);
    },
    findArea(id) {
        if (!this.areas[id]) {
            throw new Error('Area not found: ' + id);
        }
        return toRaw(this.areas[id]);
    },
    findLand(id) {
        if (!this.lands[id]) {
            throw new Error('Land not found: ' + id);
        }
        return toRaw(this.lands[id]);
    },
    findDome(id) {
        if (!this.domes[id]) {
            throw new Error('Dome not found: ' + id);
        }
        return toRaw(this.domes[id]);
    },
    findBook(id) {
        if (!this.books[id]) {
            throw new Error('Book not found: ' + id);
        }
        return toRaw(this.books[id]);
    },
    findDeck(id) {
        if (!this.decks[id]) {
            throw new Error('Deck not found: ' + id);
        }
        return toRaw(this.decks[id]);
    },
    trans(string) {
        return this.dictionary[string] ?
            this.dictionary[string] : string;
    },
    visible(type, id = null) {
        if (game.isMaster()) {
            return true;
        }
        let visibleField = this._visibleField(type);
        id = id ? id : this.activeInfo.id;
        return this[visibleField].includes(Number(id));
    },
    /**
     * @return {HTMLCollectionOf<HTMLCanvasElement>}
     * @private
     */
    _canvases() {
        return document.getElementsByTagName('canvas');
    },
    _selection(event = null) {
        if (!event) {
            this.setActiveObject();
            this.showAside();
            return;
        }
        // prevent for areas:
        let o = event.selected[0];
        if (o && o.type === 'area') {
            return;
        }
        this.setActiveObject(o);
        this.showAside(o);
    },
    _center() {
        let port = this.fb().calcViewportBoundaries();
        return {
            x: parseInt(port.tl.x + (port.br.x - port.tl.x)/2),
            y: parseInt(port.tl.y + (port.br.y - port.tl.y)/2)
        }
    },
    _cursor(opt = null) {
        if (!opt || !opt.target) {
            this.cursorName = null;
            this.cursorScope = null;
            return;
        }
        let o = opt.target;
        let card = null;
        let scopeCard = null;
        switch (o.type) {
            case 'card':
                if (!o.get('opened') && !this.isMaster()) {
                    this.cursorName = '???';
                    this.cursorScope = '???';
                    return;
                }
                card = this.findCard(o.get('card_id'));
                scopeCard = this.findCard(card.scope_id, false);
                this.cursorName = this._toLocale(card.currentName);
                this.cursorScope = scopeCard ? this._toLocale(scopeCard.currentName) : null;
                break;
            case 'marker':
                card = this.findCard(o.get('marker_id'));
                scopeCard = this.findCard(card.scope_id, false);
                this.cursorName = this._toLocale(card.currentName);
                this.cursorScope = scopeCard ? this._toLocale(scopeCard.currentName) : null;
                break;
            case 'book':
                let book = this.books[o.get('book_id')];
                this.cursorName = this._toLocale(book.currentName);
                this.cursorScope = this.trans('Book');
                break;
            case 'dome':
                let dome = this.domes[o.get('dome_id')];
                card = this.cards[dome.scope_id];
                this.cursorName = this._toLocale(card.currentName);
                this.cursorScope = this.trans('Dome');
                break;
            case 'area':
                // find correct area for cursor by polygon
                o = this._findArea(o, opt.absolutePointer);
                if (!o) {
                    this.cursorName = null;
                    this.cursorScope = null;
                    break;
                }
                o.set('cursor', 'pointer');
                let area = this.areas[o.get('area_id')];
                card = this.cards[area.scope_id];
                this.cursorName = this._toLocale(card.currentName);
                this.cursorScope = this.trans('Area');
                break;
            default:
                console.error('Unknown object for cursor!', o);
        }
    },
    _findArea(o, point) {
        if (o.onArea(point)) {
            if (!this.isMaster() && !this.visibleAreaIds.includes(Number(o.area_id))) {
                o.set('cursor', 'default');
                return null;
            }
            o.set('cursor', 'pointer');
            this.fb().requestRenderAll();
            return o;
        }
        let found = false;
        this.fb().getObjects('area').forEach(function(a) {
            if (Number(a.area_id) !== Number(o.area_id) && a.onArea(point)) {
                found = a;
            }
        });
        if (!found) {
            o.set('cursor', 'default');
            return null;
        } else {
            if (!this.isMaster() && !this.visibleAreaIds.includes(Number(found.area_id))) {
                found.set('cursor', 'default');
                return null;
            }
            found.set('cursor', 'pointer');
            this.fb().requestRenderAll();
            return found;
        }
    },
    /**
     * @returns {?fabric.Fog}
     */
    _fog() {
        return this.fb().getObjects('fog')[0];
    },
    /**
     * @param {?string} skip
     * @private
     */
    _offModes(skip = null) {
        let modes = ['Erase', 'EraseUndo', 'Transform'];
        modes = modes.filter(function(mode) {
            return mode !== skip;
        });
        let self = this;
        modes.forEach(function(mode) {
           let modeFlag = 'mode' + mode;
           let modeSwitcher = 'switch' + mode;
           if (self[modeFlag]) {
               self[modeSwitcher]();
           }
        });
        this._cursor();
    },
    /**
     * @param {Array} ids
     * @param {Object<string, number>|string} filter
     * @param {string} idsField
     * @return {Array}
     * @private
     */
    _sourceFilter(ids, filter, idsField) {
        if (typeof filter === 'string') {
            let temp = {}
            temp[filter] = this.activeInfo.id;
            filter = temp;
        }
        // console.log('Filtering...', filter, idsField);
        let filteredIds = [];
        for (let source in filter) {
            if (!this[source]) {
                throw new Error('Unknown filter source: ' + source);
            }
            let id = filter[source];
            let entity = this[source][id];
            if (!entity) {
                throw new Error('Filter entity not found!');
            }
            let entityIds = entity[idsField];
            if (!entityIds) {
                filteredIds = [];
            } else {
                ids.forEach(function(id) {
                    if (entityIds.includes(Number(id))) {
                        filteredIds.push(Number(id));
                    }
                });
            }
            ids = filteredIds;
        }
        // console.debug('Filtering result', ids);
        return ids;
    },
    _deckType(number) {
        let labels = ['Stack','Set','State','Control'];


        return this.trans(labels[number]);
    },
    /**
     * @param {string} type
     * @param {number} id
     * @param {boolean} show
     * @private
     */
    _visibility(type, id, show) {
        id = Number(id);
        console.debug('Set visibility', type, id, show);
        let idsField = this._visibleField(type);
        if (show) {
            if (!this[idsField].includes(id)) {
                this[idsField].push(id);
            }
        } else {
            let index = this[idsField].indexOf(id);
            if (index !== -1) {
                this[idsField].splice(index, 1);
            }
        }
    },
    _visibleField(type) {
        return 'visible' + type.charAt(0).toUpperCase() + type.slice(1) + 'Ids';
    },
    _data() {
        let fields = [
            'id', 'info', 'activeDomeId', 'activeSceneId', 'activeAreaId',
            'visibleDomeIds', 'visibleLandIds', 'visibleAreaIds', 'visibleSceneIds',
            'visibleBookIds', 'visibleDeckIds', 'visibleCardIds'
        ];
        let data = {};
        let self = this;
        fields.forEach(function(field) {
            data[field] = toRaw(self[field]);
        });

        return data;
    },
    /**
     * @param {string} type
     * @param {Object.<string, any>} entity
     * @param {?string[]} fields
     * @private
     */
    _update(type, entity, fields = null) {
        fields = fields ? fields : ['currentName', 'currentDesc'];
        let request = this._updateRequest[type] ? this._updateRequest[type]: {};
        let data = {};
        fields.forEach(function(field) {
            data[field] = entity[field];
        });
        request[entity.id] = data;
        this._updateRequest[type] = request;
        let source = type + 's';
        this[source][entity.id] = entity;
        console.debug('Added to update', this._updateRequest);
    },
    _prepareUpdateRequest(request) {
        let self = this;
        if (Object.keys(self._updateRequest).length) {
            Object.keys(self._updateRequest).forEach(function(process) {
                if (request[process]) {
                    Object.keys(self._updateRequest[process]).forEach(function(id) {
                        if (request[process][id]) {
                            Object.keys(self._updateRequest[process][id]).forEach(function(field) {
                                request[process][id][field] = self._updateRequest[process][id][field];
                            });
                        } else {
                            request[process][id] = self._updateRequest[process][id];
                        }
                    });
                } else {
                    request[process] = self._updateRequest[process];
                }
            });
        }
        return request;
    },
    /**
     *
     * @param {?Object.<string, string>} data
     * @return {?string}
     * @private
     */
    _toLocale(data) {
        if (!data) {
            return null;
        }
        if (!data[this.locale]) {
            if (data[this.fallbackLocale]) {
                return data[this.fallbackLocale];
            } else {
                return null;
            }
        } else {
            return data[this.locale];
        }
    },
});
