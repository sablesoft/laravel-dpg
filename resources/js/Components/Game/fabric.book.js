import { fabric } from 'fabric-with-erasing';

fabric.Book = fabric.util.createClass(fabric.Group, {

    type: 'book',
    defaultDepth: 8,
    defaultWidth: 90,
    defaultRatio: 1.4,
    strokeWidth: 20,
    imageScale: 0.3,
    imageHeight: 75,
    textLine: 30,

    /**
     * @param {Book} model
     * @param {Object.<string, any>} options
     */
    initialize: function (model, options) {
        options.hasControls = false;
        options.hasBorders = false;
        options.hoverCursor = 'pointer';
        options.centeredRotation = true;
        options.lockScalingX = true;
        options.lockScalingY = true;
        options.lockRotation = true;
        options.erasable = false;
        options.depth = options.depth || this.defaultDepth;
        options.width = options.width || this.defaultWidth;
        options.ratio = options.ratio || this.defaultRatio;
        options.height = options.width * options.ratio + options.depth;
        options.width = options.width + options.depth;
        options.image = options.image || model.image;
        options.book_id = options.book_id || model.id;
        if (!options.back_image) {
            throw new Error('Back image required for book canvas object');
        }
        this.callSuper('initialize', [], options);

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
        fabric.Image.fromURL(options.back_image, function(back) {
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
                self.add(new fabric.Text(options.scopeName, {
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

    toObject: function() {
        return fabric.util.object.extend(this.callSuper('toObject'), {
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
