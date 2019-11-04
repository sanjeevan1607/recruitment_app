import React, { Component } from "react";
import { Link, Redirect } from "react-router-dom";

import { connect } from "react-redux";

import { registerUser } from "../actions/UserActions";

class Login extends Component {
  state = {
    user: null,
    userName: "",
    password: "",
    first_name: "",
    last_name: ""
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
    if (type == "first_name") {
      this.setState({ first_name: event.target.value });
    }
    if (type == "last_name") {
      this.setState({ last_name: event.target.value });
    }
  }

  // submit login function
  submitRegister() {
    this.props.dispatch(
      registerUser("api/user/register", {
        email: this.state.email,
        password: this.state.password,
        first_name: this.state.first_name,
        last_name: this.state.last_name
      })
    );
  }

  render() {
    let self = this;

    let { user, password, email, first_name, last_name } = self.state;

    console.log(user);

    return (
      <div className="row">
        <form>
          <div className="form-group">
            <label htmlFor="first_name">First Name</label>
            <input
              type="text"
              className="form-control"
              id="first_name"
              placeholder="First Name"
              value={first_name}
              onChange={this.handleChange.bind(this, "first_name")}
            ></input>
          </div>

          <div className="form-group">
            <label htmlFor="last_name">Last Name</label>
            <input
              type="text"
              className="form-control"
              id="last_name"
              placeholder="Last Name"
              value={last_name}
              onChange={this.handleChange.bind(this, "last_name")}
            ></input>
          </div>

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

          <div
            className="btn btn-primary"
            onClick={this.submitRegister.bind(this)}
          >
            Register
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
