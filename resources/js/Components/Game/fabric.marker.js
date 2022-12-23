import { fabric } from 'fabric-with-erasing';

fabric.Marker = fabric.util.createClass(fabric.Group, {
    type: 'marker',
    defaultScale: 0.3,

    /**
     * @param {GameCard} model
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
        options.marker_id = options.marker_id || model.id;
        options.scope_id = options.scope_id || model.scope_id;
        options.imageScale = options.imageScale || this.defaultScale;
        this.callSuper('initialize', [], options);

        let self = this;

        if (!model) {
            return;
        }
        if (!model.scopeImage) {
            throw new Error('Required model scope image missed!');
        }

        fabric.Image.fromURL(model.scopeImage, function(image) {
            image.set('originX', 'center');
            let scale = Number(self.get('imageScale'));
            let width = Number(image.get('width'));
            let height = Number(image.get('height'));
            self.set('width', width * scale);
            self.set('height', height * scale);
            image.scale(scale);
            self.add(image);
        });
    },

    unlockMovement() {
        this.set('lockMovementX', false);
        this.set('lockMovementY', false);
    },

    toObject: function() {
        return fabric.util.object.extend(this.callSuper('toObject'), {
            scope_id: this.get('scope_id'),
            marker_id: this.get('marker_id'),
            imageScale: this.get('imageScale')
        });
    },

    _render: function(ctx) {
        this.callSuper('_render', ctx);
    }
});

fabric.Marker.fromObject = function(object, callback) {
    let objects = object.objects || [],
        options = fabric.util.object.clone(object, true);
    delete options.objects;
    let markerObject = new fabric.Marker(undefined, options);
    fabric.util.enlivenObjects(objects,function(fO) {
        fO.forEach(function(o) {
            markerObject.add(o);
        });
    });
    callback(markerObject);

    return markerObject;
}
