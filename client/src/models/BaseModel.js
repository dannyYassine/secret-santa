import { v4 as uuidv4 } from 'uuid';

export class BaseModel {
  
  /**
   * @type string
   */
  id;
  
  constructor(props = {}) {
    this.id = uuidv4();
  }
}