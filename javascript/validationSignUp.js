const usernameField = document.getElementById('username')
const passwordField = document.getElementById('password')
const confirmPasswordField = document.getElementById('confirm-password')

const form = document.getElementById('form')

form.addEventListener('submit', (e)=>{
    const usernameValue = usernameField.value.trim()
    const passwordValue = passwordField.value.trim()
    const confirmPassValue = confirmPasswordField.value.trim()
    
    if(usernameValue === ''){
        setError(usernameField, 'Please enter username')
        e.preventDefault()
    }else {
        setSuccess(usernameField)
    }
    if(passwordValue === ''){
        setError(passwordField, 'Please enter password')
        e.preventDefault()
    }else{
        setSuccess(passwordField)
    }
    if(confirmPassValue === ''){
        setError(confirmPasswordField, 'Please confirm your password')
        e.preventDefault()
    }else if(passwordValue !== confirmPassValue){
        setError(passwordField, 'Passwords does not match')
        setError(confirmPasswordField, 'Passwords does not match')
        e.preventDefault()
    }
    else{
        setSuccess(confirmPasswordField)
    }

} )
