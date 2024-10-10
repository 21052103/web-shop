const btnLike = document.querySelector('.btn-like');
const id = btnLike.getAttribute('data-productId');
btnLike.addEventListener('click' ,function (){{
like(id);
} 
    
})
async function like(id) {
    const url = '../API/like-product.php';
    const response = await fetch(url, {
        method: 'POST',
        body: JSON.stringify({
            
            id: id
        })
    });
    if (response.ok) {
        const data = await response.json();
        console.log(data);
        let viewlike = document.querySelector('.view-like');
        viewlike.textContent = data.likes;
        
        
        

    }
    
    
}