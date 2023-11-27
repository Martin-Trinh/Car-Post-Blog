const themeBtn = document.getElementById('color-switch')
themeBtn.addEventListener('click', () =>{
  if(themeBtn.checked){
    document.body.classList.add('light-theme')
  }else{
    document.body.classList.remove('light-theme')
  }
})