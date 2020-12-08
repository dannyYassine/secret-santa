import axios from 'axios';
import { Config } from '@/config';

export const apiAxios = axios.create({
  baseURL: `${Config.api}/api`
});

export const rootAxios = axios.create({
  baseURL: `${Config.api}`
});