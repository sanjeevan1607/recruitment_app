import React, { Component } from "react";
import {
  BrowserRouter as Router,
  Route,
  Redirect,
  Link
} from "react-router-dom";

import Login from "./Containers/Login";
import Register from "./Containers/Register";

class App extends Component {
  render() {
    return (
      <div className="container-fluid">
        <Router>
          <Route exact path="/" />
          <Route path="/login" component={Login} />
          <Route path="/register" component={Register} />
        </Router>
      </div>
    );
  }
}

export default App;
