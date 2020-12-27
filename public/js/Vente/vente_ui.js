import { vente, customers, stock, newOrder } from "./vente_setter.js";
import { buildModalOnClick, buildArray } from "../lib/buildFunction.js";
// import { indexOf } from "lodash";
// import {isEqual} from "lodash/isEqual";

const orderItem = {
    value: [],
    customer: {},

    getCustomer() {
        return this.customer;
    },

    setCustomer(value, prop) {
        orderItem.customer[prop] = value;

        console.log(orderItem.customer);
    },

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
        ref.orderQuantity = newQuantity;
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

const arrayVente = document.querySelector("#ArrayVente");
const newVenteButton = document.querySelector("#btnAddDataBrand");

let modalValue = "";
const backModal = document.querySelector("#backgroundModal");
const modalProduction = document.querySelector("#modalProduction");
const titleModal = document.querySelector(".titreModal");
const modalForm = document.querySelector("#modalProduction form");

const modalVente = document.querySelector("#modalVente");
const infoClient = document.querySelectorAll("#infoClient input");
const inputModalVente = document.querySelectorAll("#modalVente input");
const lastNameClient = document.querySelector("#LastNameClient");
const searchListName = document.querySelector("#searchListName");
const productOrder = document.querySelector("#ProductOrder");
const searchProductOrder = document.querySelector("#searchProductOrder");
const tableOrder = document.querySelector("#orderItem tbody");

const validOrder = document.querySelector("#validOrder");
// const formClient =  document.querySelector('#newCustomer')
// const formOrder = document.querySelector('#newOrder')

customerLink.onclick = () => {
    buildArray(customers.value, arrayVente, openModal, ignoredString);
};

venteLink.onclick = () => {
    buildArray(vente.value, arrayVente, openModal, ignoredString);
};

function openModal(item) {
    backModal.style.display = "block";
    modalProduction.style.display = "flex";
    buildModalOnClick(item, titleModal, modalForm, ignoredString);
    modalValue = item;
}

newVenteButton.onclick = () => {
    setFunctionToInput(infoClient, setCustomerInfoToOrder);
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
    valueInput
        ? (origin.style.display = "block")
        : (origin.style.display = "none");
    origin.innerHTML = "";

    for (let ref of arrayRef.value) {
        if (ref[propriete].toLowerCase().includes(valueInput)) {
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
 * Replace AutoComplete Form for ModalVente InfoClient
 * @param {*} object - Object For Set Value
 * @param {*} form - Array with every input to set
 */
function defineAllInputValue(object, form) {
    for (let ref in object) {
        for (let input of form) {
            if (ref == input.name) {
                input.value = object[ref];
                orderItem.setCustomer(object[ref], input.name);
            }
        }
    }
}

function buildArrayOrderItem(array) {
    tableOrder.innerHTML = "";

    // for (const ref of array) {
    //     tableOrder.insertAdjacentHTML('beforeend',
    //     '<tr> <td>' + ref.produit +'</td> <td> <input type=\'number\' value=1 max=' +ref.quantity + ' min=0 onchange="orderItem.setNewQuantity(event.currentTarget.value, '+ref+');"/></input></td>'
    //        +'<td>' + (ref.price_id * ref.discount * ref.orderQuantity).toFixed(2) +'</td>'
    //        +'<td><input type=\'number\' value=1 max=1 min=0 onchange="orderItem.setNewDiscount(event.currentTarget.value,'+ ref +');"></input></td>'
    //        +'<td><input type=\'button\' value=\'Supprimer\' onclick="orderItem.deleteOrderItem(ref);/></input></td>'
    //     +'</tr>'
    // )}
    for (const ref of array) {
        const row = document.createElement("tr");
        const produitName = document.createElement("td");
        const textName = document.createTextNode(ref.produit);
        const produitQuantité = document.createElement("td");
        const inputQuantité = document.createElement("input");
        inputQuantité.type = "number";
        inputQuantité.name = "inputQuantity";
        inputQuantité.className = "quantity";
        inputQuantité.id = Math.random();
        inputQuantité.max = ref.quantity;
        inputQuantité.min = 0;
        inputQuantité.value = ref.orderQuantity;
        inputQuantité.oninput = event => {
            orderItem.setNewQuantity(event.currentTarget.value, ref);
        };

        const produitPrix = document.createElement("td");
        const textprix = document.createTextNode(
            (ref.price_id * ref.discount * ref.orderQuantity).toFixed(2)
        );
        const produitDiscount = document.createElement("td");
        const inputDiscount = document.createElement("input");
        inputDiscount.type = "number";
        inputDiscount.name = "discountInput";
        inputDiscount.className = "quantity";
        inputDiscount.id = Math.random();
        inputDiscount.max = 1;
        inputDiscount.min = 0;
        inputDiscount.step = 0.05;
        inputDiscount.value = ref.discount;
        inputDiscount.onchange = event => {
            orderItem.setNewDiscount(event.currentTarget.value, ref);
        };

        const button = document.createElement("input");
        button.type = "button";
        button.value = "Supprimer";
        button.class = "btn btn-danger";
        button.name = "DeleteItem";
        button.id = Math.random();
        button.onclick = () => {
            orderItem.deleteOrderItem(ref);
        };
        produitName.appendChild(textName);
        produitQuantité.appendChild(inputQuantité);
        produitPrix.appendChild(textprix);
        produitDiscount.appendChild(inputDiscount);

        row.appendChild(produitName);
        row.appendChild(produitQuantité);
        row.appendChild(produitPrix);
        row.appendChild(produitDiscount);
        row.appendChild(button);
        tableOrder.appendChild(row);
    }
}

function setFunctionToInput(cible, fonction) {
    for (let input of cible) {
        input.onchange = event => fonction(event);
    }
}

function setCustomerInfoToOrder(event) {
    console.log(event.currentTarget.value, event.currentTarget.name);
    console.log(
        orderItem.setCustomer(
            event.currentTarget.value,
            event.currentTarget.name
        )
    );
    orderItem.setCustomer(event.currentTarget.value, event.currentTarget.name);
    console.log(orderItem.customer);
}

function checkOrder() {
    for (let input of infoClient) {
        if (input.value) {
            input.style.borderColor='green'
            continue;
        } else {
            input.style.borderColor='red'
            return false;
        }
    }
    return true;
}

validOrder.onclick = () => {
    if(checkOrder()){
    let order = {};
        if (orderItem.getOrderItem().length > 0 && orderItem.customer) {
            order = orderItem.customer;
            order["Item"] = { ...orderItem.getOrderItem() };
            console.log(order);
        }
    newOrder(JSON.stringify(order));
    }else{

    }
};
