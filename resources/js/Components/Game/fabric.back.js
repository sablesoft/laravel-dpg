import { fabric } from 'fabric-with-erasing';

fabric.Back = fabric.util.createClass(fabric.Image, {
    type: 'back',
});

/**
 * Creates an instance of fabric.Image from an URL string
 * @static
 */
fabric.Back.fromURL = function(url, callback) {
    fabric.util.loadImage(url, function(img) {
        let o = new fabric.Back(img);
        return callback ? callback(o) : o;
    });
}

fabric.Back.fromObject = function(object, callback) {
    fabric.Object._fromObject('Back', object, callback);
}
