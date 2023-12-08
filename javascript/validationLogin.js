const usernameField = document.getElementById('username')
const passwordField = document.getElementById('password')
const form = document.getElementById('form')

form.addEventListener('submit', (e)=>{
    
    const usernameValue = usernameField.value.trim()
    const passwordValue = passwordField.value.trim()
    
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
} )

