
export class AppPageobject {
  
  visit() {
    cy.visit(`${Cypress.env('CLIENT_URL') || 'http://localhost:3000'}`);
  }
  
  getAddFriendButton() {
    return cy.get('[data-e2e="add-friend"]');
  }
  
  getSendInvitesButton() {
    return cy.get('[data-e2e="send-invites"]');
  }
  
  getFriendNameInput(index = 0) {
    return cy.get('[data-e2e="friend-input-name"]').eq(index);
  }
  
  getFriendEmailInput(index = 0) {
    return cy.get('[data-e2e="friend-input-email"]').eq(index);
  }
}