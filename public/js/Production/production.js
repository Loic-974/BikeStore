const brands = [];
const categorie = [];
const produits = [];
const stocks = [];

const LinkBrand = document.querySelector("#brandLink");
const LinkCategorie = document.querySelector("#CategorieLink");
const LinkProduct = document.querySelector("#ProductLink");

const containerArray = document.querySelector('.table-content-left')
const ArrayOfItems = document.querySelector("#ArrayProduction");

const selectBrand = document.querySelector("#SelectBrand");
const selectCategorie = document.querySelector("#SelectCategorie");
const selectYear = document.querySelector("#SelectAnnee");
const inputRange = document.querySelector("#SelectPrice");
const selectBrandForm = document.querySelector("#SelectBrandForm");
const selectCatForm = document.querySelector("#SelectCategorieForm");

const filterGroup = document.querySelectorAll(".filter-container")[0];

const formBrandName = document.querySelector("#newBrandName");
const formCatName = document.querySelector("#newCatName");
const formProductName = document.querySelector("#newProductName");
const formYearInput = document.querySelector('#newYearProduct');
const formPriceInput = document.querySelector('#newPriceProduct');
const formGroupSelect = document.querySelector('.group-selectProduct')



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

// ----------------------------------------------------------------------------
// --------------------------------- Build View -------------------------------
// ----------------------------------------------------------------------------

    containerArray.style.display='none';
    formBrandName.style.display = "inline";
    formCatName.style.display = "none";
    formProductName.style.display = "none";
    formYearInput.style.display ='none'
    formPriceInput.style.display='none'
    formGroupSelect.style.display='none'
    disabledSelectFilter([selectCategorie,selectYear,selectBrand,inputRange])



LinkBrand.onclick = () => {
    buildArray(brands);
    formBrandName.style.display = "inline-block";
    formCatName.style.display = "none";
    formProductName.style.display = "none";
    formYearInput.style.display ='none'
    formPriceInput.style.display='none'
    formGroupSelect.style.display='none'
    disabledSelectFilter([selectCategorie,selectYear,selectBrand,inputRange])
};

LinkCategorie.onclick = () => {
    buildArray(categorie);
    formBrandName.style.display = "none";
    formCatName.style.display = "inline-block";
    formProductName.style.display = "none";
    formYearInput.style.display ='none'
    formPriceInput.style.display='none'
    formGroupSelect.style.display='none'
    disabledSelectFilter([selectCategorie,selectYear,selectBrand,inputRange])
};

LinkProduct.onclick = () => {
    insertSelectBrand([selectBrand, selectBrandForm]), buildArray(produits);
    insertSelectCategorie([selectCategorie, selectCatForm]),
        insertSelectYears();
        formBrandName.style.display = "none";
        formCatName.style.display = "none";
        formProductName.style.display = "inline-block";
        formYearInput.style.display ='inline-block'
        formPriceInput.style.display='inline-block'
        formGroupSelect.style.display='block'
        selectBrand.disabled=false
        selectCategorie.disabled=false
        allowSelectFilter([selectCategorie,selectYear,selectBrand,inputRange])
};

// ---------------------------------------------------------------------------- //
// ---------------------------- Add Data to Select Or input ------------------- //
// ---------------------------------------------------------------------------- //

function disabledSelectFilter(filter){
    
    for(let filtre of filter){
        console.log(filtre)
        filtre.disabled=true
    }
}

function allowSelectFilter(filter){
    for(let filtre of filter){
        filtre.disabled=false
    }
}

function insertSelectBrand(select) {
    for (let input of select) {
        input.innerHTML = "";
        for (let ref of brands) {
            input.insertAdjacentHTML(
                "beforeend",
                '<option value="' +
                    ref.brandId +
                    '">' +
                    ref.brandName +
                    "</option>"
            );
        }
    }
}

function insertSelectCategorie(select) {
    for (let input of select) {
        input.innerHTML = "";
        for (let ref of categorie) {
            input.insertAdjacentHTML(
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
}

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

function insertSelectYears() {
    selectYear.innerHTML = "";
    array = setYearPresentInProduct();
    for (let annee of array) {
        selectYear.insertAdjacentHTML(
            "beforeend",
            '<option value="' + annee + '">' + annee + "</option>"
        );
    }
}

//--------------------------------------------------------------//
//----------------------- Build Array --------------------------//
//--------------------------------------------------------------//

function buildArray(array) {
    containerArray.style.display='block'
    const dontShowString = "_id";
    ArrayOfItems.innerHTML = "";
    let thead = document.createElement("thead");
    let tbody = document.createElement("tbody");
    let i = 0;
    for (let ref of array) {
        let tr = document.createElement("tr");
        for (let propriete in ref) {
            if (i === 0) {
                // limit 1 header
                if (!propriete.includes(dontShowString)) {
                    let th = document.createElement("th");
                    let thText = document.createTextNode(propriete);
                    th.appendChild(thText);
                    thead.appendChild(th);
                }
            }
            if (!propriete.includes(dontShowString)) {
                let td = document.createElement("td");
                let tdText = document.createTextNode(ref[propriete]);
                td.appendChild(tdText);
                tr.appendChild(td);
            }
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

// ----------------------------------------------------------------------- //
// ---------------------------- Display ---------------------------------- //
// ----------------------------------------------------------------------- //

console.log(brands);
console.log(categorie);
console.log(produits);
