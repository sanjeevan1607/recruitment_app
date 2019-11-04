
import { getAxiosInstance } from '../config/axiosSettings';

// Get logged user id from local storage
const getLoggedUserId = () => {
  return window.localStorage.getItem("userId");
};

// Remove token from local storage
const removeToken = () => {
  return localStorage.clear();
};

/**
 * User Register
 * @param {String} url 
 * @param {Object} data 
 */
export function loginUser(url, data) {
  const instance = getAxiosInstance();

  const request = instance
    .post(`http://127.0.0.1:8000/${url}`, data)
    .then(response => { 
      return response.data})
    .catch(error => error.response);

  return {
    type: "USER_LOGIN",
    payload:request
  };
}

/**
 * Register User
 * @param {String} url 
 * @param {Object} data 
 */
export function registerUser(url, data) {
  const instance = getAxiosInstance();

  const request = instance
    .post(`http://127.0.0.1:8000/${url}`, data)
    .then(response => { 
      return response.data})
    .catch(error => error.response);

  return {
    type: "USER_REGISTER",
    payload:request
  };
}

