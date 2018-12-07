import React, { Component } from 'react';
import './App.scss';

class Todos extends Component {
  removeTodo = () => {
    this.props.delete(this.props.todo)

  }
  render() {
    return (
      <li className={this.props.todo.check ? 'todolist__ul__item-finished' : 'todolist__ul__item'} >
        <Checkbox checkClick={this.props.checkClick} todo={this.props.todo} num={this.props.num} />
        <span className="todolist__ul__item-content">
          {this.props.todo.value}
        </span>
        <button className="todolist__ul__item-btn" onClick={this.removeTodo} >X</button>
      </li>
    )
  }
}

class Checkbox extends Component {
  checkClick = () => {
    this.props.checkClick(this.props.num)
  }
  render() {
    return (
      <button
        onClick={this.checkClick}
        className={this.props.todo.check ? 'todolist__ul__item-checkbox' : 'todolist__ul__item-checkbox-finished'}
      >
        {this.props.todo.check ? '完成' : '未完成'}
      </button>
    )
  }
}

class ChangList extends Component {
  changeAll = () => {
    this.props.change('all')
  }
  changeUnfinished = () => {
    this.props.change('unfinished')
  }
  changeFinished = () => {
    this.props.change('finished')
  }
  render() {
    return (
      <div className="todolist__change-list">
        <button onClick={this.changeAll}>全部</button>
        <button onClick={this.changeUnfinished}>未完成</button>
        <button onClick={this.changeFinished}>完成</button>
      </div>

    )
  }
}
//////////////////////////////////////
class App extends React.Component {
  constructor(props) {
    super(props);
    this.state = {
      todoValue: '',
      todoArray: [],
      changeState: 'all',
    }
    this.TodoChange = this.TodoChange.bind(this);
    this.AddTodo = this.AddTodo.bind(this);
    this.id = 0;
    this.checked = false;
  }
  TodoChange(e) {
    let value = e.target.value;
    this.setState({
      todoValue: value
    })
  }
  AddTodo() {
    let value = this.state.todoValue.trim();
    if (value) {
      this.setState({
        todoArray: [...this.state.todoArray, { value: value, check: false, id: this.id++ }],
        todoValue: ''
      })
    }
  }
  deleteClick = (item) => {
    this.setState({
      todoArray: this.state.todoArray.filter((todo) => todo.id !== item.id)
    })

  }
  handleClick = (index) => {
    let array = [...this.state.todoArray];
    array[index].check = !array[index].check;
    this.setState({
      todoArray: array
    })
  }
  changeState = (i) => {
    this.setState({
      changeState: i
    })
  }

  render() {

    return (
      <div className="todolist" >
        <span>Todo:</span>
        <input className="todolist__todo-value" value={this.state.todoValue} onChange={this.TodoChange} />
        <button className="todolist__btn" onClick={this.AddTodo}>click</button>
        <ChangList change={this.changeState} />
        <ul className="todolist__ul">
          {this.state.todoArray.map((item, index) => {
            if (this.state.changeState === 'all') {
              return (
                <div key={item.value + index}>
                  <Todos
                    todo={item}
                    delete={this.deleteClick}
                    checkClick={this.handleClick}
                    num={index}>
                  </Todos>
                </div >
              )
            }
            else if (this.state.changeState === 'unfinished' && !item.check) {
              return (
                <div key={item.value + index}>
                  <Todos
                    todo={item}
                    delete={this.deleteClick}
                    checkClick={this.handleClick}
                    num={index}>
                  </Todos>
                </div >
              )
            }
            else if (this.state.changeState === 'finished' && item.check) {
              return (
                <div key={item.value + index}>
                  <Todos
                    todo={item}
                    delete={this.deleteClick}
                    checkClick={this.handleClick}
                    num={index}>
                  </Todos>
                </div >
              )
            }
            //出現警告一定要在箭頭函數結束加一個 return (Expected to return a value at the end of arrow function  array-callback-return)
            return null
          })}
        </ul>
      </div>
    )
  }
}

export default App;
