
const brands = [];
const categorie = [];
const produits = [];
const stocks = [];
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
 
// let getBrandCat = new XMLHttpRequest(),
//     method = "GET",
//     overrideMimeType = "application/json",
//     url = "/production/getCat";
// getBrandCat.onreadystatechange = function checkPassword() {
//     if (
//         getBrandCat.readyState === XMLHttpRequest.DONE &&
//         getBrandCat.status === 200
//     ) {
//         console.log(Response);
//     }
// };
// getBrandCat.open("GET", "/production/getCat", true);
// getBrandCat.send();

// ----------------------------------------------------------------------------
// --------------------------------- Build View -------------------------------
// ----------------------------------------------------------------------------

console.log(brands)
console.log(categorie)
