
import {vente, customers} from './vente_setter.js';
import { buildModalOnClick, buildArray } from "../lib/buildFunction.js";

const customerLink = document.querySelector('#customersLink')



const ignoredString='_id'

const arrayVente = document.querySelector('#ArrayProduction')

let modalValue='';
const backModal = document.querySelector('#backgroundModal')
const modalProduction = document.querySelector('#modalProduction')
const titleModal =document.querySelector('.titreModal')
const modalForm = document.querySelector('#modalProduction form')

customerLink.onclick = () =>{

buildArray(customers.value,arrayVente,openModal,ignoredString)

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

