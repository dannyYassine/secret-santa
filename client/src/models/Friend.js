import { Address } from '/@/models/Address';

export class Friend {
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
    this.name = props.name;
    this.email = props.email;
    this.address = props.address ? new Address(props.address) : null;
  }
}