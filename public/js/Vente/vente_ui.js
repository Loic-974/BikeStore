
import {vente, customers} from './vente_setter.js';
import { buildModalOnClick, buildArray } from "../lib/buildFunction.js";

const customerLink = document.querySelector('#customersLink')
const venteLink = document.querySelector('#venteLink')

const ignoredString='_id'

const arrayVente = document.querySelector('#ArrayProduction')

let modalValue='';
const backModal = document.querySelector('#backgroundModal')
const modalProduction = document.querySelector('#modalProduction')
const titleModal =document.querySelector('.titreModal')
const modalForm = document.querySelector('#modalProduction form')


// const formClient =  document.querySelector('#newCustomer')
// const formOrder = document.querySelector('#newOrder')

customerLink.onclick = () =>{
buildArray(customers.value,arrayVente,openModal,ignoredString)
// formClient.style.display='flex'
// formOrder.style.display='none'
}


venteLink.onclick=() => {
    buildArray(vente.value,arrayVente,openModal,ignoredString)
    // formClient.style.display='none'
    // formOrder.style.display='flex'
}


function openModal(item) {
    backModal.style.display = "block";
    modalProduction.style.display = "flex";
    buildModalOnClick(item, titleModal, modalForm, ignoredString);
    modalValue = item;
}

backModal.onclick = () => {
    backModal.style.display = "none";
    modalProduction.style.display = "none";
}

