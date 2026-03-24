
const menu = document.querySelector("nav");


function toogle(){
    if(menu.classList.contains("open")){
        menu.classList.remove("open")
    }else{
        menu.classList.add("open")
    }
}