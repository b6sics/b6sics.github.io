let firstOption = '<option value=" ? ">válassz!</option>';

let productGroups = document.getElementById('productGroups');

const productGroupArray = [];

function addProductGroupOption(item, index) {
    productGroupArray.innerHTML += item.option;
}

function setProductGroupsOptions() {
    productGroups.innerHTML = firstOption;
    productGroupArray.forEach(addProductGroupOption);
}

let productGroupId = 0;

function addProductGroup(item) {
    let datas = item.split(" ");
    element = {
        id: productGroupId,
        name: `${datas[2]} ${datas[3]}`,
    }
    productGroupId++;
}

function initProductGroupArray() {
    goods.forEach(addProductGroup);
}