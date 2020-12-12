/// <reference types="cypress" />
// ***********************************************************
// This example plugins/index.js can be used to load plugins
//
// You can change the location of this file or turn off loading
// the plugins file with the 'pluginsFile' configuration option.
//
// You can read more here:
// https://on.cypress.io/plugins-guide
// ***********************************************************

// This function is called when a project is opened or re-opened (e.g. due to
// the project's config changing)

// https://docs.cypress.io/guides/guides/plugins-guide.html
module.exports = (on, config) => {
  return {
    ...config,
    fixturesFolder: 'config/cypress/fixtures',
    integrationFolder: 'config/cypress/integration',
    screenshotsFolder: 'config/cypress/screenshots',
    videosFolder: 'config/cypress/videos',
    supportFile: 'config/cypress/support/index.js'
  };
};
