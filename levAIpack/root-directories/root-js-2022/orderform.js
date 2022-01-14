let splitString = ",";
let firstOption = '<option value="?"> válassz! </option>';

let orderTextContent = "Kosár:"
let helpDeleteRow = "Kattints a törléshez!"

let productInBasketClass = "fixed";
let productInitialClass = "initial";

function formatCurrency(number) {
    return new Intl.NumberFormat('hu-HU', {
        style: 'currency',
        currency: 'HUF'
    }).format(number);
}

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
    let name = datas[0];
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
let orderdetails = document.getElementById('orderdetails');
let quantity = document.getElementById('quantity');

let productID = 0;
const productStorage = [];

function addProduct(item) {
    let datas = item.split(splitString);
    let group = datas[0];
    let stock = parseInt(datas[1]);
    let name = datas[2];
    let price = parseInt(datas[3]);
    let option = `<option value="${productID}">${name + " " + datas[3]}</option>`;
    let element = {
        id: productID,
        group: group,
        stock: stock,
        price: price,
        name: name,
        option: option
    }
    productStorage.push(element);
    productID++;
}

function initProductStorage() {
    goods.forEach(addProduct);
}

let productGroup = '';

initProductStorage();

function addProductOption(item) {
    if (item.stock < 1000) return false;
    if (item.group == productGroup) {
        products.innerHTML += item.option;
    }
}

var selectedItem = null;

function clearProducts() {
    if (productGroup == "?") {
        products.innerHTML = '<option value=""> </option>';
    } else {
        products.innerHTML = firstOption;
    }
    showProductDetailTable();
    quantity.value = '';
    selectedItem = null;
}

function setStorageListOptions() {
    productGroup = productGroups.options[productGroups.selectedIndex].value;
    clearProducts();
    productStorage.forEach(addProductOption);
}


/******************/
/* order  details */
/******************/


function addTable(toElement) {
    let newTable = document.createElement('TABLE');
    toElement.appendChild(newTable);
    return newTable;
}

function addRow(toTable, id, title, rowClass) {
    let newRow = document.createElement('TR');
    newRow.id = id;
    newRow.title = title;
    newRow.classList.add(rowClass);
    toTable.appendChild(newRow);
    return newRow;
}

function addCell(toRow, cellData) {
    let newCell = document.createElement('TD');
    newCell.innerHTML = cellData;
    toRow.appendChild(newCell);
    return newCell;
}

let thousands = 1000;

let orderdetailsTable = addTable(orderdetails);
const orderdetailsArray = [];

function showProductDetail(item, index) {
    nextRow = addRow(orderdetailsTable, index, helpDeleteRow, productInBasketClass);
    addCell(nextRow, `${item.name} ${item.stock}db (${item.price}Ft/db) :`);
    addCell(nextRow, formatCurrency(item.stock * item.price));
}

function showProductDetailTable() {
    orderdetailsTable.remove();
    orderdetailsTable = addTable(orderdetails);
    orderdetailsArray.forEach(showProductDetail);
}

function showProductNextDetail(item, index) {
    nextRow = addRow(orderdetailsTable, index, "", productInitialClass);
    addCell(nextRow, `${item.name} ${quantity.value}db (${item.price}Ft/db) :`);
    addCell(nextRow, formatCurrency(quantity.value * item.price));
}

function displayProductDetails() {
    selectedItem = productStorage[products.options[products.selectedIndex].value];
    quantity.min = thousands;
    quantity.max = selectedItem.stock;
    quantity.value = thousands;
    showProductDetailTable();
    showProductNextDetail(selectedItem, Number.MAX_SAFE_INTEGER);
}

/******************/
/*    quantity    */
/******************/

function setQuantity() {
    quantity.value = Math.floor(quantity.value / 1000) * 1000;
    if (quantity.value < 1000) quantity.value = 1000;
    if (quantity.value > selectedItem.stock) quantity.value = selectedItem.stock;
    showProductDetailTable();
    showProductNextDetail(selectedItem, Number.MAX_SAFE_INTEGER);
}

/******************/
/* basket details */
/******************/

let basketList = document.getElementById('basketList');

let basket = [];
let basketSum;

function basketLine(item, index) {
    let linetext = (index + 1).toString().padStart(2, " ") + ". " + item.stock + " db " + item.productGroup + " " + item.name;
    basketSum += item.stock * item.price;
    let sum = formatCurrency(item.stock * item.price);
    basketList.innerHTML += "\n" + linetext.padEnd(40, " ") + ":" + sum.padStart(16, " ");
}

function displayBasket() {
    basketSum = 0;
    basketList.rows = 2 + basket.length;
    basketList.innerHTML = orderTextContent;
    basket.forEach(basketLine);
    basketList.innerHTML += "\n" + "Összesen :".padStart(41, " ") + formatCurrency(basketSum).padStart(16, " ");
}

let submitOrder = document.getElementById('submitOrder');
submitOrder.disabled = true;

function setBasket() {
    if (selectedItem == null) {
        alert("Nincs kijelölt árucikk!");
    } else {
        selectedItem.stock -= quantity.value;
        let name = selectedItem.name;
        const element = {
            storageID: selectedItem.id,
            stock: quantity.value,
            productGroup: productGroup,
            name: name,
            price: selectedItem.price
        }
        basket.push(element);
        orderdetailsArray.push(element);
        if (basket.length == 0) {
            submitOrder.disabled = true;
        } else {
            submitOrder.disabled = false;
        }
        displayBasket();
        showProductDetailTable();
    }
    productGroups.selectedIndex = 0;
    setStorageListOptions();
}