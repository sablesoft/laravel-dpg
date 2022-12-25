import { fabric } from 'fabric-with-erasing';
import './fabric.book';

fabric.Dome = fabric.util.createClass(fabric.Book, {
    type: 'dome',

    /**
     * @param {Dome} model
     * @param {Object.<string, any>} options
     */
    initialize: function (model, options) {
        this.callSuper('initialize', model, options);
        this.dome_id = options.dome_id || model.id;
    },

    toObject: function() {
        let result = fabric.util.object.extend(this.callSuper('toObject'), {
            dome_id: this.get('dome_id'),
        });
        console.debug('Dome to object', result);

        return result;
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
