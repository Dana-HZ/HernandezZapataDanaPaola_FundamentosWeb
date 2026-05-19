function showToast(msg){
let toast=document.getElementById("toast");

if(!toast){
    return;
}

toast.innerText=msg;
toast.classList.add("show");

setTimeout(()=>{
toast.classList.remove("show");
},3000);
}

