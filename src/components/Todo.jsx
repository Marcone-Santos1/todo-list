import * as PropTypes from "prop-types";
import '../css/Todo.css';

Todo.propTypes = {
  item: PropTypes.object,
  handleCompleted: PropTypes.func,
  handleDelete: PropTypes.func
};
export default function Todo({handleCompleted, handleDelete, item}) {
  return (
    <div className={item.isCompleted ? "item completo" : "item"}>
      <span onClick={handleCompleted}>{item.text}</span>
      <button onClick={handleDelete} className="del">Deletar</button>
    </div>
  )
}