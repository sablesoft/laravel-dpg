"use strict"

import { Cmd, parser } from "questjs-core";

// export default function () {
    new Cmd('Charge', {
        npcCmd:true,
        regex:/^(?:charge|power) (.+)$/,
        objects:[
            {scope: parser.isHeld}
        ],
        defmsg:"{sb:char} не способен зарядить {ob:item}",
    });
// }
