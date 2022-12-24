import { fabric } from 'fabric-with-erasing';
import { game } from "@/Components/Game/game";

fabric.Marker = fabric.util.createClass(fabric.Group, {
    type: 'marker',
    defaultScale: 0.3,
    defaultShowOpacity: 0.5,
    isMaster: false,

    /**
     * @param {GameCard} model
     * @param {?Object.<string, any>} options
     */
    initialize: function(model, options) {
        options || (options = {});
        this.isMaster = game.isMaster();
        options.hasControls = false;
        options.hasBorders = false;
        options.lockScalingX = true;
        options.lockScalingY = true;
        options.lockRotation = true;
        options.erasable = false;
        options.hoverCursor = 'pointer';
        options.marker_id = options.marker_id || model.id;
        options.scope_id = options.scope_id || model.scope_id;
        options.imageScale = options.imageScale || this.defaultScale;
        options.showOpacity = options.showOpacity || this.defaultShowOpacity;
        options.show = options.show === undefined ? false : options.show;

        if (!this.isMaster) {
            options.lockMovementX = true;
            options.lockMovementY = true;
        }

        this.callSuper('initialize', [], options);

        this.visibility(this.show);

        if (!model) {
            return;
        }

        if (!model.scopeImage) {
            throw new Error('Required model scope image missed!');
        }

        let self = this;
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

    visibility: function(show = true) {
        this.show = show;
        if (show) {
            this.opacity = 1;
            this.visible = true;
        } else {
            if (this.isMaster) {
                this.opacity = this.showOpacity;
            } else {
                this.visible = false;
            }
        }
        if (this.canvas) {
            this.canvas.requestRenderAll();
        }
    },

    toObject: function() {
        return fabric.util.object.extend(this.callSuper('toObject'), {
            show: this.get('show'),
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
