export const dataFromReporting = {

    value:{},
    getDataFromReporting() {
        return this.value
    },
    setDataFromReporting(newValue){
        this.value=newValue
    }
}




export async function getDataReporting(date) {
    console.log(date)
    const tempResult = await fetch('/Reporting/GetReporting', 
    {method:'POST',
    accept:'application/json',
    "Content-type":'application/json',
    body:date
    })
    const result = await tempResult.json()
    console.log(result)
    return result
}

