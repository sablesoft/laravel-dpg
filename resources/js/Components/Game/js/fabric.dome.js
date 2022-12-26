import { fabric } from 'fabric-with-erasing';
import './fabric.custom';
import './fabric.book';
import {game} from "@/Components/Game/js/game";

fabric.Dome = fabric.util.createClass(fabric.Book, {
    type: 'dome',

    /**
     * @param {number} id
     * @param {Object.<string, any>} options
     */
    initialize: function (id, options) {
        options = options || {};
        let dome = id ? game.findDome(id) : game.findDome(options.dome_id);
        options.image = game.findCard(dome.scope_id).image;
        options.scopeName = options.scopeName || game.trans('Dome');
        this.callSuper('initialize', id, options);
        this.dome_id = options.dome_id || dome.id;
    },
    update() {
        // console.debug('Dome update', this);
        let dome = game.findDome(this.get('dome_id'));
        // update back image:
        this._item('back').setSrc(game.cardsBack, function(img) {
            if (img.canvas) {
                img.canvas.requestRenderAll();
            }
        });
        // update image:
        let image = this._item('image', false);
        if (image) {
            image.setSrc(game.findCard(dome.scope_id).image, function(img) {
                if (img.canvas) {
                    img.canvas.requestRenderAll();
                }
            });
        }
        // update scope name:
        this._item('scopeName').set('text', game.trans('Dome'))
        if (this.canvas) {
            this.canvas.requestRenderAll();
        }

        return this;
    },
    toObject: function() {
        return fabric.util.object.extend(this.callSuper('toObject'), {
            dome_id: this.get('dome_id'),
        });
    },
});

fabric.Dome.fromObject = function(object, callback) {
    let objects = object.objects || [],
        options = fabric.util.object.clone(object, true);
    delete options.objects;
    let domeObject = new fabric.Dome(undefined, options);
    fabric.util.enlivenObjects(objects,function(fO) {
        fO.forEach(function(o) {
            domeObject.add(o);
        });
    });
    callback(domeObject);

    return domeObject;
}
