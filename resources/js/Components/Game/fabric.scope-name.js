import { fabric } from 'fabric-with-erasing';

fabric.ScopeName = fabric.util.createClass(fabric.Text, {
    type: 'scopeName',
});

fabric.ScopeName.fromObject = function(object, callback) {
    fabric.Object._fromObject('ScopeName', object, callback);
}
