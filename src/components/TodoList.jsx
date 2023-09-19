import {useState, useEffect} from "react";
import '../css/TodoList.css';
import todos from '../assets/todos.png'
import Todo from "./Todo.jsx";

export default function TodoList() {

  const listStorage = localStorage.getItem('Lista');

  const [list, setLista] = useState(listStorage ? JSON.parse(listStorage) : []);
  const [novoItem, setNovoItem] = useState("");

  useEffect(() => {
    localStorage.setItem('Lista', JSON.stringify(list))
  }, [list])

  function adicionaItem(form) {
    form.preventDefault();
    if (!novoItem) return;

    setLista([...list, {text: novoItem, isCompleted: false}]);
    setNovoItem("");
    document.getElementById('input-entrada').focus()
  }

  function handleCompleted(index) {
    const listAux = [...list];
    listAux[index].isCompleted = !listAux[index].isCompleted;
    setLista(listAux);
  }

  function handleDelete(index) {
    const listAux = [...list];
    listAux.splice(index, 1);
    setLista(listAux);
  }

  function handleDeleteAll() {
    setLista([]);
  }

  return (
    <div>
      <h1>Todo List</h1>

      <form onSubmit={adicionaItem}>
        <input
          id="input-entrada"
          type="text"
          value={novoItem}
          onChange={(e) => setNovoItem(e.target.value)}
          placeholder="Adicione uma tarefa"
        />
        <button className="add" type="submit">Add</button>
      </form>

      <div className="listaTarefas" style={{textAlign: 'center'}}>
        {list.length < 1
          ? (
            <div>
              <img style={{maxWidth: "100%"}} src={todos} alt="Todo image"></img>
            </div>
          )
          : list.map((item, index) => (
            <Todo
              key={index} item={item}
              handleCompleted={() => handleCompleted(index)}
              handleDelete={() => handleDelete(index)}
            />
          ))
        }
        <div style={{textAlign: 'center'}}>

        </div>
        {
          list.length > 0
          && (
            <button onClick={() => handleDeleteAll()} className="deleteAll">Deletar todos</button>
          )
        }
      </div>
    </div>
  )
}

