 export const vente = {
    value:[],
    getVente(){
        return this.value
    },
    setVente(newValue){
        this.value = newValue
        // Ajout de fonction en cas de changement de valeur
    }
}

export const customers = {

    value:[],
    getCustomers(){
        return this.value
    },
    setCustomers(newValue){
        this.value=newValue
           // Ajout de fonction en cas de changement de valeur
    }
}

export const factures = {

    value:[],
    getFacture(){
        return this.value
    },
    setCustomers(newValue){
        this.value=newValue
    }
}

// -------------------------------------------- AJAX GETTER ------------------------------------------------------- //

fetch('')