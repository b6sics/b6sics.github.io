const size70 = ["Vákuumtasak 150*200*65 18Ft/db", "Vákuumtasak 150*400*65 24Ft/db", "Vákuumtasak 150*500*65 30Ft/db", "Vákuumtasak 160*200*65 13Ft/db", "Vákuumtasak 160*400*65 25Ft/db"];

function loadSizes70() {
    size70.forEach(makeOptions);
}


function makeOptions(item, index) {
    sizes.innerHTML += '<option value="' + item + '">' + item + '</option>';
}