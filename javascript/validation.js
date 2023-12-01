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
