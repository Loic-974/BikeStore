export const staffUser = {

    value:[],

    getStaffUser(){
        return this.value
    },

    setStaffUser(newValue){
        this.value=newValue
    }

}


export async function getDataUser(){

    const tempResult = fetch('/administration/getStaffUser',{
        method:'GET'
    })
    const result = await (await tempResult).json()
    console.log(result)
    return staffUser.setStaffUser(result)
}


export async function suspendStaff(id){

    const result = await fetch('/administration/stopStaffUser',{
        method:'POST',
        accept:'application/json',
        "content-type":'application/json',
        body:id
    })
}

export async function activeStaff(id){

    const result = await fetch('/administration/activeStaffUser',{
        method:'POST',
        accept:'application/json',
        "content-type":'application/json',
        body:id
    })
}


export async function reiniPassword(id){
    const result = await fetch('/administration/reiniStaffMDP',{
        method:'POST',
        accept:'application/json',
        "content-type":'application/json',
        body:id
    })
}


export async function updateStaffData(data){

    const result = await fetch('/administration/updateStaffUser',{
        method:'POST',
        accept:'application/json',
        "content-type":'application/json',
        body:JSON.stringify(data)
    })
}


export async function addNewStaff(data){

    const result = await fetch('/administration/addStaff',{
        method:'POST',
        accept:'application/json',
        "content-type":'application/json',
        body:JSON.stringify(data)
    })
}

export async function deleteStaffUser(id){
    const result = await fetch('/administration/deleteStaff',{
        method:'POST',
        accept:'application/json',
        "content-type":'application/json',
        body:id
    })
}

