let images = ["public/images/asphalt8.png", "public/images/genshin.png", "public/images/pubg.png", "public/images/elder.png"];
let index = 0;
let timeoutId;

function changeImage() {
    let img = document.querySelector('.pic-large img');
    img.setAttribute('src', images[index]);
    index = (index + 1) % images.length;
    // Clear the previous timeout and set a new one
    clearTimeout(timeoutId);
    timeoutId = setTimeout(changeImage, 2000);
}
// Initial call to start the image change
changeImage();

