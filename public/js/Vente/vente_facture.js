
import { factures, newFacture } from "./vente_setter.js";

const modalFacture = document.querySelector("#modalFacture");
const containerFacture = document.querySelector('#factureContain')
const sectionClient = document.querySelector("#clientSection");
const sectionEntreprise = document.querySelector("#storeSection");
const sectionItem = document.querySelector("#listItemSection tbody");
const backModal = document.querySelector("#backgroundModal");
const sectionTotal = document.querySelector("#listItemSection tfoot tr");
const buttonClose = document.querySelector("#closeButton")
const buttonDownload = document.querySelector('#download')


export async function openModalFacture(ref) {
    await factures.setFacture(await newFacture(ref.order_id));
    modalFacture.style.display = "flex";
    backModal.style.display = "block";

    const factureArray = factures.value;
    const infoClientStore = factureArray.slice(-1);
    const listItem = factureArray.slice(0, -1);

    for (const infoGroup of infoClientStore) {
        sectionClient.innerHTML = ''
        sectionClient.innerHTML = `
        <p><b>Nom :</b> ${infoGroup.lastName}</p>
        <p><b>Prenom :</b> ${infoGroup.firstName}</p>
        <p><b>Email :</b> ${infoGroup.emailCustomer}</p>
        <p><b>Adresse :</b> ${infoGroup['"streetCustomer"']}</p>
        <p><b>Ville :</b> ${infoGroup.cityCustomer}</p>
        <p><b>Code Postal :</b> ${infoGroup.zipCodeCustomer}</p>
        <p><b>Pays :</b> ${infoGroup.stateCustomer}</p>
        `;
        sectionEntreprise.innerHTML=''
        sectionEntreprise.innerHTML=`
        <p><b>${infoGroup.storeName}</b> </p>
        <p>${infoGroup.storeEmail} </p>
        <p>${infoGroup.storeStreet} </p>
        <p>${infoGroup.storeCity} </p>
        <p>${infoGroup.storeZipCode.replace(']','')} </p>
        <p>${infoGroup.storeState} </p>   
        `
    }
    let totalFacture = 0
    sectionItem.innerHTML=''
    for (const item of listItem){
        totalFacture +=(+item.total)
        sectionItem.innerHTML += `
        <tr>
            <td>${item.productName}</td>
            <td>${item.quantity}</td>
            <td>${item.price}€</td>
            <td>${item.total}€</td>
        </tr>
        `
    }
    sectionTotal.innerHTML=`<td colspan=3> Montant </td> <td>${totalFacture.toFixed(2)}€</td>`
    // sectionTotal.insertAdjacentHTML('beforeend',`<td>${totalFacture}</td>`)
}


buttonClose.onclick= () => {backModal.style.display='none';
                                   modalFacture.style.display='none'};

 buttonDownload.onclick = () => {
html2pdf(containerFacture)
    }