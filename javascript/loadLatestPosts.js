async function loadPage(page = 1){
    try{
        const res = await fetch(`../controller/latestPostController.php?page=${page}`)
        const data = await res.json()

        const pageLinks = document.querySelector('.pagination')
        const postContainer = document.querySelector('.latest-list')
        pageLinks.innerHTML = data.pageLinks
        postContainer.innerHTML = data.postsHtml

        const links = document.querySelectorAll('.pagination a');
        for(let i = 0; i < links.length; i++){
            links[i].addEventListener('click', function (e){
                e.preventDefault()
                let page
                if(this.innerHTML === 'Prev'){
                    page = data.pageNum - 1
                }else if(this.innerHTML === 'Next'){
                    page = data.pageNum + 1
                }else{
                    page = parseInt(links[i].innerHTML)
                }
                loadPage(page)
            })
        }
    }catch(error){
        console.error('Error: ', error)
    }
    
}
    
loadPage()