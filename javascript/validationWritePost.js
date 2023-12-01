const titlePost = document.getElementById('title-post')
const bodyText = document.getElementById('article-body')
const form = document.getElementById('form')

form.addEventListener('submit', e => {
    e.preventDefault()
    titlePostValue = titlePost.value.trim()
    bodyTextValue  = bodyText.value.trim()
    if(titlePostValue === ''){
        setError(titlePost, 'Title post cannot be empty!')
    }else{
        setSuccess(titlePost)
    }
    let words = bodyTextValue.split(/\s+/)
    if (words.length < 10){
        setError(bodyText, 'Text must be more than 10 words')
    }else{
        setSuccess(bodyText)
    }
})
