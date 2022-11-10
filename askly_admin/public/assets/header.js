let b = document.body;
let largeur = window.innerWidth;
console.log(largeur);

function removeImage(){ 
    let imgheader = document.getElementsByClassName('box-header');
    // imgheader.style.display = "none";
    console.log(imgheader);
    imgheader.style.backgroundColor = "red";
}

if(largeur<800){
    console.log('Problème de responsive');
    removeImage();
}