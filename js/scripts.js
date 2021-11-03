let getUrl=window.location.href;
console.log(getUrl);

let home="http://localhost/Projetos/Sismolt/home.php";

let viewLogEcad= document.querySelector('#navLogar');
let viewSair= document.querySelector('#navSair');
let viewPrevencoes= document.querySelector('#navPrevencoes');
if(getUrl == home) {
    viewSair.style.display='block';
    viewLogEcad.style.display='none';
    viewPrevencoes.style.display='none';
    console.log("OK");
}