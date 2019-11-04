import React, { Component } from "react";
import { Link, Redirect } from "react-router-dom";

import { connect } from "react-redux";

import { loginUser } from "../actions/UserActions";

class Login extends Component {
  state = {
    user: null,
    userName: "",
    password: ""
  };

  componentDidMount() {}

  componentDidUpdate(prevProps) {
    const { user } = this.props;
    if (prevProps.user !== this.props.user) {
      this.setState({
        user
      });
    }
  }

  // trigger on text change on  event
  handleChange(type, event) {
    if (type == "password") {
      this.setState({ password: event.target.value });
    }

    if (type == "email") {
      this.setState({ email: event.target.value });
    }
  }

  // submit login function
  submitLogin() {

    this.props.dispatch(
      loginUser("api/user/login", {
        email: this.state.email,
        password: this.state.password
      })
    );

  }

  render() {
    let self = this;

    let { user, password, email } = self.state;

    console.log(email);

    return (
      <div className="row">
        <form>
          <div className="form-group">
            <label htmlFor="exampleInputEmail1">Email address</label>
            <input
              type="email"
              className="form-control"
              id="exampleInputEmail1"
              aria-describedby="emailHelp"
              placeholder="Enter email"
              value={email}
              onChange={this.handleChange.bind(this, "email")}
            ></input>
            <small id="emailHelp" className="form-text text-muted">
              We'll never share your email with anyone else.
            </small>
          </div>
          <div className="form-group">
            <label htmlFor="exampleInputPassword1">Password</label>
            <input
              type="password"
              className="form-control"
              id="exampleInputPassword1"
              placeholder="Password"
              value={password}
              onChange={this.handleChange.bind(this, "password")}
            ></input>
          </div>
          <div className="form-group form-check">
            <input
              type="checkbox"
              className="form-check-input"
              id="exampleCheck1"
            ></input>
            <label className="form-check-label" htmlFor="exampleCheck1">
              Check me out
            </label>
          </div>
          <div
            className="btn btn-primary"
            onClick={this.submitLogin.bind(this)}
          >
            Login
          </div>
        </form>
      </div>
    );
  }
}

const mapStateToProps = state => {
  return {
    user: state.user
  };
};

export default connect(mapStateToProps)(Login);
