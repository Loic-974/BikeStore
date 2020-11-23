const brands = [];
const categorie = [];
const produits = [];
const stocks = [];

let modalValue = null; // useIt For Modal Ajax
let modalFrom = null;

const LinkBrand = document.querySelector("#brandLink");
const LinkCategorie = document.querySelector("#CategorieLink");
const LinkProduct = document.querySelector("#ProductLink");
const LinkStock = document.querySelector("#StockLink");

const containerArray = document.querySelector(".table-content-left");
const ArrayOfItems = document.querySelector("#ArrayProduction");

const selectBrand = document.querySelector("#SelectBrand");
const selectCategorie = document.querySelector("#SelectCategorie");
const selectYear = document.querySelector("#SelectAnnee");
const selectStore = document.querySelector("#SelectStore");
const inputRange = document.querySelector("#SelectPrice");
const selectBrandForm = document.querySelector("#SelectBrandForm");
const selectCatForm = document.querySelector("#SelectCategorieForm");

const filterGroup = document.querySelectorAll(".filter-container")[0];
// --- Form DOM --//
const formBrandName = document.querySelector("#newBrandName");
const formCatName = document.querySelector("#newCatName");
const formProductName = document.querySelector("#newProductName");
const formYearInput = document.querySelector("#newYearProduct");
const formPriceInput = document.querySelector("#newPriceProduct");
const formGroupSelect = document.querySelector(".group-selectProduct");

const formSendButton = document.querySelector("#btnAddDataBrand");

// --- Modal DOM --//
const backModal = document.querySelector("#backgroundModal");
const modalProduction = document.querySelector("#modalProduction");
const modalForm = document.querySelector("#modalProduction form");
const modalUpdateButton = document.querySelector("#validUpdateModal");
const modalError = document.querySelector("#modalErrorProduction");
const modalDeleteButton = document.querySelector("#modalDeleteProduction");

const dontShowString = "_id";

// -----------------------------------------------------------------------
//--------------------------------- Get Data ------------------------------
//------------------------------------------------------------------------

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

// ----------------------------------------------------------------------------
// --------------------------------- Build View -------------------------------
// ----------------------------------------------------------------------------

containerArray.style.display = "none";
formBrandName.style.display = "inline";
formCatName.style.display = "none";
formProductName.style.display = "none";
formYearInput.style.display = "none";
formPriceInput.style.display = "none";
formGroupSelect.style.display = "none";
disabledSelectFilter([selectCategorie, selectYear, selectBrand, inputRange]);
// backModal.onclick = () => (backModal.style.display = "none");

LinkBrand.onclick = () => {
    buildArray(brands);
    modalFrom = "brands"; // set the modalInformation for use in Ajax
    formBrandName.style.display = "inline-block";
    formCatName.style.display = "none";
    formProductName.style.display = "none";
    formYearInput.style.display = "none";
    formPriceInput.style.display = "none";
    formGroupSelect.style.display = "none";
    disabledSelectFilter([
        selectCategorie,
        selectYear,
        selectBrand,
        inputRange
    ]);
};

LinkCategorie.onclick = () => {
    buildArray(categorie);
    modalFrom = "category"; // set the modalInformation for use in Ajax
    formBrandName.style.display = "none";
    formCatName.style.display = "inline-block";
    formProductName.style.display = "none";
    formYearInput.style.display = "none";
    formPriceInput.style.display = "none";
    formGroupSelect.style.display = "none";
    disabledSelectFilter([
        selectCategorie,
        selectYear,
        selectBrand,
        inputRange
    ]);
};

LinkProduct.onclick = () => {
    insertSelectBrand([selectBrand, selectBrandForm]), buildArray(produits);
    insertSelectCategorie([selectCategorie, selectCatForm]),
        insertSelectYears();
    modalFrom = "product";
    formBrandName.style.display = "none";
    formCatName.style.display = "none";
    formProductName.style.display = "inline-block";
    formYearInput.style.display = "inline-block";
    formPriceInput.style.display = "inline-block";
    formGroupSelect.style.display = "block";
    selectBrand.disabled = false;
    selectCategorie.disabled = false;
    allowSelectFilter([selectCategorie, selectYear, selectBrand, inputRange]);
};

LinkStock.onclick = () => {
    buildArray(stocks), insertSelectStore();
    modalFrom = "stock";
    formBrandName.style.display = "none";
    formCatName.style.display = "none";
    formProductName.style.display = "none";
    formYearInput.style.display = "none";
    formPriceInput.style.display = "none";
    formGroupSelect.style.display = "none";
    selectBrand.disabled = true;
    selectCategorie.disabled = true;
};

// ---------------------------------------------------------------------------- //
// ---------------------------- Add Data to Select Or input ------------------- //
// ---------------------------------------------------------------------------- //

function disabledSelectFilter(filter) {
    for (let filtre of filter) {
        filtre.disabled = true;
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
        input.innerHTML =
            "<option disabled selected>Marque du produit</option>";
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
}
/**
 * Insert option in the correct html select
 * @param {*} select - array of objects
 */
function insertSelectCategorie(select) {
    for (let input of select) {
        input.innerHTML = "";
        input.innerHTML =
            "<option disabled selected>Categorie du produit</option>";
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
        if (!arrayOfStore.includes(store.Magasin)) {
            arrayOfStore.push(store.Magasin);
        }
    }
    return arrayOfStore;
}

function insertSelectYears() {
    selectYear.innerHTML = "";
    selectYear.innerHTML =
        "<option disabled selected>Année du produit</option>";
    array = setYearPresentInProduct();
    for (let annee of array) {
        selectYear.insertAdjacentHTML(
            "beforeend",
            '<option value="' + annee + '">' + annee + "</option>"
        );
    }
}

function insertSelectStore() {
    selectStore.innerHTML = "";
    selectStore.innerHTML =
        "<option disabled selected>Libellé du magasin</option>";
    array = setStoreOptionInStock();
    for (let store of array) {
        selectStore.insertAdjacentHTML(
            "beforeend",
            '<option value="' + store + '">' + store
        ) + "</option>";
    }
}
//--------------------------------------------------------------//
//----------------------- Build Array --------------------------//
//--------------------------------------------------------------//

function buildArray(array) {
    containerArray.style.display = "block";
    ArrayOfItems.innerHTML = "";
    let thead = document.createElement("thead");
    let tbody = document.createElement("tbody");
    let i = 0;
    let index = 1;
    for (let ref of array) {
        let tr = document.createElement("tr");
        tr.onclick = () => buildModalOnClick(ref, array);
        let y = 0;
        for (let propriete in ref) {
            if (i === 0) {
                // limit 1 header
                if (!propriete.includes(dontShowString)) {
                    let th = document.createElement("th");
                    let thText = document.createTextNode(propriete);
                    th.appendChild(thText);
                    thead.appendChild(th);
                } else if (y === 0) {
                    let th = document.createElement("th");
                    let thText = document.createTextNode("Index");
                    th.appendChild(thText);
                    thead.appendChild(th);
                }
            }
            if (!propriete.includes(dontShowString)) {
                let td = document.createElement("td");
                let tdText = document.createTextNode(ref[propriete]);
                td.appendChild(tdText);
                tr.appendChild(td);
            } else if (y === 0) {
                let td = document.createElement("td");
                let tdText = document.createTextNode(index);
                td.appendChild(tdText);
                tr.appendChild(td);
            }
            y++;
        }
        tbody.appendChild(tr);
        i++;
        index++;
    }
    ArrayOfItems.appendChild(thead);
    ArrayOfItems.appendChild(tbody);
    console.log("------- Array Build --------");
}

// --------------------------------------------------------/
// -------------------- ARRAY filter ----------------------/
// --------------------------------------------------------/

// --------------------------------------------------------/
// -------------------- check INput ----------------------/
// --------------------------------------------------------/

function checkDataAndValidInput(data, item) {
    let result = true;
    for (let ref of data) {
        for (let property in ref) {
            if (ref[property] === item) {
                result = false;
            }
        }
    }
    return result;
}

function validInputValue(data, item) {
    checkDataAndValidInput(data, item)
        ? (modalErrorProduction.innerHTML = "")
        : (modalErrorProduction.innerHTML = "La référence existe déjà");
}

// ----------------------------------------------------------------------- //
// ---------------------------- Display ---------------------------------- //
// ----------------------------------------------------------------------- //

function buildModalOnClick(item, array) {
    console.log(item);
    modalValue = item;
    backModal.style.display = "block";
    modalProduction.style.display = "flex";
    let titleModal = modalProduction.getElementsByClassName("titreModal");
    titleModal[0].innerHTML = "Action concernant : ";
    titleModal[0].insertAdjacentHTML(
        "beforeend",
        item.brandName || item.categoryName || item.product_name
    );
    modalForm.innerHTML = "";
    for (let ref in item) {
        if (!ref.includes(dontShowString)) {
            modalForm.insertAdjacentHTML(
                "afterbegin",
                '<input type="text" name="' +
                    ref +
                    '" value="' +
                    item[ref] +
                    '" placeholder="' +
                    item[ref] +
                    '" >'
            );
            modalForm.insertAdjacentHTML(
                "afterbegin",
                "<label>Modifier " + ref + "</label>"
            );
        }
    }
}

backModal.onclick = () => {
    backModal.style.display = "none";
    modalProduction.style.display = "none";
};

formBrandName.onchange = () => {
    checkDataAndValidInput(brands, formBrandName.value)
        ? ((document.querySelector("#errorFormProduction").innerHTML = ""),
          (formSendButton.disabled = false),
          (formSendButton.style.backgroundColor = "#007bff"))
        : ((document.querySelector("#errorFormProduction").innerHTML =
              "La marque existe déjà !"),
          (formSendButton.disabled = true),
          (formSendButton.style.backgroundColor = "grey"));
};

formCatName.onchange = () => {
    checkDataAndValidInput(categorie, formCatName.value)
        ? ((document.querySelector("#errorFormProduction").innerHTML = ""),
          (formSendButton.disabled = false),
          (formSendButton.style.backgroundColor = "#007bff"))
        : ((document.querySelector("#errorFormProduction").innerHTML =
              "La Categorie existe déjà !"),
          (formSendButton.disabled = true),
          (formSendButton.style.backgroundColor = "grey"));
};

formProductName.onchange = () => {
    checkDataAndValidInput(produits, formProductName.value)
        ? ((document.querySelector("#errorFormProduction").innerHTML = ""),
          (formSendButton.disabled = false),
          (formSendButton.style.backgroundColor = "#007bff"))
        : ((document.querySelector("#errorFormProduction").innerHTML =
              "Le produit existe déjà !"),
          (formSendButton.disabled = true),
          (formSendButton.style.backgroundColor = "grey"));
};

// ---------------------------- AJAX POST -------------------------------- //

const urlAdd = () => {
    if (modalFrom === "brands") {
        return "/production/postBrand";
    } else if (modalFrom === "category") {
        return "/production/postCategory";
    }else if (modalFrom === "product"){
        return '/production/postProduct'
    }
};
const urlUpdate = () => {
    if (modalFrom === "brands") {
        return "/production/updateBrand";
    } else if (modalFrom === "category") {
        return "/production/updateCategory";
    }
};

const urlDelete = () => {
    if (modalFrom === "brands") {
        return "/production/deleteBrand";
    } else if (modalFrom === "category") {
        return "/production/deleteCategory";
    }
};

//-------- New Ajout Référence ----------//

formSendButton.onclick = () => {
    let input = document
        .querySelector("#formProductionAdd")
        .getElementsByTagName("input");
    let select = document
        .querySelector("#formProductionAdd")
        .getElementsByTagName("select");

    let data = {};
    console.log(input.length);

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
    console.log(data)
    if (Object.keys(data).length > 0) {
        fetch(urlAdd(), {
            method: "POST",
            "Content-Type": "application/json",
            Accept: "application/json",
            "X-Requested-With": "XMLHttpRequest",
            body: JSON.stringify(data)
        })
            .then(response => {
                return response.json();
            })
            .then(response => {
                buildArray(response);
            });
    }
};

//------ Modification Référence --------//

modalUpdateButton.onclick = () => {

    let source = modalValue;
    let input = modalForm.getElementsByTagName("input");
    let data = {};
    for (let int of input) {
        if (int.value) {
            data[int.name] = int.value;
        }
    }
    data["sourceId"] = modalValue[Object.keys(modalValue)[0]];
    if (Object.keys(data).length > 0) {
        fetch(urlUpdate(), {
            method: "POST",
            "Content-Type": "application/json",
            Accept: "application/json",
            body: JSON.stringify(data)
        })
            .then(response => response.json())
            .then(response => buildArray(response))
            .then(
                (modalProduction.style.display = "none"),
                (backModal.style.display = "none")
            );
    }
};

// ----- Suppression Référence ------- //

modalDeleteButton.onclick = () => {
    fetch(urlDelete(), {
        method: "POST",
        "Content-Type": "application/json",
        Accept: "application/json",
        body: JSON.stringify(modalValue)
    })
        .then(response => response.json())
        .then(response => buildArray(response))
        .then(
            (modalProduction.style.display = "none"),
            (backModal.style.display = "none")
        );
};
