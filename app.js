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
function getValue (id){
    const elem = document.getElementById(id)
}
// const student = new Student(
// )
const submitBtn = document.querySelector('[type="submit"]')
submitBtn.addEventListener('click' ,(e) => {
    e.preventDefault()
    console.log(document.getElementById('name').value)
})