import { Address } from '/@/models/Address';
import { BaseModel } from '@/models/BaseModel';

export class Friend extends BaseModel {
  /**
   * @type string
   */
  name;
  
  /**
   * @type string
   */
  email;
  
  /**
   * @type Address
   */
  address;
  
  constructor(props = {}) {
    super(props);
    this.name = props.name;
    this.email = props.email;
    this.address = props.address ? new Address(props.address) : new Address();
  }
}