import React, { Component } from 'react';
import { Navbar, Nav, NavItem, ListGroup, ListGroupItem, Button, Jumbotron } from 'react-bootstrap';
import Home from './home.js'


function About(props) {
  return (
    <Jumbotron style={{ padding: ' 10% 10%' }}>
      <h1>Hello, world!</h1>
      <p>
        This is a simple hero unit, a simple jumbotron-style component for calling
        extra attention to featured content or information.
      </p>
      <p>
        <Button bsStyle="primary">Learn more</Button>
      </p>
    </Jumbotron>
  )
}

class BlogNav extends Component {
  constructor(props) {
    super(props);
    this.state = {
      tab: 'home',
      data: [],
      dataId: 'all'
    }

  }
  handleTabChange = (e) => {
    this.setState({
      tab: e.target.name
    });
  }

  getData = (props) => {
    this.setState({
      data: props
    })
  }

  selectData = (id) => {
    this.setState({
      dataId: id
    })
  }
  render() {
    const tab = this.state.tab;
    return (
      <>
        <Navbar inverse collapseOnSelect >
          <Navbar.Header>
            <Navbar.Brand>
              Blog
            </Navbar.Brand>
            <Navbar.Toggle />
          </Navbar.Header>
          <Navbar.Collapse>
            <Nav>
              <NavItem eventKey={1} name='home' tab={tab} onClick={this.handleTabChange}>
                Home
              </NavItem>
              <NavItem eventKey={2} name='about' onClick={this.handleTabChange}>
                About
            </NavItem>
            </Nav>
          </Navbar.Collapse>
        </Navbar>
        <ListGroup >
          {tab === 'home' && <Home getData={this.getData} data={this.state.data} selectData={this.selectData} dataId={this.state.dataId} />}
          {tab === 'about' && <About />}
        </ListGroup>
      </>
    );
  }
}

export default BlogNav;
