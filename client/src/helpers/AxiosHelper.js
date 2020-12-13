import axios from 'axios';
import { camelizeKeys, decamelizeKeys } from 'humps';
import { Config } from '@/config';

export const apiAxios = axios.create({
  baseURL: `${Config.api}/api`
});

export const rootAxios = axios.create({
  baseURL: `${Config.api}`
});

export const apiRequestInterceptor = (request) => {
  if (request.data instanceof FormData) {
    request.method = 'post';
  }
  // Convert api request from camelCase to snake_case
  if (request.data) {
    request.data = decamelizeKeys(request.data);
  }
  return request;
};

export const apiResponseInterceptor = (response) => {
  let { data } = response;
  
  if (data && response.headers && response.headers['content-type'] === 'application/json') {
    response.data = camelizeKeys(data);
  }
  
  return response;
};

apiAxios.interceptors.response.use(apiResponseInterceptor);
apiAxios.interceptors.request.use(apiRequestInterceptor);