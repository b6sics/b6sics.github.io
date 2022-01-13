let firstOption = '<option value=" ? ">válassz!</option>';

let productGroups = document.getElementById('productGroups');

const productGroupArray = [];

function addProductGroupOption(item) {
    productGroupArray.innerHTML += item.option;
}

function setProductGroupsOptions() {
    productGroups.innerHTML = firstOption;
    productGroupArray.forEach(addProductGroupOption);
}

let productGroupId = 0;

function addProductGroup(item) {
    let datas = item.split(" ");
    let name = `${datas[2]} ${datas[3]}`;
    let option = `<option value="${name}">${name}</option>`;
    element = {
        id: productGroupId,
        name: name,
        option: option
    }
    productGroupId++;
}

function initProductGroupArray() {
    goods.forEach(addProductGroup);
}