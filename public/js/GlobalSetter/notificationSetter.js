export const notification = {
    value: [],

     getNotificationValue(){
        return this.value
    },

    setNotification(newValue){
        this.value=newValue
    },
};

export async function getNotification(){

    const tempResult = await fetch('/notification', {method:'GET'})
    const result = await tempResult.json();
    return result
}

export async function updateNotification(newObject){
    const tempResult = await fetch('/notificationUpdate',{
        method:'POST',
        Accept: "application/json",
        "Content-Type": "application/json",
        body:newObject
    })
    const result = await tempResult.json()
    return result
}



//----------------------------------------------------------- EVENT LAUNCHER ------------------------------------------------------------//



