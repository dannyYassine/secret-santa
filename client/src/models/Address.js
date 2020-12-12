import { BaseModel } from '@/models/BaseModel';

export class Address extends BaseModel {
  /**
   * @type string
   */
  streetNumber;
  
  /**
   * @type string
   */
  streetName;
  
  /**
   * @type string
   */
  city;
  
  /**
   * @type string
   */
  postalCode;
  
  constructor(props = {}) {
    super(props);
    this.streetNumber = props.streetNumber;
    this.streetName = props.streetName;
    this.city = props.city;
    this.postalCode = props.postalCode;
  }
  
}