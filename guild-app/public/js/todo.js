document.addEventListener('DOMContentLoaded', function(){
    const todoList = document.getElementById("todo-list");
    const addTodoButton = document.getElementById("add-todo");
    const deletedTodosInput = document.getElementById("deleted_todos");

    let deletedTodos = [];

    addTodoButton.addEventListener("click", function(){
        const todoCount = document.querySelectorAll(".todo-item").length + 1;

        const newTodo = document.createElement("div");
        newTodo.classList.add("todo-item");
        newTodo.innerHTML = `
            <label for="todo" class="form-label">To Do ${todoCount}</label>
            <div class="position-relative">
                <input type="hidden" name="todos[${todoCount}][id]" value="">
                <input type="text" name="todos[${todoCount}][content]" class="form-control mb-4" value="">
                <button type="button" class="btn btn-sm remove-todo position-absolute end-0 top-50 translate-middle-y">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        `;

        todoList.appendChild(newTodo);
    });

    todoList.addEventListener("click", function(event){
        const removeBtn = event.target.closest(".remove-todo");
        if(removeBtn){
            const todoItem = removeBtn.closest(".todo-item");
            const todoIdInput = todoItem.querySelector("input[name*='[id]']");

            if(todoIdInput && todoIdInput.value){
                deletedTodos.push(todoIdInput.value);
                deletedTodosInput.value = deletedTodos.join(',');
            }
            todoItem.remove();

            if(document.querySelectorAll(".todo-item").length === 0){
                const emptyInput = document.createElement("input");
                emptyInput.type = "hidden";
                emptyInput.name = "todos[0][content]";
                emptyInput.value = "";

                todoList.appendChild(emptyInput);
            }
        }
    });
});
