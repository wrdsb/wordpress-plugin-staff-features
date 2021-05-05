// ***********************************************
// This example commands.js shows you how to
// create various custom commands and overwrite
// existing commands.
//
// For more comprehensive examples of custom
// commands please read more here:
// https://on.cypress.io/custom-commands
// ***********************************************
//
//
// -- This is a parent command --
// Cypress.Commands.add('login', (email, password) => { ... })
//
//
// -- This is a child command --
// Cypress.Commands.add('drag', { prevSubject: 'element'}, (subject, options) => { ... })
//
//
// -- This is a dual command --
// Cypress.Commands.add('dismiss', { prevSubject: 'optional'}, (subject, options) => { ... })
//
//
// -- This will overwrite an existing command --
// Cypress.Commands.overwrite('visit', (originalFn, url, options) => { ... })

// See https://stackoverflow.com/questions/63636329/login-to-wordpress-using-cypress-without-using-the-ui
Cypress.Commands.add("clearWordPressCookies", () => {

    // Empty defaults
    Cypress.Cookies.defaults({
        preserve: []
    });

    //Clear localStrage
    cy.clearLocalStorage()

    //Clear Cookies
    cy.clearCookies()

    // Set defaults
    Cypress.Cookies.defaults({
        preserve: /wordpress_.*|woocommerce_.*|wp_woocommerce_.*/
    })
});

// https://gist.github.com/wpscholar/6a874778c6cab84515b7fa1dceb7a0bf
Cypress.Commands.add("manualWordPressLogin", () => {
    cy.clearWordPressCookies();
    cy.visit(Cypress.env('dashboardUrl'));

    cy.get('body')
        .then(($body) => {
            if ($body.text().includes('Howdy')) {
                return;
            } else {
                cy.get('#user_login').wait(200).type(Cypress.env('users').admin.username, { force: true });
                cy.get('#user_pass').wait(200).type(Cypress.env('users').admin.pw, { force: true });
                cy.get('#wp-submit').click();
                cy.get('h1').contains('Dashboard');
            }
        })
});
