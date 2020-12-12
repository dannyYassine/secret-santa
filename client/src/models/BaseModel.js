import { v4 as uuidv4 } from 'uuid';
import { assign } from 'lodash';

export class BaseModel {
  
  /**
   * @type string
   */
  id;
  
  constructor(props = {}) {
    assign(this, props);
    
    this.id = uuidv4();
  }
}