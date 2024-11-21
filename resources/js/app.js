import './bootstrap';
import inputmask from 'inputmask';

document.addEventListener("DOMContentLoaded",()=>{


    let telMK = new inputmask("(99) 9 9999-9999");
    telMK.mask(document.querySelector('#telefone'));
    let precoMK = new inputmask("99,99");
    precoMK,mask(document.querySelector("#preco"));
})

document.addEventListener("DOMContentLoaded",()=>{
    let precoMK = new inputmask("99,99");
    precoMK,mask(document.querySelector("#preco"));
})



const btnSenha = document.querySelector('#btnSenha');
const input = document.querySelector('#senha');
const input1 = document.querySelector('#senha1');
const btnLogin = document.querySelector('#btnLogin')
const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/;
btnSenha.addEventListener('click',(e)=>{
    e.preventDefault();
    if (input.type=='password') {
        input.type = 'text'
        input1.type = 'text'

    }
    else{
        input.type = 'password'
        input1.type = 'password'
    }





});



