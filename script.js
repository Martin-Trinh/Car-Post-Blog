function loadDoc(){
    const xhttp = new XMLHttpRequest()
    xhttp.onload = function() {
      console.log(this.responseText)
    }
    xhttp.open('GET', 'https://zwa.toad.cz/passwords.txt', true)
    xhttp.send()
  }
// loadDoc()

url = 'https://zwa.toad.cz/passwords.txt'

fetch(url)
.then((res)=>{
    // const response = res.json()
    console.log(res.text)
})
.catch((e)=>{
    console.log(e)
})