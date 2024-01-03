const notifications = document.querySelector('.notifications')

if(notifications !== null){
    const toasts = document.querySelectorAll('.toast')
    toasts.forEach(toast =>{
        const xMark = toast.querySelector('.fa-xmark')
        xMark.addEventListener('click', () =>{
            xMark.parentNode.remove()
            // console.log(notifications.childElementCount)
        })
    })

}
