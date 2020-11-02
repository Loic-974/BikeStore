const TOKEN = {
    "X-CSRF-TOKEN": document.head.querySelector('meta[name="csrf-token"]'),
    "Content-Type": "application/json",
    Accept: "application/json",
    "X-Requested-With": "XMLHttpRequest"
};

const token = document.head.querySelector('meta[name="csrf-token"]')

let inputPwd = document.querySelector('#newPassword')
let buttonSubmit = document.querySelector('#validUpdate')


var oldPwd=null

inputPwd.onfocus= () =>{
        console.log('---------- Begin ------------')
        let result= new XMLHttpRequest(),
            method = "GET",
            overrideMimeType = "application/json",
            url = "/accueil/updatePwd";
        result.onreadystatechange = () => {
            if (
                result.readyState === XMLHttpRequest.DONE &&
                result.status === 200
            ) {           
                oldPwd=JSON.parse(result.response)
            }
        };
        result.open('GET', "/accueil/updatePwd", true);
        result.send();  
}

inputPwd.oninput= () =>{

    let newPwd = {newPassword: document.querySelector('#newPassword').value};
    let confirmPwd = document.querySelector('#confirmNewPassword').value;
    let result = new XMLHttpRequest(),
    method="POST",
    overrideMimeType='application/json',
    url= "/accueil/updatePwd"
    result.onreadystatechange = function checkPassword(){

        if (
            result.readyState === XMLHttpRequest.DONE &&
            result.status === 200
        ) {   
            console.log(newPwd.newPassword)
            if(oldPwd[0].password == newPwd.newPassword){
                console.log('test')
                document.querySelector('#newPassword').classList.add('error')
                document.querySelector('#newPassword').classList.remove('valid')
                document.querySelector('#errorUpdate').innerHTML='Changez le mot de passe'
                return false
            }       
            else{
                document.querySelector('#newPassword').classList.remove('error')
                document.querySelector('#newPassword').classList.add('valid')
                document.querySelector('#errorUpdate').innerHTML=''
                return true
            }
    }

    }
    result.open('POST', '/accueil', true); 
    result.setRequestHeader('X-CSRF-TOKEN',  token)
    result.setRequestHeader("Content-type", "application/json");
    result.send(JSON.stringify(newPwd));
 
}

document.querySelector('#confirmNewPassword').oninput=() =>{

    let newPwd = {newPassword: document.querySelector('#newPassword').value};
    let confirmPwd = document.querySelector('#confirmNewPassword').value;

    if(newPwd.newPassword != confirmPwd){

        document.querySelector('#confirmNewPassword').classList.add('error');
        document.querySelector('#confirmNewPassword').classList.remove('valid');
        document.querySelector('#errorUpdate').innerHTML='Le mot de passe n\'est pas identique';
    }else{
        document.querySelector('#confirmNewPassword').classList.add('valid');
        document.querySelector('#confirmNewPassword').classList.remove('error');
        document.querySelector('#errorUpdate').innerHTML='';
    }

}


