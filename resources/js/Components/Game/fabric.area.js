import { fabric } from 'fabric-with-erasing';

fabric.Area = fabric.util.createClass(fabric.Group, {

    type: 'area',
    isSelected: false,
    defaultFogColor: '#ffffff',

    /**
     * @param {GameArea} model
     * @param {?Object.<string, any>} options
     */
    initialize: function(model, options) {
        options || (options = {});
        options.hasControls = false;
        options.hasBorders = false;
        options.lockMovementX = true;
        options.lockMovementY = true;
        options.lockScalingX = true;
        options.lockScalingY = true;
        options.lockRotation = true;
        options.erasable = 'deep';
        options.hoverCursor = 'pointer';
        options.left = options.left || model.left;
        options.top = options.top || model.top;
        options.area_id = options.area_id || model.id;
        options.card_id = options.card_id || model.scope_id;
        options.fogOpacity = options.fogOpacity || 1;
        options.fogColor = options.fogColor || options.defaultFogColor;
        if (!options.width || !options.height) {
            throw new Error('Area width and height required for fabric object!');
        }
        options.width = parseInt(options.width);
        options.height = parseInt(options.height);

        this.callSuper('initialize', [], options);

        if (!model) {
            return;
        }

        let self = this;
        fabric.Image.fromURL(model.image, function(image) {
            image.set('originX', 'center');
            image.set('originY', 'center');
            image.set('erasable', false);
            self.add(image);
            image.sendBackwards();
            const name = new fabric.Text(model.name, {
                originX: 'center',
                originY: 'center',
                fontSize: 36,
                fontWeight: 'bold',
                opacity: 0.7,
                fill: 'black',
                erasable: false,
            });
            self.add(name);
            name.bringToFront();
            self.showName(false);
            if (self.mask) {
                let pair = [];
                let tail = Array.from(self.mask);
                let points = [];
                while (tail.length) {
                    pair = tail.splice(0, 2);
                    points.push({x: pair[0] - self.width/2, y: pair[1] - self.height/2});
                }
                let fog = new fabric.Polygon(points, {
                    opacity: self.fogOpacity,
                    fill: self.fogColor,
                    stroke: self.fogColor,
                    strokeWidth: 3,
                    erasable: true,
                });
                self.add(fog);
            }
        });
    },

    showName: function(show = true) {
        let self = this;
        if (self.isSelected) {
            show = false;
        }
        this.forEachObject(function(item) {
            if (item.type === 'text') {
                item.set('opacity', show ? 0.7 : 0);
                if (self.canvas) {
                    self.canvas.requestRenderAll();
                }
            }
        });
    },

    selected: function(selected = true) {
        this.isSelected = selected;
        this.showName(false);
    },

    toObject: function() {
        return fabric.util.object.extend(this.callSuper('toObject'), {
            area_id: this.get('area_id'),
            card_id: this.get('card_id'),
            fogOpacity: this.get('fogOpacity'),
            fogColor: this.get('fogColor'),
            mask: this.get('mask'),
        });
    },

    _render: function(ctx) {
        this.callSuper('_render', ctx);
    }
});

fabric.Area.fromObject = function(object, callback) {
    let objects = object.objects || [],
        options = fabric.util.object.clone(object, true);
    delete options.objects;
    let areaObject = new fabric.Area(undefined, options);
    fabric.util.enlivenObjects(objects,function(fO) {
        fO.forEach(function(o) {
           areaObject.add(o);
        });
    });
    callback(areaObject);

    return areaObject;
}
