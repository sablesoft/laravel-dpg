import { fabric } from 'fabric-with-erasing';
import './fabric.custom';
import './fabric.scope-name';
import { game } from "@/Components/Game/js/game";

fabric.Book = fabric.util.createClass(fabric.Group, {

    type: 'book',
    defaultDepth: 8,
    defaultWidth: 90,
    defaultRatio: 1.4,
    strokeWidth: 20,
    imageScale: 0.3,
    imageHeight: 75,
    textLine: 30,
    defaultShowOpacity: 0.7,

    /**
     * @param {number} id
     * @param {Object.<string, any>} options
     */
    initialize: function (id, options) {
        options = options || {};
        options.hasControls = false;
        options.hasBorders = false;
        options.hoverCursor = 'pointer';
        options.centeredRotation = true;
        options.lockRotation = true;
        options.erasable = false;
        options.depth = options.depth || this.defaultDepth;
        options.width = options.width || this.defaultWidth;
        options.ratio = options.ratio || this.defaultRatio;
        options.height = options.height || options.width * options.ratio + options.depth;
        let book = id ? game.findBook(id) : game.findBook(options.book_id);

        options.image = options.image || book.image;
        options.width = id ? options.width + options.depth : options.width;
        options.book_id = options.book_id || book.id;
        options.showOpacity = options.showOpacity || this.defaultShowOpacity;
        options.show = options.show === undefined ? false : options.show;
        options.scopeName = options.scopeName || game.trans('Book');

        options.lockMovementX = !game.isMaster();
        options.lockMovementY = !game.isMaster();

        this.callSuper('initialize', [], options);

        this.visibility(this.show);

        if (!id) {
            return;
        }

        this.add(new fabric.Polygon([
            { x: 0, y: 0 },
            { x: options.width - options.depth - 3, y: 0 },
            { x: options.width - 3, y: options.depth },
            { x: options.width - 3, y: options.height },
            { x: options.depth - 3, y: options.height },
            { x: 0, y: options.height - options.depth }
        ], {
            originX: 'center',
            originY: 'center',
            left: 0,
            top: 0,
            width: options.width,
            height: options.height,
            fill: '#1f1c1c',
            strokeWidth: this.strokeWidth,
            strokeLineJoin : 'round',
            stroke: '#1f1c1c'
        }));

        let self = this;
        fabric.Back.fromURL(game.cardsBack, function(back) {
            back.set('originX', 'center');
            back.set('originY', 'center');
            back.set('left', -options.depth + 1);
            back.set('top', -options.depth + 2);
            self.add(back);
            self.add(new fabric.Rect({
                originY: 'center',
                optionX: 'left',
                top: 0,
                left: options.width/2 - options.depth,
                width: options.depth + self.strokeWidth/2,
                height: self.imageHeight + self.textLine,
                fill: '#5f6565',
                strokeWidth: 0,
                skewY: 45
            }));
            let front = new fabric.Rect({
                originY: 'center',
                originX: 'center',
                top: -options.depth,
                left: -options.depth,
                fill: 'white',
                strokeWidth: 0,
                width: options.width + 3,
                height: self.imageHeight + self.textLine + 3
            });
            self.add(front);
            if (options.image) {
                fabric.Image.fromURL(options.image, function(image) {
                    image.scale(self.imageScale);
                    image.set('originX', 'center');
                    image.set('originY', 'center');
                    image.set('top', -self.textLine + options.depth);
                    image.set('left', -options.depth);
                    self.add(image);
                });
            }
            if (options.scopeName) {
                self.add(new fabric.ScopeName(options.scopeName, {
                    originX: 'center',
                    originY: 'center',
                    top: (self.imageHeight + options.depth - self.textLine)/2,
                    left: -options.depth,
                    fontSize: 12,
                    fontWeight: 'bold',
                    fill: 'black',
                }));
            }
        });
    },
    update() {
        // console.debug('Book update', this);
        let book = game.findBook(this.get('book_id'));
        // update back image:
        this._item('back').setSrc(game.cardsBack, function(img) {
            if (img.canvas) {
                img.canvas.requestRenderAll();
            }
        });
        // update image:
        let image = this._item('image', false);
        if (image) {
            image.setSrc(book.image, function(img) {
                if (img.canvas) {
                    img.canvas.requestRenderAll();
                }
            });
        }
        // update scope name:
        this._item('scopeName').set('text', game.trans('Book'))
        if (this.canvas) {
            this.canvas.requestRenderAll();
        }

        return this;
    },
    toObject: function() {
        return fabric.util.object.extend(this.callSuper('toObject'), {
            show: this.get('show'),
            book_id: this.get('book_id'),
            ratio: this.get('ratio'),
            depth: this.get('depth'),
            image: this.get('image'),
            back_image: this.get('back_image'),
        });
    },
    _render: function(ctx) {
        this.callSuper('_render', ctx);
    }
});

fabric.Book.fromObject = function(object, callback) {
    let objects = object.objects || [],
        options = fabric.util.object.clone(object, true);
    delete options.objects;
    let bookObject = new fabric.Book(undefined, options);
    fabric.util.enlivenObjects(objects,function(fO) {
        fO.forEach(function(o) {
            bookObject.add(o);
        });
    });
    callback(bookObject);

    return bookObject;
}
