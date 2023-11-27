const form = document.getElementById('form')
const username = document.getElementById('username')
const password = document.getElementById('password')
const confirmPassword = document.getElementById('confirm-password')
const passwordRegex = /^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{6,16}$/

form.addEventListener('submit', (e) =>{
    e.preventDefault()
    checkInputs()
})

function checkInputs(){
    const usernameValue = username.value.trim()
    const passwordValue = password.value.trim()
    const passwordConfirmValue = confirmPassword.value.trim()
    if(usernameValue === ''){
        setError(username, 'Please enter username')
    }else{
        setSuccess(username)
    }
    if(passwordValue === ''){
        setError(password, 'Your password is invalid')
    }else if(!passwordRegex.test(passwordValue)){
        setError(password, 'Your password must contain ')
    }
    else{
        setSuccess(password)
    }
    if(passwordConfirmValue === ''){
        setError(confirmPassword, 'This field cannot be blank')
    }else if(passwordConfirmValue !== passwordValue){
        setError(confirmPassword, 'Passwords does not match')
    }else{
        setSuccess(confirmPassword)
    }
}
function setError(element, msg){
    const field = element.parentElement
    const alert = field.querySelector('small')
    alert.innerText = msg
    field.className =  'form-field error'
}   

function setSuccess(element){
    const field = element.parentElement
    field.className =  'form-field success'
}