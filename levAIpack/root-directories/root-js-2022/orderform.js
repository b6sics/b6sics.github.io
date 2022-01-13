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

function addProductGroup(item) {
    let datas = item.split(" ");
    let name = `${datas[2]} ${datas[3]}`;
    let option = `<option value="${name}">${name}</option>`;
    element = {
        name: name,
        option: option
    }
    if (!productGroupArray.includes(element)) {
        productGroupArray.push(element);
    }
}

function initProductGroupArray() {
    goods.forEach(addProductGroup);
}