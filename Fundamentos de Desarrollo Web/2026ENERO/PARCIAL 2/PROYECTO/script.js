let currentUser=null;
let users=[];

let products=[
{name:'Vestido rojo',price:200,img:'recursos/vestido_rojo.jpeg'},
{name:'Top floral',price:150,img:'recursos/top_floral.jpeg'},
{name:'Falda de flores',price:180,img:'recursos/falda.jpeg'},
{name:'Blusa de encaje',price:120,img:'recursos/blusa.jpeg'},
{name:'Collar de corazón',price:300,img:'recursos/collar.jpeg'}
];

let cart=[];
let ordersList=[]; 
let orderCount=1;

function show(id){
document.querySelectorAll('section').forEach(s=>s.classList.remove('active'));
document.getElementById(id).classList.add('active');
}

function goProfile(){
if(!currentUser){
showToast("Debes iniciar sesión");
show('login');
return;
}
renderProfile();
show('profile');
}

function goCart(){
if(!currentUser){
showToast("Debes iniciar sesión");
show('login');
return;
}
updateCart();
show('cart');
}

function render(){
homeCards.innerHTML='';
allProducts.innerHTML='';

products.forEach((p,i)=>{
let card=`<div class='card'>
<img src='${p.img}'>
<h3>${p.name}</h3>
<p>$${p.price}</p>
<button onclick='addCart(${i})'>Agregar</button>
</div>`;

if(i<4)homeCards.innerHTML+=card;
allProducts.innerHTML+=card;
});
}

function register(){
if(!regName.value || !regEmail.value || !regPass.value){
showToast("Completa todos los campos");
return;
}

users.push({
name: regName.value,
email: regEmail.value,
pass: regPass.value
});

showToast("Cuenta creada");
show('login');
}

function login(){
let user=users.find(u=>u.email===loginEmail.value && u.pass===loginPass.value);

if(!user){
showToast("Datos incorrectos");
return;
}

currentUser=user;
showToast("Bienvenida "+user.name);
goProfile();
}

function addCart(i){
if(!currentUser){
showToast("Inicia sesión primero");
show('login');
return;
}

cart.push(products[i]);
updateCart();
showToast("Agregado al carrito");
}

function removeFromCart(index){
cart.splice(index,1);
updateCart();
}

function updateCart(){
let cartContainer = document.getElementById("cartItems");
let totalText = document.getElementById("total");

cartContainer.innerHTML='';
let t=0;

cart.forEach((p,i)=>{
t+=p.price;

cartContainer.innerHTML+=`
<div class="card" style="display:flex;align-items:center;justify-content:space-between;">
<div style="display:flex;align-items:center;gap:10px;">
<img src="${p.img}" style="width:60px;height:60px;">
<div>
<p><b>${p.name}</b></p>
<p>$${p.price}</p>
</div>
</div>
<button onclick="removeFromCart(${i})">Eliminar</button>
</div>
`;
});

totalText.innerText='Total $'+t;
}

function openCheckout(){
if(cart.length==0){
showToast("Carrito vacío");
return;
}

let total=0;
cart.forEach(p=> total+=p.price);

let order={
num: orderCount++,
tracking:Math.floor(Math.random()*100000),
items:[...cart],
total: total
};

ordersList.push(order); 

cart=[];
updateCart();

showToast("Compra exitosa");
goProfile();
}

function renderProfile(){
let userInfoDiv = document.getElementById("userInfo");
let ordersDiv = document.getElementById("orders");

userInfoDiv.innerHTML=`<p>${currentUser.name}</p>`;
ordersDiv.innerHTML='';

ordersList.forEach(o=>{

let itemsHTML='';
o.items.forEach(p=>{
itemsHTML+=`
<div style="display:flex;align-items:center;gap:10px;margin:5px 0;">
<img src="${p.img}" style="width:50px;height:50px;">
<span>${p.name} - $${p.price}</span>
</div>
`;
});

ordersDiv.innerHTML+=`
<div class='card'>
<p><b>Pedido #${o.num}</b></p>
<p>Rastreo: ${o.tracking}</p>
${itemsHTML}
<p><b>Total: $${o.total}</b></p>
</div>
`;
});
}

function showToast(msg){
let toast=document.getElementById("toast");
toast.innerText=msg;
toast.classList.add("show");

setTimeout(()=>{
toast.classList.remove("show");
},3000);
}

render();
updateCart();