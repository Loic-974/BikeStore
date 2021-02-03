import { buildModalOnClick, buildArray, buildNotification } from "../lib/buildFunction.js";
import {notification, getNotification, updateNotification} from '../GlobalSetter/notificationSetter.js';

let brands = [];
let categorie = [];
let produits = [];
let stocks = [];


//------------------------------------ SETTER -------------------------------------------//
const setBrands = value => {
    brands = value;
    insertSelectBrand([selectBrand, selectBrandForm]);
};

const setCategory = value => {
    categorie = value;
    insertSelectCategorie([selectCategorie, selectCatForm]);
};
const setProduct = value => {
    produits = value;
    insertSelectYears(produits);
    insertSelectCategorie([selectCategorie, selectCatForm]);
    insertSelectBrand([selectBrand, selectBrandForm]);
};

const setStock = value => {
    stocks = value;
    insertSelectStore(selectStore);
    insertSelectStore(selectedStore);
};
let modalValue = null; // useIt For Modal Ajax
let modalFrom = null;

const LinkBrand = document.querySelector("#brandLink");
const LinkCategorie = document.querySelector("#CategorieLink");
const LinkProduct = document.querySelector("#ProductLink");
const LinkStock = document.querySelector("#StockLink");
const ArrayOfItems = document.querySelector("#ArrayProduction");

const selectBrand = document.querySelector("#SelectBrand");
const selectCategorie = document.querySelector("#SelectCategorie");
const selectYear = document.querySelector("#SelectAnnee");
const selectStore = document.querySelector("#SelectStore");
const selectBrandForm = document.querySelector("#SelectBrandForm");
const selectCatForm = document.querySelector("#SelectCategorieForm");
const searchInput = document.querySelector("#searchInput");
const searchList = document.querySelectorAll(".searchList");

// --- Form DOM --//
const formBrandName = document.querySelector("#newBrandName");
const formCatName = document.querySelector("#newCatName");
const formProductName = document.querySelector("#newProductName");
const formYearInput = document.querySelector("#newYearProduct");
const formPriceInput = document.querySelector("#newPriceProduct");
const formGroupSelect = document.querySelector(".group-selectProduct");
const formQuantity = document.querySelector("#newQuantity");
const formSelectStock = document.querySelectorAll(".groupStock")[0];
const selectedProduct = document.querySelector("#selectProduct");
const selectedStore = document.querySelector("#selectStore");

const formSendButton = document.querySelector("#btnAddDataBrand");

// --- Modal DOM --//
const backModal = document.querySelector("#backgroundModal");

const modalProduction = document.querySelector("#modalProduction");
const titleModal = modalProduction.querySelectorAll(".titreModal")[0];
const modalForm = document.querySelector("#modalProduction form");
const modalUpdateButton = document.querySelector("#validUpdateModal");
const modalError = document.querySelector("#modalErrorProduction");
const modalDeleteButton = document.querySelector("#modalDeleteProduction");

const dontShowString = "_id";

const notifList = document.querySelector('#notificationList tbody')

// -----------------------------------------------------------------------
//--------------------------------- Get Data ------------------------------
//------------------------------------------------------------------------


const setUser = async () => {
    const userId = await fetch('/session',{})
    let result = await userId.text()
    return (result*1)
}

const getUser = async () =>{
    const result = await setUser()
    console.log(result)
    if(result === 4){
    formSendButton.style.backgroundColor = "grey";
    formBrandName.disabled = true
    formCatName.disabled = true
    formProductName.disabled = true
    formYearInput.disabled = true
    formPriceInput.disabled = true
    formGroupSelect.disabled = true
    formQuantity.disabled = true
    formSelectStock.disabled = true
    formSendButton.disabled = true
    selectedStore.disabled = true
    selectedProduct.disabled = true
    selectBrandForm.disabled = true
    selectCatForm.disabled = true
    }
}


function getBrands() {
    fetch("/production/getBrand", {
        method: "GET",
        "Content-Type": "application/json",
        Accept: "application/json",
        "X-Requested-With": "XMLHttpRequest"
    })
        .then(response => {
            return response.json();
        })
        .then(response => {
            for (let brand of response) {
                brands.push(brand);
            }
        })

        .then(() => LinkBrand.click());
}

function getCategory() {
    fetch("/production/getCat", {
        method: "GET",
        "Content-Type": "application/json",
        Accept: "application/json",
        "X-Requested-With": "XMLHttpRequest"
    })
        .then(response => {
            return response.json();
        })
        .then(response => {
            for (let cat of response) {
                categorie.push(cat);
            }
        });
}

function getProduct() {
    fetch("/production/getProduct", {
        method: "GET",
        "Content-Type": "application/json",
        Accept: "application/json",
        "X-Requested-With": "XMLHttpRequest"
    })
        .then(response => {
            return response.json();
        })
        .then(response => {
            for (let product of response) {
                produits.push(product);
            }
        });
}

function getStock() {
    fetch("/production/getStock", {
        method: "GET",
        "content-type": "application/json",
        Accept: "application/json"
    })
        .then(response => {
            return response.json();
        })
        .then(response => {
            for (let stock of response) {
                stocks.push(stock);
            }
        });
}
window.onload =async () => {
    getBrands(), getCategory(), getProduct(), getStock();
    formSendButton? formSendButton.style.backgroundColor = "grey":null;
    notification.setNotification(await getNotification())
    buildNotification(notification.value,notifList,updateNotification)
};
// ----------------------------------------------------------------------------
// --------------------------------- Build View -------------------------------
// ----------------------------------------------------------------------------


formBrandName?formBrandName.style.display = "inline":null;
formCatName?formCatName.style.display = "none":null;
formProductName?formProductName.style.display = "none":null;
formYearInput?formYearInput.style.display = "none":null;
formPriceInput?formPriceInput.style.display = "none":null;
// formBrandName.style.display = "none"
// formCatName.style.display = "none"
formGroupSelect?formGroupSelect.style.display = "none":null
formQuantity?formQuantity.style.display = "none":null
formSelectStock?formSelectStock.style.display = "none":null

// selectedStore.style.display = "none"
// selectedProduct.style.display = "none"
// selectBrandForm.style.display = "none"
// selectCatForm.style.display = "none"

// disabledSelectFilter([selectCategorie, selectYear, selectBrand]);

LinkBrand.onclick = () => {
    buildArray(brands, ArrayOfItems, openModal, dontShowString);
    insertSelectBrand([selectBrand, selectBrandForm]);
    modalFrom = "brands"; // set the modalInformation for use in Ajax
    formBrandName.style.display = "inline-block";
    formCatName.style.display = "none";
    formProductName.style.display = "none";
    formYearInput.style.display = "none";
    formPriceInput.style.display = "none";
    formGroupSelect.style.display = "none";
    formQuantity.style.display = "none";
    formSelectStock.style.display = "none";
    disabledSelectFilter([
        selectCategorie,
        selectYear,
        selectStore,
        searchInput
    ]);
    allowSelectFilter([selectBrand]);
    // formSendButton.disabled = false;
    // formSendButton.style.backgroundColor = "#007bff";
    getUser()
};

LinkCategorie.onclick = () => {
    buildArray(categorie, ArrayOfItems, openModal, dontShowString);
    insertSelectCategorie([selectCategorie, selectCatForm]),
        (modalFrom = "category"); // set the modalInformation for use in Ajax
    formBrandName.style.display = "none";
    formCatName.style.display = "inline-block";
    formProductName.style.display = "none";
    formYearInput.style.display = "none";
    formPriceInput.style.display = "none";
    formGroupSelect.style.display = "none";
    formQuantity.style.display = "none";
    disabledSelectFilter([selectYear, selectBrand, selectStore, searchInput]);
    allowSelectFilter([selectCategorie]);
    // formSendButton.disabled = false;
    // formSendButton.style.backgroundColor = "#007bff";
    formSelectStock.style.display = "none";
    getUser()
};

LinkProduct.onclick = () => {
    buildArray(produits, ArrayOfItems, openModal, dontShowString);
    insertSelectBrand([selectBrand, selectBrandForm]);
    insertSelectCategorie([selectCategorie, selectCatForm]),
        insertSelectYears(produits);
    
    modalFrom = "product";
    formBrandName.style.display = "none";
    formCatName.style.display = "none";
    formProductName.style.display = "inline-block";
    formYearInput.style.display = "inline-block";
    formPriceInput.style.display = "inline-block";
    formGroupSelect.style.display = "block";

    formQuantity.style.display = "none";
    selectBrand.disabled = false;
    selectCategorie.disabled = false;
    allowSelectFilter([selectCategorie, selectYear, selectBrand]);
    disabledSelectFilter([selectStore, searchInput]);
    // formSendButton.disabled = false;
    // formSendButton.style.backgroundColor = "#007bff";
    formSelectStock.style.display = "none";
    getUser()
};

LinkStock.onclick = () => {
    buildArray(stocks, ArrayOfItems, openModal, dontShowString);
    insertSelectStore(selectStore), insertSelectStore(selectedStore);
    modalFrom = "stock";
    formBrandName.style.display = "none";
    formCatName.style.display = "none";
    formProductName.style.display = "none";
    formYearInput.style.display = "none";
    formPriceInput.style.display = "none";
    formGroupSelect.style.display = "none";
    formSelectStock.style.display = "flex";
    formSelectStock.style.display = "flex";
    selectBrand.disabled = true;
    selectCategorie.disabled = true;
    disabledSelectFilter([selectCategorie, selectYear, selectBrand]);
    allowSelectFilter([selectStore, searchInput]);
    formQuantity.style.display = "flex";
    // formSendButton.disabled = true;
    // formSendButton.style.backgroundColor = "grey";
    searchInput.oninput = () =>
        insertProductList(stocks, searchList[0], searchInput);
    selectedProduct.oninput = () =>
        insertProductList(produits, searchList[1], selectedProduct);
        getUser()
};


// ---------------------------------------------------------------------------- //
// ---------------------------- Add Data to Select Or input ------------------- //
// ---------------------------------------------------------------------------- //

function disabledSelectFilter(filter) {
    for (let filtre of filter) {
        filtre.disabled = true;
        filtre.innerHTML = "";
    }
}

function allowSelectFilter(filter) {
    for (let filtre of filter) {
        filtre.disabled = false;
    }
}
/**
 * Insert option brand in the correct html select
 * @param {*} select - array of objects
 */
function insertSelectBrand(select) {
 
    for (let input of select) {
        input.innerHTML = "";
        input.innerHTML = "<option value=''>Marque du produit</option>";

        for (let ref of brands) {
            input.insertAdjacentHTML(
                "beforeend",
                '<option value="' +
                    ref.brand_id +
                    '">' +
                    ref.brandName +
                    "</option>"
            );
        }
    }
    console.log("Brand Set");
}
/**
 * Insert option in the correct html select
 * @param {*} select - array of objects
 */
function insertSelectCategorie(select) {
    for (let input of select) {
        input.innerHTML = "";
        input.innerHTML = "<option  value=''>Categorie du produit</option>";
        for (let ref of categorie) {
            input.insertAdjacentHTML(
                "beforeend",
                '<option value="' +
                    ref.category_id +
                    '">' +
                    ref.categoryName +
                    "</option>"
            );
        }
        console.log("------- Loaded Select --------");
    }
}
/**
 * filter distinct year and set year option in the correct html select
 */
function setYearPresentInProduct() {
    let arrayOfYear = [];
    // recupere distinctement les dates en fonction des produits
    for (let ref of produits) {
        if (!arrayOfYear.includes(ref.model_year)) {
            arrayOfYear.push(ref.model_year);
        }
    }
    return arrayOfYear;
}

function setStoreOptionInStock() {
    let arrayOfStore = [];
    for (let store of stocks) {
        if (!arrayOfStore.includes(store.magasin)) {
            arrayOfStore.push(store.magasin);
        }
    }
    return arrayOfStore;
}

function insertSelectYears(array) {
    selectYear.innerHTML = "";
    selectYear.innerHTML = "<option value=''>Année du produit</option>";
    array = setYearPresentInProduct();
    for (let annee of array) {
        selectYear.insertAdjacentHTML(
            "beforeend",
            '<option value="' + annee + '">' + annee + "</option>"
        );
    }
}

function insertSelectStore(cible) {
    cible.innerHTML = "";
    cible.innerHTML = "<option value=''>Libellé du magasin</option>";
   let array = setStoreOptionInStock();
    for (let store of array) {
        cible.insertAdjacentHTML(
            "beforeend",
            '<option value="' + store + '">' + store
        ) + "</option>";
    }
}

function insertProductList(array, cible, input) {
    let filter = input.value;
    let result = [];
    for (let ref of array) {
        if (
            (ref["produit"] || ref["product_name"]).includes(filter) ||
            (ref["produit"] || ref["product_name"]).includes(
                filter.toUpperCase()
            )
        ) {
            result.push(ref);
        }
    }
    input.value
        ? (cible.style.display = "block")
        : (cible.style.display = "none");
    cible.innerHTML = "";

    for (let ref of result) {
        let option = document.createElement("option");
        option.setAttribute("value", ref["produit"] || ref["product_id"]);
        option.setAttribute("label", ref["produit"] || ref["product_name"]);
        option.onclick = () =>
            defineValueSearch(
                ref["produit"] || ref["product_name"],
                cible,
                input
            );
        cible.appendChild(option);
    }

    function defineValueSearch(item, cible, input) {
        input.value = item;
        filterArray();
        cible.style.display = "none";
    }
}

// --------------------------------------------------------/
// -------------------- ARRAY filter ----------------------/
// --------------------------------------------------------/

for (let select of document.querySelectorAll(
    ".filter-container select, .filter-container input"
)) {
    select.onchange = () => filterArray();
}

function filterArray() {
    let array = null;
    let result = [];
    modalFrom === "brands" ? (array = brands) : null;
    modalFrom === "category" ? (array = categorie) : null;
    modalFrom === "product" ? (array = produits) : null;
    modalFrom === "stock" ? (array = stocks) : null;
    let filterBrand = selectBrand.value;
    let filterCat = selectCategorie.value;
    let filterYear = selectYear.value;
    let filterStore = selectStore.value;
    let filterProduit = searchInput.value;
    console.log(filterProduit, filterBrand, filterCat, filterStore, filterYear);
    function checkBrand(item) {
        if (filterBrand !== "") {
            if (filterBrand === item["brand_id"]) {
                return true;
            }
        } else {
            return true;
        }
    }

    function checkCat(item) {
        if (filterCat !== "") {
            if (filterCat === item["category_id"]) {
                return true;
            }
        } else {
            return true;
        }
    }

    function checkYear(item) {
        if (filterYear !== "") {
            if (filterYear === item["model_year"]) {
                return true;
            }
        } else {
            return true;
        }
    }

    function checkStore(item) {
        if (filterStore !== "") {
            if (filterStore === item["magasin"]) {
                return true;
            }
        } else {
            return true;
        }
    }

    function checkProduit(item) {
        if (filterProduit !== "") {
            if (filterProduit === item["produit"]) {
                return true;
            }
        } else {
            return true;
        }
    }

    for (let ref of array) {
        if (
            checkBrand(ref) &&
            checkCat(ref) &&
            checkYear(ref) &&
            checkStore(ref) &&
            checkProduit(ref)
        ) {
            result.push(ref);
        }
    }
    buildArray(result, ArrayOfItems, openModal, dontShowString);
}

// --------------------------------------------------------/
// -------------------- check INput ----------------------/
// --------------------------------------------------------/

function checkDataAndValidInput(data, item) {
    let result = true;
    for (let ref of data) {
        for (let property in ref) {
            if (ref[property] === item||ref[property] === (item[0].toUpperCase()+item.substring(1))) {
                console.log("toto");
                result = false;
            }
        }
    }
    return result;
}

function validInputValue(data, item) {
    checkDataAndValidInput(data, item)
        ? ((modalErrorProduction.innerHTML = ""),
          (formSendButton.disabled = false),
          (formSendButton.style.backgroundColor = "#007bff"))
        : ((modalErrorProduction.innerHTML = "La référence existe déjà"),
          (formSendButton.disabled = true),
          (formSendButton.style.backgroundColor = "grey"));
}

// ----------------------------------------------------------------------- //
// ---------------------------- Display ---------------------------------- //
// ----------------------------------------------------------------------- //

function openModal(item) {
    backModal.style.display = "block";
    modalProduction.style.display = "flex";
    buildModalOnClick(item, titleModal, modalForm, dontShowString);
    modalValue = item;
}

backModal.onclick = () => {
    backModal.style.display = "none";
    modalProduction.style.display = "none";
};

formBrandName?formBrandName.onchange = () => {
    console.log(formBrandName.value);
    validInputValue(brands, formBrandName.value)
        // ? ((document.querySelector("#errorFormProduction").innerHTML = ""),
        //   (formSendButton.disabled = false),
        //   (formSendButton.style.backgroundColor = "#007bff"))
        // : ((document.querySelector("#errorFormProduction").innerHTML =
        //       "La marque existe déjà !"),
        //   (formSendButton.disabled = true),
        //   (formSendButton.style.backgroundColor = "grey"));
}:null;

formCatName?formCatName.onchange = () => {
    validInputValue(categorie, formCatName.value)
        // ? ((document.querySelector("#errorFormProduction").innerHTML = ""),
        //   (formSendButton.disabled = false),
        //   (formSendButton.style.backgroundColor = "#007bff"))
        // : ((document.querySelector("#errorFormProduction").innerHTML =
        //       "La Categorie existe déjà !"),
        //   (formSendButton.disabled = true),
        //   (formSendButton.style.backgroundColor = "grey"));
}:null;

formProductName?formProductName.onchange = () => {
    validInputValue(produits, formProductName.value)
        // ? ((document.querySelector("#errorFormProduction").innerHTML = ""),
        //   (formSendButton.disabled = false),
        //   (formSendButton.style.backgroundColor = "#007bff"))
        // : ((document.querySelector("#errorFormProduction").innerHTML =
        //       "Le produit existe déjà !"),
        //   (formSendButton.disabled = true),
        //   (formSendButton.style.backgroundColor = "grey"));
}:null;

// ---------------------------- AJAX POST -------------------------------- //

const setArray = () => {
    if (modalFrom === "brands") {
        return brands;
    } else if (modalFrom === "category") {
        return getCategory();
    } else if (modalFrom === "product") {
        return getProduct();
    } else if (modalFrom === "stock") {
        return;
    }
};

const urlAdd = () => {
    if (modalFrom === "brands") {
        return "/production/postBrand";
    } else if (modalFrom === "category") {
        return "/production/postCategory";
    } else if (modalFrom === "product") {
        return "/production/postProduct";
    } else if (modalFrom === "stock") {
        return "/production/insertStock";
    }
};
const urlUpdate = () => {
    if (modalFrom === "brands") {
        return "/production/updateBrand";
    } else if (modalFrom === "category") {
        return "/production/updateCategory";
    } else if (modalFrom === "product") {
        return "/production/updateProduct";
    } else if (modalFrom === "stock") {
        return "/production/updateStock";
    }
};

const urlDelete = () => {
    if (modalFrom === "brands") {
        return "/production/deleteBrand";
    } else if (modalFrom === "category") {
        return "/production/deleteCategory";
    } else if (modalFrom === "product") {
        return "/production/deleteProduct";
    }
};

//-------- New Ajout Référence ----------//

formSendButton?formSendButton.onclick = async () => {
    let data = await insertAjax();
    if(data){
    buildArray(data, ArrayOfItems, openModal, dontShowString);
    modalFrom === "brands" ? setBrands(data) : null;
    modalFrom === "category" ? setCategory(data) : null;
    modalFrom === "product" ? setProduct(data) : null;
    modalFrom === "stock" ? setStock(data) : null;
    }
}:null;

async function insertAjax(array) {
    let input = document
        .querySelector("#formProductionAdd")
        .getElementsByTagName("input");
    let select = document
        .querySelector("#formProductionAdd")
        .getElementsByTagName("select");
    let data = {};
    for (let ref of input) {
        if (ref.value) {
            data[ref.name] = ref.value;
        }
    }

    for (let tag of select) {
        if (tag.value) {
            data[tag.name] = tag.value;
        }
    }
    if (Object.keys(data).length > 0) {
        const newData = await fetch(urlAdd(), {
            method: "POST",
            "Content-Type": "application/json",
            Accept: "application/json",
            "X-Requested-With": "XMLHttpRequest",
            body: JSON.stringify(data)
        });
        return await newData.json();
    }
}

//------ Modification Référence --------//

modalUpdateButton.onclick = async () => {
    let data = await updateAjax();
    buildArray(data, ArrayOfItems, openModal, dontShowString);
    notification.setNotification(await getNotification())
    buildNotification(notification.value,notifList,updateNotification)
    modalProduction.style.display = "none";
    backModal.style.display = "none";
    modalFrom === "brands" ? setBrands(data) : null;
    modalFrom === "category" ? setCategory(data) : null;
    modalFrom === "product" ? setProduct(data) : null;
    modalFrom === "stock" ? setStock(data) : null;
};

async function updateAjax(array) {
    let source = modalValue;
    let input = modalForm.getElementsByTagName("input");
    let data = {};
    for (let int of input) {
        if (int.value) {
            data[int.name] = int.value;
        }
    }
    data["sourceId"] = modalValue[Object.keys(modalValue)[0]];
    console.log(JSON.stringify(data));
    if (Object.keys(data).length > 0) {
        const newData = await fetch(urlUpdate(), {
            method: "POST",
            "Content-Type": "application/json",
            Accept: "application/json",
            body: JSON.stringify(data)
        });
        return await newData.json();
    }
}

// ----- Suppression Référence ------- //

modalDeleteButton.onclick = async () => {
    let data = await deleteAjax();
    buildArray(data, ArrayOfItems, openModal, dontShowString);
    modalProduction.style.display = "none";
    backModal.style.display = "none";
    modalFrom === "brands" ? setBrands(data) : null;
    modalFrom === "category" ? setCategory(data) : null;
    modalFrom === "product" ? setProduct(data) : null;
    modalFrom === "stock" ? setStock(data) : null;
};

async function deleteAjax() {
    const newArray = await fetch(urlDelete(), {
        method: "POST",
        "Content-Type": "application/json",
        Accept: "application/json",
        body: JSON.stringify(modalValue)
    });
    const array = await newArray.json();
    return array;
}
