let firstOption = '<option value=" ? "> válassz! </option>';

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
    let datas = item.split(" ");
    let name = `${datas[2]} ${datas[3]}`;
    let option = `<option value="${name}">${name}</option>`;
    element = {
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