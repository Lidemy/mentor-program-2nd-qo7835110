import React, { Component } from 'react';
import { ListGroupItem, Button } from 'react-bootstrap';
import axios from 'axios';


class Home extends Component {
    //利用 AXIOS 取得 JSON
    sendData = (props) => {
        this.props.getData(props)
    }
    //切換進入文章細節
    changeData = (id) => {
        this.props.selectData(id)
    }
    //回到全文章列表
    goBack = () => {
        this.props.selectData('all')
    }
    componentDidMount() {
        axios.get('https://jsonplaceholder.typicode.com/posts')
            .then((res) => {
                this.sendData(res.data)
            })
    }
    componentWillUnmount() {
        this.goBack();
    }
    render() {
        return (
            <div>
                <ListGroupItem header='Home'></ListGroupItem>
                {this.props.dataId === 'all' && (this.props.data.map((item) => {
                    return (
                        <ListGroupItem key={item.id} onClick={() => (this.changeData(item.id))}>{item.title}</ListGroupItem>
                    )
                }))}
                {this.props.dataId !== 'all' && (
                    this.props.data.filter((item) => {
                        return item.id === this.props.dataId
                    }).map((item) => {
                        return (
                            <div key={item.id} >
                                <Button bsStyle='primary' onClick={this.goBack}>GO BACK</Button>
                                <ListGroupItem>{item.title}</ListGroupItem>
                                <ListGroupItem>{item.body}</ListGroupItem>
                            </div>
                        )
                    })
                )}
            </div>
        )
    }
}
export default Home;
