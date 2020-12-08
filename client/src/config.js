import { Env } from '/@/env';

export class Config {
  static get api() {
    return Env.isProd() ? 'https://dannyyassine-secret-santa.herokuapp.com' : 'http://localhost:8000'
  }
}