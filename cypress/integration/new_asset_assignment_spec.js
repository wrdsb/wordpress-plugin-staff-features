/// <reference types="Cypress" />

describe('The "New Asset Assignment" page', () => {
    beforeEach(() => {
        cy.visit('/dsps/quartermaster/asset-assignment/new')
    });

    it('has a section called "Assignment Info"', () => {
        cy.get('#newAssetAssignment')
          .find('h3')
          .contains('Assignment Info')
        
        cy.get('#newAssetAssignment')
          .find('fieldset[id="assignmentInfo"]')
    });
    it('has a section called "Student Info"', () => {
        expect(true).to.equal(true)
    });
    it('has a section called "Device Info"', () => {
        expect(true).to.equal(true)
    });
    it('has a section called "Additional Info"', () => {
        expect(true).to.equal(true)
    });
    it('has a field called "Assigned By"', () => {
        expect(true).to.equal(true)
    });
    it('has a field called "School Code"', () => {
        expect(true).to.equal(true)
    });
    it('has a field called "Date/Time Submitted"', () => {
        expect(true).to.equal(true)
    });
});

describe('The "Assignment Info" section', () => {
    it('has a field called "Assignment Type"', () => {

    });
    it('has a field called "Start Date"', () => {

    });
    it('has a field called "End Date"', () => {

    });
});


describe('The "Student Info" section should', () => {
    it('has a field called "Assigned To"', () => {
        cy.get('#assignedToPerson')
    });
    it('has a field called "Email"', () => {

    });
    it('has a field called "Student Number"', () => {

    });
    it('has a field called "Student Location"', () => {

    });
    it('has a field called "Received by"', () => {

    });
    it('has a field called "Received By Name"', () => {

    });
    it('has a field called "Relationship to Student"', () => {

    });
});

describe('The "Device Info" section should', () => {
    it('has a field called "Device Barcode"', () => {

    });
    it('has a field called "Serial Number"', () => {

    });
    it('has a field called "Device Type"', () => {

    });
    it('has a field called "Device Location"', () => {

    });
});

describe('The "Additional Info" section should', () => {
    it('has a field called "Peripherals Provided"', () => {

    });
    it('has a field called "Notes"', () => {

    });
});

describe('The field "Assignment Type" should', () => {
    it('has an option called "Open-ended"', () => {

    });
    it('has an option called "End-dated"', () => {

    });
});

describe('The field End Date should', () => {
    it('is not visible', () => {

    });
});

describe('The field "Received by" should', () => {
    it('has an option called "Student"', () => {

    });
    it('has an option called "Other"', () => {

    });
});

describe('The field "Received By Name" should', () => {
    it('is not visible', () => {

    });
});

describe('The field "Relationship to Student" should', () => {
    it('not be visible', () => {

    });
});

describe('The field "Device Location" should', () => {
    it('not be editable', () => {

    });
    it('be pre-populated with the currrent school code in uppercase', () => {

    });
    it('not be part of the tab order for the form', () => {

    });
});

describe('The field "Assigned By" should', () => {
    it('not be editable', () => {

    });
    it("be pre-populated with the user's email address", () => {

    });
    it('not be part of the tab order for the form', () => {

    });
});

describe('The field "School Code" should', () => {
    it('not be editable', () => {

    });
    it('be pre-populated with the current school code in uppercase', () => {

    });
    it('not be part of the tab order for the form', () => {

    });
});

describe('The field "Date/Time Submitted" should', () => {
    it('not be editable', () => {

    });
    it('be pre-populated with the current date and time in the format YYYY-MM-DD HH:MM::SS', () => {

    });
    it('not be part of the tab order for the form', () => {

    });
});
