"use strict"

import { settings } from "questjs-core";

settings.title = "Quest 6 Testing"
settings.author = "Ziggy Shu"
settings.version = "0.1"
settings.thanks = []
settings.warnings = "No warnings have been set for this game."
settings.playMode = "dev"
settings.lang = "lang-en"
settings.files = ["code", "data"];
settings.iconsFolder = '/build/assets/icons/';
// settings.collapsibleSidePanes = true;

settings.mapShowNotVisited = false
settings.mapCellSize = 55
settings.mapScale = 60
// settings.mapLocationColour = 'black'
// settings.mapBorderColour = 'white'
// settings.mapExitColour = 'blue'
settings.mapExitWidth = 7
settings.mapStyle = {
    right:'10px',
    top:'10px',
    width:'400px',
    height:'400px',
    'background-color':'#ddd',
    'background-image':'url(assets/images/paper2.jpeg)',
    border:'3px black solid',
}
settings.mapDrawLabels = true
settings.mapLabelStyle = {'font-size':'6pt', 'font-weight':'bold'}
settings.mapLabelColour = 'blue'
settings.mapLabelOffset = -5
settings.mapLabelRotate = -20
settings.mapMarker = function(loc) {
    return map.polygon(loc, [
        [0,0], [-5,-25], [-7, -20], [-18, -45], [-20, -40], [-25, -42], [-10, -18], [-15, -20]
    ], 'stroke:none;fill:black;pointer-events:none;opacity:0.3')
}
settings.mapExtras = function() {
    const result = []
    const room = w[player.loc]
    result.push(map.polygon(room, [
        [150, 100],
        [147, 117],
        [130, 120],
        [147, 123],
        [150, 160],
        [153, 123],
        [170, 120],
        [153, 117],
    ], 'stroke:black;fill:yellow;'))
    result.push(map.text(room, 'N', [150, 95], 'fill:black;font-size:14pt'))
    return result
}
settings.mapClick = function(name) {
    console.log("Map clicked: " + name)
}

settings.maze_size = 5;
