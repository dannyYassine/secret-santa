
export class Address {
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
    this.streetNumber = props.streetNumber;
    this.streetName = props.streetName;
    this.city = props.city;
    this.postalCode = props.postalCode;
  }
  
}