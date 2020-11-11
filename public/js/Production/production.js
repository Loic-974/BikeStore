const brands = [];
const categorie = [];
const produits = [];
const stocks = [];

const LinkBrand = document.querySelector("#brandLink");
const LinkCategorie = document.querySelector("#CategorieLink");
const LinkProduct = document.querySelector("#ProductLink");

const selectBrand = document.querySelector("#SelectBrand");
const selectCategorie = document.querySelector("#SelectCategorie");
const selectYear = document.querySelector("#SelectAnnee");
const inputRange = document.querySelector("#SelectPrice");
const ArrayOfItems = document.querySelector("#ArrayProduction");

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
    });

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

// ----------------------------------------------------------------------------
// --------------------------------- Build View -------------------------------
// ----------------------------------------------------------------------------
window.onload = () => {
    insertSelectBrand(), buildArray(brands);
    insertSelectCategorie(), insertSelectYears();
};

LinkBrand.onclick = () => {
    buildArray(brands);
};

LinkCategorie.onclick = () => {
    buildArray(categorie);
};

LinkProduct.onclick = () => {
    insertSelectBrand(), buildArray(produits);
    insertSelectCategorie(), insertSelectYears();
};

// selectItem.onchange= () => {
//     console.log(selectItem.value)
//     buildArray(filterArray(brands,selectItem.value))
// }

function insertSelectBrand() {
    selectBrand.innerHTML = "";
    for (let ref of brands) {
        selectBrand.insertAdjacentHTML(
            "beforeend",
            '<option value="' + ref.brandId + '">' + ref.brandName + "</option>"
        );
    }
}

function insertSelectCategorie() {
    selectCategorie.innerHTML = "";
    for (let ref of categorie) {
        selectCategorie.insertAdjacentHTML(
            "beforeend",
            '<option value="' +
                ref.categoryId +
                '">' +
                ref.categoryName +
                "</option>"
        );
    }
    console.log("------- Loaded Select --------");
}



function setYearPresentInProduct(){

    let arrayOfYear = [];
    // recupere distinctement les dates en fonction des produits
    for (let ref of produits) {
            if(!arrayOfYear.includes(ref.model_year)){
                arrayOfYear.push(ref.model_year)
            }
    }
    return arrayOfYear
}

function insertSelectYears() {
    selectYear.innerHTML = "";
    array =  setYearPresentInProduct()
    for(let annee of array){
    selectYear.insertAdjacentHTML('beforeend','<option value="'+ annee+'">' +annee + '</option>')
    }
}

//--------------------------------------------------------------//
//----------------------- Build Array --------------------------//
//--------------------------------------------------------------//

function buildArray(array) {
    ArrayOfItems.innerHTML = "";
    let thead = document.createElement("thead");
    let tbody = document.createElement("tbody");
    let i = 0;
    for (let ref of array) {
        let tr = document.createElement("tr");
        for (let propriete in ref) {
            if (i === 0) {
                let th = document.createElement("th");
                let thText = document.createTextNode(propriete);
                th.appendChild(thText);
                thead.appendChild(th);
            }
            let td = document.createElement("td");
            let tdText = document.createTextNode(ref[propriete]);
            td.appendChild(tdText);
            tr.appendChild(td);
        }
        tbody.appendChild(tr);
        i++;
    }
    ArrayOfItems.appendChild(thead);
    ArrayOfItems.appendChild(tbody);
    console.log("------- Array Build --------");
}

function filterArray(array, value) {
    console.log(value);
    let result = [];
    for (let ref of array) {
        for (let prop in ref) {
            if (ref[prop] == value) {
                result.push(ref);
            }
        }
    }
    console.log(result);
    return result;
}

console.log(brands);
console.log(categorie);
console.log(produits);
