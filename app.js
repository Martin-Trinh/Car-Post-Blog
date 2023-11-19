class Student{
    constructor(name, surname, password, id, faculty, studyPlan){
        this.name = name
        this.surname = surname
        this.password = password
        this.id = id
        this.faculty = faculty
        this.studyPlan = studyPlan
    }
}
const submitBtn = document.querySelector('[type="submit"]')
// const submitBtn = document.querySelector('#submit')
const form = document.querySelector('#studentForm')
submitBtn.addEventListener('click' ,(e) => {
    e.preventDefault()
    const student = new Student(
        document.getElementById('name').value,
        document.getElementById('surname').value,
        document.getElementById('password').value,
        document.getElementById('id-person').value,
        document.getElementById('faculty').value,
        document.getElementById('study-plan').value,
    )
    console.log(student)
    // console.log(`Name: ${document.getElementById('name').value}`)
    // console.log(`Surname: ${document.getElementById('surname').value}`)
    // console.log(`password: ${document.getElementById('password').value}`)
    // console.log(`id: ${document.getElementById('id-person').value}`)
    // console.log(`faculty: ${document.getElementById('faculty').value}`)
    // console.log(`Study Plan: ${document.getElementById('study-plan').value}`)
})
function loadDoc(){
    const req = new XMLHttpRequest()
    req.onload = function() {
        const res = this.responseText
        const passwordArr = res.split('\n')

        const passwordField = document.getElementById('password')
        passwordField.addEventListener('keyup', () =>{
            let warning = document.querySelector('.warning')
            if(warning)
                warning.remove()
            if (passwordArr.findIndex(pass => passwordField.value === pass) != -1){
                let warning = document.createElement('div')
                warning.className = 'warning'
                warning.style.color = 'Red'
                warning.textContent = 'Your password is on blacklist, try another one'
                passwordField.insertAdjacentElement('afterend', warning)
            }
      })
    }
    req.onerror = function(){
        console.log('Cannot load password!')
    }
    req.open('GET', 'https://zwa.toad.cz/passwords.txt', true)
    req.send()
}

loadDoc()