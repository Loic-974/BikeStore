

import jsPDF from "jspdf";
import { factures, newFacture } from "./vente_setter.js";

const modalFacture = document.querySelector("#modalFacture");
const sectionClient = document.querySelector("#clientSection");
const sectionEntreprise = document.querySelector("#storeSection");
const sectionItem = document.querySelector("#listItemSection tbody");
const backModal = document.querySelector("#backgroundModal");
const sectionTotal = document.querySelector("#listItemSection tfoot tr");
const buttonClose = document.querySelector("#closeButton")
const buttonDownload = document.querySelector('#download')

const pdf = new jsPDF()
export async function openModalFacture(ref) {
    await factures.setFacture(await newFacture(ref.order_id));
    modalFacture.style.display = "flex";
    backModal.style.display = "block";

    const factureArray = factures.value;
    const infoClientStore = factureArray.slice(-1);
    const listItem = factureArray.slice(0, -1);

    for (const infoGroup of infoClientStore) {
        sectionClient.innerHTML = `
        <p>Nom : ${infoGroup.lastName}</p>
        <p>Prenom : ${infoGroup.firstName}</p>
        <p>Email : ${infoGroup.emailCustomer}</p>
        <p>Adresse : ${infoGroup['"streetCustomer"']}</p>
        <p>Ville : ${infoGroup.cityCustomer}</p>
        <p>Code Postal : ${infoGroup.zipCodeCustomer}</p>
        <p>Pays : ${infoGroup.stateCustomer}</p>
        `;

        sectionEntreprise.innerHTML=`
        <p>${infoGroup.storeName} </p>
        <p>${infoGroup.storeEmail} </p>
        <p>${infoGroup.storeStreet} </p>
        <p>${infoGroup.storeCity} </p>
        <p>${infoGroup.storeZipCode.replace(']','')} </p>
        <p>${infoGroup.storeState} </p>   
        `
    }
    let totalFacture = 0
    for (const item of listItem){
        totalFacture +=(+item.total)
        sectionItem.innerHTML += `
        <tr>
            <td>${item.productName}</td>
            <td>${item.quantity}</td>
            <td>${item.price}</td>
            <td>${item.total}</td>
        </tr>
        `
    }
    sectionTotal.append(`${totalFacture} `)
}


buttonClose.onclick= () => {backModal.style.display='none';
                                   modalFacture.style.display='none'};

// buttonDownload.onclick = () => 