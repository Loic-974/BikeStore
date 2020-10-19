// const { add } = require("lodash");

var form = document.querySelector("#loginForm");

let mailInput = document.querySelector('input[name="emailLogin"]');
let pwdInput =  document.querySelector('input[name="mdpLogin"]');
let error = document.querySelectorAll(".errorForm");

const regMail =/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/

    function checkMail(value) {

        if ( regMail.test(value)) {
            error[0].innerHTML="";
            mailInput.classList.remove("error");
            mailInput.classList.add("valid");;
            return true
        } else {
            error[0].innerHTML="Votre Mail est incorrect";
            mailInput.classList.remove("valid");
            mailInput.classList.add("error");
            return false
        }
    }




