import { vente, customers, stock } from "./vente_setter.js";
import { buildModalOnClick, buildArray } from "../lib/buildFunction.js";
// import { indexOf } from "lodash";
// import {isEqual} from "lodash/isEqual";

const orderItem = {
    value: [],
    getOrderItem() {
        return this.value;
    },
    setOrderItem(newValue) {
        console.log(newValue);
        if (!orderItem.notDuplicate(newValue)) {
            newValue.orderQuantity = 1;
            newValue.discount = 1;
            orderItem.value.push(newValue);
            buildArrayOrderItem(orderItem.value);
        }
    },

    setNewQuantity(newQuantity, ref) {
        console.log(ref);
        ref.orderQuantity = newQuantity;
        console.log(this.value);
        buildArrayOrderItem(orderItem.value);
    },

    setNewDiscount(newDiscount, ref) {
        ref.discount = newDiscount;
        console.log(this.value);
        buildArrayOrderItem(orderItem.value);
    },

    notDuplicate(newValue) {
        for (let ref of this.value) {
            // if(isEqual(newValue,ref)){
            if (JSON.stringify(newValue) === JSON.stringify(ref)) {
                ref.orderQuantity++;
                buildArrayOrderItem(orderItem.value);
                return true;
            } else {
                return false;
            }
        }
    },

    deleteOrderItem(newValue) {
        for (let ref of this.value) {
            if (ref == newValue) {
                this.value = this.value.filter(item => item !== newValue);
                buildArrayOrderItem(orderItem.value);
            }
        }
    }
};

const customerLink = document.querySelector("#customersLink");
const venteLink = document.querySelector("#venteLink");

const ignoredString = "_id";

const arrayVente = document.querySelector("#ArrayProduction");
const newVenteButton = document.querySelector("#btnAddDataBrand");

let modalValue = "";
const backModal = document.querySelector("#backgroundModal");
const modalProduction = document.querySelector("#modalProduction");
const titleModal = document.querySelector(".titreModal");
const modalForm = document.querySelector("#modalProduction form");

const modalVente = document.querySelector("#modalVente");
const inputModalVente = document.querySelectorAll("#modalVente input");
const lastNameClient = document.querySelector("#LastNameClient");
const searchListName = document.querySelector("#searchListName");
const productOrder = document.querySelector("#ProductOrder");
const searchProductOrder = document.querySelector("#searchProductOrder");
const tableOrder = document.querySelector("#orderItem tbody");

// const formClient =  document.querySelector('#newCustomer')
// const formOrder = document.querySelector('#newOrder')

customerLink.onclick = () => {
    buildArray(customers.value, arrayVente, openModal, ignoredString);
    // formClient.style.display='flex'
    // formOrder.style.display='none'
};

venteLink.onclick = () => {
    buildArray(vente.value, arrayVente, openModal, ignoredString);
    // formClient.style.display='none'
    // formOrder.style.display='flex'
};

function openModal(item) {
    backModal.style.display = "block";
    modalProduction.style.display = "flex";
    buildModalOnClick(item, titleModal, modalForm, ignoredString);
    modalValue = item;
}

newVenteButton.onclick = () => {
    backModal.style.display = "block";
    modalVente.style.display = "flex";
};

backModal.onclick = () => {
    backModal.style.display = "none";
    modalVente.style.display = "none";
    modalProduction.style.display = "none";
};

// ----------------------------------------------------------------------------------------------------- //
// ------------------------------------- Modal VENTE --------------------------------------------------- //
// ----------------------------------------------------------------------------------------------------- //

lastNameClient.oninput = event => {
    searchListName.style.display = "block";
    createSearchList(
        searchListName,
        event.currentTarget.value,
        customers,
        "LastName",
        "FirstName",
        inputModalVente,
        defineAllInputValue
    );
};

productOrder.oninput = event => {
    searchProductOrder.style.display = "block";
    createSearchList(
        searchProductOrder,
        event.currentTarget.value,
        stock,
        "produit",
        "price_id",
        null,
        orderItem.setOrderItem
    );
};
/**
 * Default Function for set SearchList and add function to option
 * @param {*} origin
 * @param {*} valueInput
 * @param {*} arrayRef
 * @param {*} propriete
 * @param {*} propriete2
 * @param {*} cible
 * @param {*} setter
 */
function createSearchList(
    origin,
    valueInput,
    arrayRef,
    propriete,
    propriete2,
    cible,
    setter
) {
    origin.value = "";

    let result = [];
    for (let ref of arrayRef.value) {
        if (ref[propriete].includes(valueInput)) {
            result.push(ref);
        }
    }
    valueInput
        ? (origin.style.display = "block")
        : (origin.style.display = "none");
    origin.innerHTML = "";

    for (let ref of result) {
        if (ref[propriete].includes(valueInput)) {
            let option = document.createElement("option");
            option.setAttribute(
                "label",
                ref[propriete] + " " + ref[propriete2]
            );
            option.setAttribute("value", ref[propriete]);
            option.onclick = () => {
                setter(ref, cible), (origin.style.display = "none");
            };
            origin.append(option);
        }
    }
}
/**
 * Replace AutoComplete Form
 * @param {*} object - Object For Set Value
 * @param {*} form - Array with every input to set
 */
function defineAllInputValue(object, form) {
    for (let ref in object) {
        for (let input of form) {
            if (ref == input.name) {
                input.value = object[ref];
            }
        }
    }
}

function buildArrayOrderItem(array) {
    tableOrder.innerHTML = "";
    let total = 0;
    for (let ref of array) {
        let row = document.createElement("tr");
        let produitName = document.createElement("td");
        let textName = document.createTextNode(ref.produit);

        let produitQuantité = document.createElement("td");
        let inputQuantité = document.createElement("input");
        inputQuantité.type = "number";
        inputQuantité.className = "quantity";
        inputQuantité.max = ref.quantity;
        inputQuantité.min = 0;
        inputQuantité.value = ref.orderQuantity;
        inputQuantité.onchange = event => {
            orderItem.setNewQuantity(event.currentTarget.value, ref);
        };

        let produitPrix = document.createElement("td");
        let textprix = document.createTextNode(
            ((ref.price_id * ref.discount) * ref.orderQuantity ).toFixed(2)*1
        );
        let produitDiscount = document.createElement("td");
        let inputDiscount = document.createElement("input");
        inputDiscount.type = "number";
        inputDiscount.className = "quantity";
        inputDiscount.max = 1;
        inputDiscount.min = 0;
        inputDiscount.step = 0.05;
        inputDiscount.value = ref.discount;
        inputDiscount.onchange = event => {
            orderItem.setNewDiscount(event.currentTarget.value, ref);
        };

        let button =document.querySelector('input')
        button.type='button'
        button.value='Supprimer'
        button.class='btn-warning'
        button.onclick= () => {
            orderItem.deleteOrderItem(ref)
        }
        produitName.appendChild(textName);
        produitQuantité.appendChild(inputQuantité);
        produitPrix.appendChild(textprix);
        produitDiscount.appendChild(inputDiscount);

        row.appendChild(produitName);
        row.appendChild(produitQuantité);
        row.appendChild(produitPrix);
        row.appendChild(produitDiscount);
        row.appendChild(button)
        tableOrder.appendChild(row);
    }
}
