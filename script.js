let input = document.getElementById("input");
let list = document.getElementById("list");
let clear = document.querySelector(".clear");

let LIST = []
    , id = 0;

let data = localStorage.getItem("TODO");

if(data){
  LIST = JSON.parse(data);
  id = LIST.length;
  loadList(LIST);
}else{
  LIST = [];
  id = 0;
}

function loadList(array){
  array.forEach(function(item){
    addToDo(item.name, item.id, item.trash);
  });
}

clear.addEventListener("click", function(){
  localStorage.clear();
  location.reload();
});


function addToDo(toDo, id, done, trash){

  if(trash){return;}

  let item = `<li class="item">
               <p class="text">${toDo}</p>
               <i class="closeCross" job="close" id="${id}"></i>
              </li>
            `;
  let position = "beforeend";

  list.insertAdjacentHTML(position,item);
}

document.addEventListener("keyup", function(event){
  if(event.keyCode == 13){

    let toDo = input.value;

    if(toDo){
      addToDo(toDo,id,false,false);

      LIST.push({
        name : toDo,
        id : id,
        done : false,
        trash : false
      });

      localStorage.setItem("TODO", JSON.stringify(LIST));

      id++;
    }
    input.value = "";
  }
});

function removeToDo(element){
  element.parentNode.parentNode.removeChild(element.parentNode);

  LIST[element.id].trash = true;
}

list.addEventListener("click", function(event){
  let element = event.target;
  let elementJob = element.attributes.job.value;

  if(elementJob == "close"){
    removeToDo(element);
  }

  localStorage.setItem("TODO", JSON.stringify(LIST));


})


