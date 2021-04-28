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
    cy.clearCookie('wordpress_a8b94154380982c3184a469b8aa525c6');
    cy.clearCookie('wordpress_a8b94154380982c3184a469b8aa525c6');
    cy.clearCookie('wordpress_logged_in_a8b94154380982c3184a469b8aa525c6');
    cy.clearCookie('wordpress_test_cookie');
});

Cypress.Commands.add("getWordPressCookies", () => {
    cy.getCookies()
        .then((cookies) => {
            cy.writeFile('adminUserLoginCookiesFromCypress.json', cookies);
        });
});

Cypress.Commands.add("setWordPressCookies", () => {
    cy.readFile('adminUserLoginCookiesFromCypress.json')
        .then((cookies) => {
            cookies.forEach((cookie) => {
                // cy.log( JSON.stringify( cookie ) ); // See the cookie contents
                cy.setCookie(cookie.name, cookie.value, {
                    domain: Cypress.env('domain'),
                    path: cookie.path,
                    secure: cookie.secure,
                    httpOnly: cookie.httpOnly,
                    expiry: cookie.expiry
                });
            });
        });
});

Cypress.Commands.add("manualWordPressLogin", () => {
    cy.clearWordPressCookies();
    cy.visit(Cypress.env('dashboardUrl'));
    cy.get('#user_login').wait(200).type(Cypress.env('users').admin.username, { force: true });
    cy.get('#user_pass').wait(200).type(Cypress.env('users').admin.pw, { force: true });
    cy.get('#wp-submit').click();
    cy.get('h1').contains('Dashboard');
});


// https://gist.github.com/wpscholar/6a874778c6cab84515b7fa1dceb7a0bf
// https://www.lance.bio/2018/05/26/cypress-io-wordpress-login/