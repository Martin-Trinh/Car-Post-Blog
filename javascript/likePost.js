document.addEventListener('DOMContentLoaded', () =>{
    const likeBtn = document.getElementById('likePost')
    likeBtn.addEventListener('click', ()=>{
        let data = {
            post_id : likeBtn.dataset.postId
        }
        fetch('controller/likeController.php', {
            method: 'POST',
            headers: {
                'Content-Type' : 'application/json'
            },
            body: JSON.stringify(data)
        })
        .then((res)=>{
            if(!res.ok)
                throw new Error('Bad Response from server')
            return res.json();
        })
        .then((res)=>{
            likeBtn.nextElementSibling.innerHTML = res.likes + ' Likes'
        })
        .catch(err =>{console.error('Error:', err)})
    })
})