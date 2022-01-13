let splitString = " ";
let firstOption = '<option value=" ? "> válassz! </option>';

/******************/
/* product groups */
/******************/

let productGroups = document.getElementById('productGroups');

const productGroupArray = [];

function addProductGroupOption(item) {
    productGroups.innerHTML += item.option;
}

function setProductGroupsOptions() {
    productGroups.innerHTML = firstOption;
    productGroupArray.forEach(addProductGroupOption);
}

function addProductGroup(item) {
    let datas = item.split(splitString);
    let name = `${datas[2]} ${datas[3]}`;
    let option = `<option value="${name}">${name}</option>`;
    let element = {
        name: name,
        option: option
    }
    let exists = false;
    for (let ii = 0; ii < productGroupArray.length; ii++) {
        exists = productGroupArray[ii].name == element.name;
        if (exists) break;
    }
    if (!exists) {
        productGroupArray.push(element);
    }
}

function initProductGroupArray() {
    goods.forEach(addProductGroup);
}

initProductGroupArray();
setProductGroupsOptions();

/******************/
/*    products    */
/******************/

let products = document.getElementById('products');

let productID = 0;
const productStorage = [];

function addProduct(item) {
    let datas = item.split(splitString);
    let stock = parseInt(datas[0]);


}