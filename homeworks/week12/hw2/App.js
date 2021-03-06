import React, { Component } from 'react';
import './App.css';
import Rules from './rule.js';

function Square(props) {
  return (
    <button className="square" onClick={props.onClick}>
      {props.value}
    </button>
  );
}
/*
*/
function BoardRow(props) {
  return (
    <div className="board-row">
      {props.value}
    </div>
  )
}

class Board extends React.Component {

  renderSquare(i) {

    return (
      <Square
        value={this.props.squares[i]}
        onClick={() => this.props.onClick(i)}
      />
    );
  }
  render19Square(rowIndex) {
    let array = [];
    for (let i = 0; i < 19; i++) {
      array.push(i)
    }
    return (
      array.map((index) => {
        let num = (19 * rowIndex) + index;
        return (
          <Square
            key={num}
            value={this.props.squares[num]}
            onClick={() => this.props.onClick(num)}
          />
        )
      })
    )
  }
  renderBoardRow() {
    let array = [];
    for (let i = 0; i < 19; i++) {
      array.push(i)
    }
    return (
      array.map((index) => {
        return (
          <BoardRow key={index} value={this.render19Square(index)} >
          </BoardRow>
        )
      })
    )
  }
  render() {
    return (
      <div>
        {this.renderBoardRow()}
      </div>
    );
  }
}

class Game extends React.Component {
  constructor(props) {
    super(props);
    this.state = {
      history: [
        { squares: Array(361).fill(null) }
      ],
      xIsNext: true,
      stepNumber: 0,
    }
  }
  jumpTo(step) {
    this.setState({
      stepNumber: step,
      xIsNext: (step % 2) ? false : true
    });
  }
  handleClick(i) {
    const history = this.state.history.slice(0, this.state.stepNumber + 1);
    const current = history[history.length - 1];
    const squares = current.squares.slice();
    if (calculateWinner(squares) || squares[i]) {
      return;
    }
    squares[i] = this.state.xIsNext ? 'X' : 'O';
    this.setState({
      history: history.concat([{
        squares: squares
      }]),
      stepNumber: history.length,
      xIsNext: !this.state.xIsNext,
    })
  }
  render() {
    const history = this.state.history;
    const current = history[this.state.stepNumber];
    const winner = calculateWinner(current.squares);
    const moves = history.map((step, move) => {
      const desc = move ?
        'Move #' + move :
        'Game Start';
      return (
        <li key={move}>
          <a href='#' onClick={() => { this.jumpTo(move) }}>{desc}</a>
        </li>
      )
    })

    let status;
    if (winner) {
      status = 'Winner: ' + winner;
    } else {
      status = 'Next player: ' + (this.state.xIsNext ? 'X' : 'O');
    }
    return (
      <div className="game" >
        <div className="game-board">
          <Board
            squares={current.squares}
            onClick={(i) => this.handleClick(i)}
          />
        </div>
        <div className="game-info">
          <div>{status}</div>
          <ol>{moves}</ol>
        </div>
      </div>
    );
  }
}

// ========================================

function calculateWinner(squares) {
  const lines = Rules();
  for (let i = 0; i < lines.length; i++) {
    const [a, b, c, d, e] = lines[i];
    if (squares[a] && squares[a] === squares[b] && squares[a] === squares[c] && squares[a] === squares[d] && squares[a] === squares[e]) {
      return squares[a];
    }
  }
  return null;
}


export default Game;
