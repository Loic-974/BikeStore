export const dataFromReporting = {

    value:{},
    getDataFromReporting() {
        return this.value
    },
    setDataFromReporting(newValue){
        this.value=newValue
    }
}




export async function getDataReporting() {

    const tempResult = await fetch('/Reporting/GetReporting', {method:'GET'})
    const result = await tempResult.json()
    return result
}