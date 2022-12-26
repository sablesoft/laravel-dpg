import { fabric } from 'fabric-with-erasing';

fabric.Name = fabric.util.createClass(fabric.Text, {
    type: 'name',
});

/**
 * Returns fabric.Text instance from an object representation
 * @static
 * @memberOf fabric.Name
 * @param {Object} object plain js Object to create an instance from
 * @param {Function} [callback] Callback to invoke when an fabric.Text instance is created
 */
fabric.Name.fromObject = function(object, callback) {
    let objectCopy = fabric.util.object.clone(object), path = object.path;
    delete objectCopy.path;
    return fabric.Object._fromObject('Name', objectCopy, function(textInstance) {
        if (path) {
            fabric.Object._fromObject('Path', path, function(pathInstance) {
                textInstance.set('path', pathInstance);
                callback(textInstance);
            }, 'path');
        }
        else {
            callback(textInstance);
        }
    }, 'text');
};
