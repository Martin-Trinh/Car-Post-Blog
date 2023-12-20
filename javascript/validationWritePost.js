const titlePost = document.getElementById('title-post')
const category = document.getElementById('category')
const bodyText = document.getElementById('article-body')
const file = document.getElementById('thumbnail')
const form = document.getElementById('form')

form.addEventListener('submit', e => {

    titlePostValue = titlePost.value.trim()
    bodyTextValue = bodyText.value.trim()
    categoryValue = category.value

    if (titlePostValue === '') {
        setError(titlePost, 'Title post cannot be empty!')
        e.preventDefault()
    } else {
        setSuccess(titlePost)
    }

    if (categoryValue === '') {
        setError(category, 'Please select category')
        e.preventDefault()
    } else {
        setSuccess(category)
    }

    let words = bodyTextValue.split(/\s+/)

    if (words.length < 10) {
        setError(bodyText, 'Text must be more than 10 words')
        e.preventDefault()
    } else {
        setSuccess(bodyText)
    }

    // if (!file.files.length) {
    //     setError(file, 'Please upload a file')
    //     e.preventDefault()
    // } else {
    //     setSuccess(file)
    // }
})
