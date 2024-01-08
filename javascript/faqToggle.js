let faq = document.querySelectorAll('.content')

faq.forEach(question => {
  question.addEventListener('click', (e) => {
    question.classList.toggle('active')
    const answer = question.children[1]
    if (question.classList.contains('active')){
      answer.style.maxHeight = answer.scrollHeight + "px";
    }else{
      answer.style.maxHeight = 0;
    }
  })
})

