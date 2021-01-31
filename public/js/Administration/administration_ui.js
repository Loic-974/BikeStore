import {
    staffUser,
    getDataUser,
    suspendStaff,
    reiniPassword,
    activeStaff,
    updateStaffData,
    addNewStaff
} from "./administration_setter.js";
import {
    buildModalOnClick,
    buildArray,
    buildNotification
} from "../lib/buildFunction.js";
import {
    notification,
    getNotification,
    updateNotification
} from "../GlobalSetter/notificationSetter.js";

const ignoreString = "_id";
const loader = document.querySelector("#loader");
const arrayAdmin = document.querySelector("#ArrayAdministration");
const searchInput = document.querySelector("#searchInput");

const modalProduction = document.querySelector("#modalProduction");
const titleModal = document.querySelector(".titreModal");
const modalForm = document.querySelector("#modalProduction form");
const backModal = document.querySelector("#backgroundModal");
const validUpdateModal = document.querySelector("#validUpdateModal");

const gestionModal = document.querySelector("#gestionStaff");
const stopStaff = document.querySelector("#stopStaff");
const ActiveStaff = document.querySelector("#ActiveStaff");
const MdpStaff = document.querySelector("#MdpStaff");
const modifyStaff = document.querySelector("#modifyStaff");
const deleteStaff = document.querySelector("#deleteStaff");

const btnAddColab = document.querySelector("#btnAddColab");

const tableNotification = document.querySelector("#notificationList tbody");

window.onload = async () => {
    await getDataUser();
    buildArray(staffUser.value, arrayAdmin, openModal, ignoreString);
    loader.style.display = "none";
    notification.setNotification(await getNotification());
     buildNotification(
        notification.getNotificationValue(),
        tableNotification,
        updateNotification
    );
};

backModal.onclick = () => {
    backModal.style.display = "none";
    gestionModal.style.display = "none";
    modalProduction.style.display = "none";
};

function openModal(item) {
    backModal.style.display = "block";
    gestionModal.style.display = "flex";
    const staff_id = item.user_id;

    modifyStaff.onclick = async () => {
        modalProduction.style.display = "flex";
        gestionModal.style.display = "none";
        buildModalAdmin(item, modalForm, titleModal);
        validUpdateModal.onclick = async () => {
            const data = { user_id: staff_id };
            Object.assign(data, getAllDataFromForm(modalForm));
            await updateStaffData(data);
            await getDataUser();
            buildArray(staffUser.value, arrayAdmin, openModal, ignoreString);
            modalProduction.style.display = "none";
            backModal.style.display = "none";
        };
    };
    stopStaff.onclick = async () => {
        await suspendStaff(staff_id);
        await getDataUser();
        buildArray(staffUser.value, arrayAdmin, openModal, ignoreString);
    };

    ActiveStaff.onclick = async () => {
        await activeStaff(staff_id);
        await getDataUser();
        buildArray(staffUser.value, arrayAdmin, openModal, ignoreString);
    };

    MdpStaff.onclick = async () => {
        await reiniPassword(staff_id);
        await getDataUser();
        buildArray(staffUser.value, arrayAdmin, openModal, ignoreString);
    };
    // buildModalOnClick(item, titleModal, modalForm, ignoreString);
    // modalValue = item;
}

btnAddColab.onclick = () => {
    backModal.style.display = "block";
    modalProduction.style.display = "flex";
    gestionModal.style.display = "none";
    buildModalAdmin({}, modalForm, titleModal);
    validUpdateModal.onclick = async () => {
        await addNewStaff(getAllDataFromForm(modalForm));
        await getDataUser();
        buildArray(staffUser.value, arrayAdmin, openModal, ignoreString);
        modalProduction.style.display = "none";
        backModal.style.display = "none";
    };
};

searchInput.oninput = event => {
    buildArray(
        staffUser.value.filter(item =>
            item.lastName.includes(event.currentTarget.value)
        ),
        arrayAdmin,
        openModal,
        ignoreString
    );
};

function buildModalAdmin(item, cible, title) {
    title.innerHTML = `Action concernant : ${item.lastName ||
        ""} ${item.firstName || ""}`;
    cible.innerHTML = `
    <label> Nom de Famille </label>
        <input type='text' name='lastName' class="form-control" required value="${item.lastName ||
            ""}">
    
    <label> Prénom  </label>
    <input type='text' name='firstName' class="form-control" required value="${item.firstName ||
        ""}">
   
    <label> Email  </label>
        <input type='email' name='email' class="form-control" required value="${item.email ||
            ""}">
   
    <label> Phone </label>
    <input type='text' name='phone' class="form-control" required value="${item.phone ||
        ""}">
    
    <label> Responsable </label>
        <select class="form-control" id='responsable' >
        ${staffUser.value.map(ref =>
            item.role
                ? ref.role <= item.role && ref.role
                    ? `<option value='${ref.user_id}'>${ref.lastName} ${ref.firstName}</option>`
                    : null
                : `<option value='${ref.user_id}'>${ref.lastName} ${ref.firstName}</option>`
        )}
        </select>
    
    <label> Role  </label>
        <select class="form-control" id='role'>

            <option value=1 ${
                item.role == 1 ? "selected" : null
            }>Administrateur</option>
            <option value=2 ${
                item.role == 2 ? "selected" : null
            }>Gestionnaire</option>
            <option value=3 ${
                item.role == 3 ? "selected" : null
            }>Vendeur</option>
            <option value=4 ${
                item.role == 4 ? "selected" : null
            }>Production</option>
        </select>

    `;
}

function getAllDataFromForm(form) {
    const input = form.querySelectorAll("input");
    const select = form.querySelectorAll("select");
    let result = {};

    if (input) {
        for (let ref of input) {
            result[ref.name] = ref.value;
        }
    }
    if (select) {
        for (let ref of select) {
            result[ref.id] = ref.value;
        }
    }
    return result;
}
