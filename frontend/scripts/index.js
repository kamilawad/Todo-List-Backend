const form = document.getElementById("form");
const addBtn = document.getElementById('add-todo');

addBtn.addEventListener("click", addTodo);

form.addEventListener("submit",(e)=>{
  e.preventDefault();
  if(form.username.value == "AdminSEF123" && form.pass.value == "SeF@ctORy$$456"){
    window.location.href = "../frontend/pages/main.html";
  } else{
      alert("wrong credentials");
  }
});

function generateTodo(todo) {
    return `<p class="paragraph">${todo}</p>
            <div>
              <button class="delete"><i class="fa-solid fa-delete-left"></i></button>
              <button class="complete"><i class="fa-solid fa-check"></i></button>
            </div>`
}
  
function addTodo() {
    const todo = document.getElementById('newTodo').value;
    if (todo) {
      const li = document.createElement('li');
      li.innerHTML = generateTodo(todo);
      li.classList.add('flex', 'row', 'justify-between');
      document.getElementById('todoList').appendChild(li);
      document.getElementById('newTodo').value = '';
      addButtonsEvents(li);
    }
}

addBtn.addEventListener("click", addTodo);

function addButtonsEvents(li) {
const deleteButton = li.querySelector('.delete');
    deleteButton.addEventListener("click", function() {
    this.parentElement.parentElement.remove();
    });
    const completeButton = li.querySelector('.complete');
    completeButton.addEventListener("click", function () {
    const p = li.querySelector('.paragraph');
    p.classList.add('completed');
    });
}