
const texto = document.querySelector("input");
const tareas = document.querySelector(".Tareas")


   function crearTarea(){
    const tarea = document.createElement("div");
    const textoTarea = document.createElement("p"); 
    const botones = document.createElement("div");
    const completar = document.createElement("button");
    const eliminar = document.createElement("button");

    textoTarea.textContent = texto.value;
    tarea.classList.add("Tarea");
    botones.classList.add("Botones");
    completar.classList.add("Completar");
    eliminar.classList.add("Eliminar"); 

  completar.onclick = function(){
    tarea.classList.toggle("Tarea_Completa");
};

eliminar.onclick = function(){
    tarea.remove();
};

    botones.appendChild(completar);
    botones.appendChild(eliminar);
    tarea.appendChild(textoTarea);
    tarea.appendChild(botones);
    tareas.appendChild(tarea);
}