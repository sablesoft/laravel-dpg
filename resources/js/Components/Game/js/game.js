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
 * @property {number} customerId
 * @property {string} customerName
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
 * @typedef {Object} JournalNewNote
 * @property {?number} id
 * @property {?string} code
 * @property {?string} type
 * @property {?Object.<string, string>} name
 * @property {?Object.<string, string>} desc
 * @property {?number} author_id
 */

/**
 * @typedef {Object} EditNote
 * @property {?number} index
 * @property {?string} name
 * @property {?string} desc
 */

/**
 * @typedef {Object} JournalNote
 * @property {?number} id
 * @property {?string} code
 * @property {?string} type
 * @property {?Object.<string, string>} name
 * @property {?Object.<string, string>} desc
 * @property {?number} author_id
 * @property {?number} created_at
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
    played_ids: [],
    customerId: null,
    customerName: null,
    /**
     * @member {?string} - the code of the role to which the turn belongs (master or player)
     */
    turn: null,
    cursorName: null,
    cursorScope: null,
    activeCardTapped: false,
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
     * @member {?JournalNote|EditNote}
     */
    activeNote: {
        index: null,
        name: null,
        desc: null,
    },
    /**
     * @member {?JournalNote}
     */
    journalFilter: {
        id: null,
        code: null,
        type: null,
        name: null,
        desc: null,
        author_id: null,
        created_at: null,
    },
    journalSortField: 'created_at',
    journalSortDirection: 'desc',
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
    fbMainBoard: null,
    /**
     * @member {?fabric.Canvas}
     */
    fbMainDome: null,
    /**
     * @member {?fabric.Canvas}
     */
    fbMainScene: null,
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
    hideOpacity: 0.5,
    brushWidth: 50,
    initiated: false,
    /**
     * @member {JournalNote[]|JournalNewNote[]}
     */
    journal: [],
    _updateRequest: {},
    _spaceTypes: ['dome', 'land', 'area', 'scene'],
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
        this.customerId = options.customerId;
        this.customerName = options.customerName;
        this.locale = options.locale;
        this.dictionary = options.dictionary;
        this.showInfo();
        this.initiated = true;

        console.debug('Game initiated', toRaw(this));
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
                if (self.activeObject && self.activeObject.type === 'marker') {
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
            // console.debug('mouse:down', opt);
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
        fc && fc.getObjects().forEach(function(o) {
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
    isExpert() {
        return this.role === 'expert';
    },
    canTakeTurn() {
        if (this.role !== this.turn) {
            return false;
        }
        if (this.role === 'player' && this.played_ids.includes(this.customerId)) {
            return false;
        }
        // todo - check new turn action in journal, if not - return false
        return true;
    },
    takeTurn() {
        this.save();
        switch (this.role) {
            case 'master':
                this.role = 'expert';
                break;
            case 'player':
                this.role = 'spectator';
                this.played_ids.push(this.customerId);
                break;
            default:
                throw new Error('Invalid role for end of turn: ' + this.role);
        }
        this.updateCanvas();
        this.showInfo();
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
        this._journalPush(activate ? 'activated' : 'deactivated', this.activeInfo.type, id);
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
        this.setActiveObject();
        let scopeCard = null;
        switch (this.mainTab) {
            case 'MainJournal':
            case 'MainNote':
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
                    scopeName: this.status()
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
    status() {
        if (this.turn === 'master') {
            return this.trans('Master Turn');
        }
        if (this.played_ids.includes(this.customerId)) {
            return this.trans('You already made your turn');
        } else {
            if (this.role !== 'player') {
                return this.trans('Players Turn');
            }
            return this.trans('You need to make your turn');
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
        this.setActiveObject();
        this.saveCanvas();
        this.mainTab = tab;
        this.showInfo();
        this.resetJournalFilter();
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
            o = null;
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
                    if (!o.get('opened') && !(this.isMaster() || this.isExpert())) {
                        return this.showInfo();
                    }
                    this.activeCardTapped = Boolean(o.get('tapped'));
                }
            case 'marker':
                return this.showCard(id);
            case 'dome':
                return this.showDome(id);
            case 'land':
                return this.showLand(id);
            case 'area':
                return this.showArea(id);
            case 'scene':
                return this.showScene(id);
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
        if (this.mainTab === 'MainBoard') {
            this.fb().getObjects('book').forEach(function(o) {
                if (o.get('book_id') === Number(id)) {
                    self.setActiveObject(o);
                }
            });
        }
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
        if (this.mainTab === 'MainBoard') {
            this.fb().getObjects('dome').forEach(function(o) {
                if (o.get('dome_id') === Number(id)) {
                    self.setActiveObject(o);
                }
            });
        }
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
            type: 'land',
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
            let opacity = show ? 1 : (this.isMaster() || this.isExpert() ? this.hideOpacity : 0);
            o.set('opacity', opacity);
            this.activeObjectHidden = opacity < 1;
            this.fb().renderAll();
        }
        let allTypes = ['marker', 'card', 'dome', 'area', 'book'];
        if (!allTypes.includes(o.type)) {
            console.error('Unknown object for visibility: ', o);
        }
        let id = o.get(o.type + '_id');
        this._visibility(o.type, id, show);
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
        if (!this.fb()) {
            return null;
        }
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
        this._offModes();
        let canvas = this.saveCanvas();
        let gameRequest = {};
        gameRequest[this.id] = this._data();
        let request = {
            game: gameRequest
        };
        if (this.isMaster()) {
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
                case 'MainJournal':
                    break;
                default:
                    throw new Error('Invalid main tab');
            }
        }
        let self = this;
        request = this._prepareTurnRequest(request);
        console.debug('Turn request', request);
        axios.patch('/game/' + this.customerId, request)
            .then(response => {
                let data = response.data;
                console.debug('Turn response', data);
                if (data.success) {
                    self._updateRequest = {};
                    self.journal = data.journal;
                    self.turn = data.turn;
                    if (self.turn === 'master') {
                        self.played_ids = [];
                    }
                } else {
                    console.error(data);
                }
                self.showInfo();
            }).catch(err => {
                console.error(err);
                self.showInfo();
            });
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
                this._journalPush('updated', 'game');
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
                this._journalPush('updated', 'book', this.activeInfo.id);
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
        this._journalPush('updated', 'card', card.id);
    },
    editNote(index) {
        let note = this.journal[index];
        this.activeNote = {
            index: index,
            name: this._toLocale(note.name),
            desc: this._toLocale(note.desc)
        };
        this.mainTab = 'MainNote';
    },
    updateNote() {
        let note = this.journal[this.activeNote.index];
        if (this.activeNote.name) {
            note.name[this.locale] = this.activeNote.name;
        }
        note.desc[this.locale] = this.activeNote.desc;
        this.journal[this.activeNote.index] = note;
        this.mainTab = 'MainJournal';
        this._journalNoteReset();
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
        let ids = this.isMaster() || this.isExpert() ?
            Object.keys(this.books) : Array.from(this.visibleBookIds);
        if (!filter) {
            switch (this.mainTab) {
                case 'MainDome':
                    filter = 'domes';
                    break;
                case 'MainScene':
                    filter = 'scenes';
                    break;
                default:
                    filter = 'all';
                    break;
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
        let ids = this.isMaster() || this.isExpert() ?
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
        let ids = this.isMaster() || this.isExpert() ?
            Object.keys(this.lands) : Array.from(this.visibleLandIds);
        if (!filter) {
            switch (this.mainTab) {
                case 'MainDome':
                    filter = 'domes';
                    break;
                default:
                    filter = 'all'
                    break;
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
        let ids = this.isMaster() || this.isExpert() ?
            Object.keys(this.areas) : Array.from(this.visibleAreaIds);
        if (!filter) {
            switch (this.mainTab) {
                case 'MainDome':
                    filter = 'domes';
                    break;
                default:
                    filter = 'all'
                    break;
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
        let ids = this.isMaster() || this.isExpert() ?
            Object.keys(this.scenes) : Array.from(this.visibleSceneIds);
        if (!filter) {
            switch (this.mainTab) {
                case 'MainDome':
                    filter = 'domes';
                    break;
                default:
                    filter = 'all';
                    break;
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
        let ids = this.isMaster() || this.isExpert() ?
            Object.keys(this.decks) : Array.from(this.visibleDeckIds);
        if (!filter) {
            switch (this.mainTab) {
                case 'MainDome':
                    filter = 'domes';
                    break;
                case 'MainScene':
                    filter = 'scenes';
                    break;
                default:
                    filter = 'all';
                    break;
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
        let ids = this.isMaster() || this.isExpert() ?
            Object.keys(this.cards) : Array.from(this.visibleCardIds);
        if (!filter) {
            switch (this.mainTab) {
                case 'MainDome':
                    filter = 'domes';
                    break;
                case 'MainScene':
                    filter = 'scenes';
                    break;
                default:
                    filter = 'all';
                    break;
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
    isActiveJournalFilter() {
        return this.journalFilter.id === this.activeInfo.id &&
            this.journalFilter.type === this.activeInfo.type;
    },
    getFilteredJournal(filter = null) {
        if (!filter) {
            filter = this.journalFilter;
        }
        filter = this._journalFilter(filter);
        let notes = this.journal.filter(function(note) {
            for(let field in filter) {
                if (filter[field] === '_empty') {
                    if (note[field]) {
                        return false;
                    }
                } else if (filter[field] === '_filled') {
                    if (!note[field]) {
                        return false;
                    }
                } else if (filter[field] && note[field] !== filter[field]) {
                    return false;
                }
            }
            return true;
        });

        return this._journalSort(notes);
    },
    getJournalFields() {
        return [{
            code: 'code',
            name: 'Code'
        }, {
            code: 'type',
            name: 'Type'
        }, {
            code: 'name',
            name: 'Title',
        }, {
            code: 'author_id',
            name: 'Author',
        }, {
            code: 'created_at',
            name: 'Created At'
        }]
    },
    getJournalValues(field) {
        return this.journal.map(function(note) { return note[field]})
                    .filter(function(value, index, self) {
                        return self.indexOf(value) === index;
                    });
    },
    /**
     * @param {Object|string} filter
     */
    showFilteredJournal(filter = {}) {
        this._journalNoteReset();
        if (!this.getFilteredJournal(filter)) {
            return;
        }
        filter = this._journalFilter(filter);
        let updatedFilter = this.journalFilter;
        for(let field in updatedFilter) {
            updatedFilter[field] = filter[field] ? filter[field] : null;
        }
        this.journalFilter = updatedFilter;
        let tab = 'MainJournal';
        if (this.mainTab === tab) {
            this.mainTab = 'MainBoard';
        } else {
            this._offModes();
            this.saveCanvas();
        }
        let self = this;
        setTimeout(function() {
            self.mainTab = tab;
            self.setActiveObject();
        }, 25);
    },
    updateJournalFilter() {
        this.journalFilter.id = null;
        this.showFilteredJournal(this.journalFilter);
    },
    resetJournalFilter() {
        this.journalFilter = {
            id: null,
            code: null,
            type: null,
            name: null,
            desc: null,
            author_id: null,
            created_at: null,
        };
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
            this.fb() && this.fb().discardActiveObject();
        } else {
            this.activeObject = o;
            this.activeObjectHidden = o.get('opacity') < 1;
            this.fb().setActiveObject(o);
        }

        return this;
    },
    selectBook(event) {
        this.selectedId = null;
        this.fb() && this.fb().discardActiveObject();
        this.showBook(event.target.value);
    },
    selectDome(event) {
        this.selectedId = null;
        this.fb() && this.fb().discardActiveObject();
        this.showDome(event.target.value);
    },
    selectLand(event) {
        this.selectedId = null;
        this.fb() && this.fb().discardActiveObject();
        this.showLand(event.target.value);
    },
    selectArea(event) {
        this.selectedId = null;
        this.fb() && this.fb().discardActiveObject();
        this.showArea(event.target.value);
    },
    selectScene(event) {
        this.selectedId = null;
        this.fb() && this.fb().discardActiveObject();
        this.showScene(event.target.value);
    },
    selectDeck(event) {
        this.selectedId = null;
        this.fb() && this.fb().discardActiveObject();
        let deck = this.decks[event.target.value];
        console.debug('Selected Deck', deck);
        // todo
    },
    selectCard(event) {
        this.selectedId = null;
        this.fb() && this.fb().discardActiveObject();
        this.showCard(event.target.value);
    },
    switchCard(id) {
        this.setActiveObject();
        this.showCard(id);
    },
    findCard(id, required = true) {
        return this.findData('card', id, required);
    },
    findScene(id, required = true) {
        return this.findData('scene', id, required);
    },
    findArea(id, required = true) {
        return this.findData('area', id, required);
    },
    findLand(id, required) {
        return this.findData('land', id, required);
    },
    findDome(id, required) {
        return this.findData('dome', id, required);
    },
    findBook(id, required) {
        return this.findData('book', id, required);
    },
    findDeck(id, required) {
        return this.findData('deck', id, required);
    },
    findData(type, id, required = true) {
        if (type === 'game') {
            return this.info;
        }
        if (type === 'marker') {
            type = 'card';
        }
        let field = type + 's';
        if (!this[field][id]) {
            if (required) {
                throw new Error('Data not found: ' + type + ', ' + id);
            } else {
                return null;
            }
        }
        return toRaw(this[field][id]);
    },
    trans(string) {
        string = this._upFirst(string);
        return this.dictionary[string] ?
            this.dictionary[string] : string;
    },
    visible(type, id = null) {
        if (this.isMaster() || this.isExpert()) {
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
                if (!o.get('opened') && !(this.isMaster() || this.isExpert())) {
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
            if (!(this.isMaster() || this.isExpert()) && !this.visibleAreaIds.includes(Number(o.area_id))) {
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
            if (!(this.isMaster() || this.isExpert()) && !this.visibleAreaIds.includes(Number(found.area_id))) {
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
        if (type === 'marker') {
            type = 'card';
        }
        let idsField = this._visibleField(type);
        if (show) {
            if (!this[idsField].includes(id)) {
                this[idsField].push(id);
                this._journalPush('opened', type, id);
            }
        } else {
            let index = this[idsField].indexOf(id);
            if (index > -1) {
                this[idsField].splice(index, 1);
                this._journalPull('opened', type, id);
            }
        }
        if (this._spaceTypes.includes(type)) {
            let data = this.findData(type, id);
            this._visibility('card', data.scope_id, show);
        }
    },
    _visibleField(type) {
        return 'visible' + this._upFirst(type) + 'Ids';
    },
    _journalPush(code, type, id) {
        switch (code) {
            case 'opened':
                if (this.getFilteredJournal({code: code, type: type, id: id}).length) {
                    return;
                }
                break;
            case 'activated':
                if (this._journalPull('deactivated', type, id) ||
                    this.getFilteredJournal({code: code, type: type, id: id, created_at: '_empty'}).length) {
                    return;
                }
                break;
            case 'deactivated':
                if (this._journalPull('activated', type, id) ||
                    this.getFilteredJournal({code: code, type: type, id: id, created_at: '_empty'}).length) {
                    return;
                }
                break;
            case 'updated':
                let presentNew = {code: code, type: type, id: id, created_at: '_empty'};
                let notOpenedOld = {code: 'opened', type: type, id: id, created_at: '_filled'};
                if (this.getFilteredJournal(presentNew).length || !this.getFilteredJournal(notOpenedOld).length) {
                    return;
                }
                break;
            default:
                break;
        }
        let data = this.findData(type, id);
        if (this._spaceTypes.includes(type)) {
            data = this.findData('card', data.scope_id)
        }
        this.journal.push({
            id : id,
            code: code,
            type: type,
            name: this._copyObject(data.currentName),
            desc: this._copyObject(data.currentDesc),
            author_id: 1,
        });
    },
    _journalPull(code, type, id) {
        let index = this.journal.findIndex(function(note) {
            return (note.code === code &&
                note.type === type &&
                note.id === id &&
                !note.created_at);
        });
        if (index > -1) {
            let pulled = this.journal.splice(index, 1);
            if (!this.journal.length && this.mainTab === 'MainJournal') {
                this.mainTab = 'MainBoard';
            }
            return pulled;
        } else {
            return null;
        }
    },
    _journalSort(notes = []) {
        if (!this.journalSortField || !this.journalSortDirection) {
            this._journalSortReset();
        }

        let field = this.journalSortField;
        let desc = (this.journalSortDirection === 'desc') ? -1 : 1;

        return notes.sort(function(a, b) {
            return a[field] > b[field] ? 1 * desc : -1 * desc;
        });
    },
    _journalSortReset() {
        this.journalSortField = 'created_at';
        this.journalSortDirection = 'desc';
    },
    _journalFilter(filter = null) {
        if (typeof filter === 'string') {
            switch (filter) {
                case 'active':
                    filter = {
                        id : this.activeInfo.id,
                        type : this.activeInfo.type
                    }
                    break;
                case 'all':
                    filter = {};
                    this.resetJournalFilter();
                    break;
                default:
                    throw new Error('Unknown journal filter code: ' + filter);
            }
        }
        return filter;
    },
    _journalNoteReset() {
        this.activeNote = {
            index: null,
            name: null,
            desc: null
        };
    },
    _upFirst(string) {
        return string.charAt(0).toUpperCase() + string.slice(1)
    },
    _data() {
        let fields = game.isMaster() ? [
            'id', 'info', 'activeDomeId', 'activeSceneId', 'activeAreaId',
            'visibleDomeIds', 'visibleLandIds', 'visibleAreaIds', 'visibleSceneIds',
            'visibleBookIds', 'visibleDeckIds', 'visibleCardIds'
        ] : ['id'];
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
    _prepareTurnRequest(request) {
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
        let journalUpdate = this.getFilteredJournal({created_at : '_empty'});
        if (journalUpdate.length) {
            request['journal'] = journalUpdate;
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
    /**
     * @param {any} data
     * @return {Object}
     * @private
     */
    _copyObject(data) {
        return (typeof data === 'object') ?
            JSON.parse(JSON.stringify(data)) :
            {}
    }
});
