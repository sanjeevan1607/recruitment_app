import axios from 'axios';

/**
 * Create Axios Instance
 */
export function getAxiosInstance () {
  const instance = axios.create();
  return instance;
}
