

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

export const stock = {

    value: [],
    setStock(newValue){
        this.value=newValue
    }
}

// -------------------------------------------- AJAX GETTER ------------------------------------------------------- //

export async function setCustomerData(){
const result = await fetch('/vente/getCustomer',{
    method:'GET'
})
    const resultReturn = await result.json()
    return resultReturn
}

export async function setOrderData(){
    const result = await fetch('/vente/getOrder', {method:'GET'})
    const jsonResult = await result.json()
    return jsonResult
    
}

export async function setStockItem(){
    const result = await fetch('/vente/getStock', {method:'GET'})
    const jsonResult = await result.json()
    return jsonResult
}

export async function updateCustomerData(object){
    const result = await fetch('/vente/updateCustomer',{
        method:'POST',
        Accept:'application/json',
        "Content-Type":'application/json',
        body:JSON.stringify(object)
    })
    const jsonResult = await result.json()
    return jsonResult
}

// ------------------------------------------------  AJAX SETTER  ------------------------------------- //

export async function newOrder(newCommandObject){

    const result = await fetch('/vente/newOrder',{
        method: 'POST',
        "Content-Type": "application/json",
        Accept: "application/json",
        body:newCommandObject
    })
    const test = await result.json()
    return test
    }