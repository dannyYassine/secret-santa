
export class Env {
  static isProd() {
    return document.location.hostname === 'virtual-secret-santa.web.app';
  }
}