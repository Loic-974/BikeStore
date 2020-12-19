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
   async setCustomers(newValue){
        this.value= newValue
           // Ajout de fonction en cas de changement de valeur
    }
}

export const factures = {

    value:[],
    getFacture(){
        return this.value
    },
    setFacture(newValue){
        this.value=newValue
        // Ajout de fonction en cas de changement de valeur
    }
}

// -------------------------------------------- AJAX GETTER ------------------------------------------------------- //

async function setCustomerData(){
const result = await fetch('/vente/getCustomer',{
    method:'GET'
})
    const resultReturn = await result.json()
    return resultReturn
}

async function setOrderData(){
    const result = await fetch('/vente/getOrder', {method:'GET'})
    const jsonResult = await result.json()
    return jsonResult
    
}

window.onload = async() => {
   customers.setCustomers(await setCustomerData())
   vente.setVente(await setOrderData())
}

