import { AppPageobject } from './pageobjects/App.pageobject';

context('Send invites Page', () => {
  it('should send invites with at least 3 friends', () => {
    cy.server()
    cy.route('POST', '/api/distribute').as('distribute')
    
    const appPageObject = new AppPageobject();
  
    appPageObject.visit();
    
    appPageObject.getAddFriendButton().click();
  
    appPageObject.getFriendNameInput().type('Danny');
    appPageObject.getFriendEmailInput().type('dannyyassine@gmail.com');
  
    appPageObject.getAddFriendButton().click();
  
    appPageObject.getFriendNameInput(1).type('Danny1');
    appPageObject.getFriendEmailInput(1).type('dannyyassine+1@gmail.com');
  
    appPageObject.getSendInvitesButton().click();
  
    cy.wait('@distribute');
  
    cy.get('@distribute').should(request => expect(request.status).to.equal(200));
  });
})