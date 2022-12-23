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
        options.erasable = false;
        options.hoverCursor = 'pointer';
        options.left = options.left || model.left;
        options.top = options.top || model.top;
        options.area_id = options.area_id || model.id;
        options.card_id = options.card_id || model.scope_id;
        if (!options.width || !options.height) {
            throw new Error('Area width and height required for fb object!');
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
        });
    },

    toObject: function() {
        return fabric.util.object.extend(this.callSuper('toObject'), {
            area_id: this.get('area_id'),
            card_id: this.get('card_id'),
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
