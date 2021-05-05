/// <reference types="Cypress" />

describe('The "View Asset Assignment" page with all options', () => {
    before(() => {
        cy.clearCookies();
        cy.clearWordPressCookies();
        cy.manualWordPressLogin();
        cy.visit('/dsps/quartermaster/asset-assignment/NThhYjdiYmMtZDQ5Yi00NWRjLTg5ZTgtZDZlMjVkZjcwNzMx0/');

        cy.get('#site-wide-navigation').invoke('css', 'display', 'none');
        cy.screenshot('view-asset-assignment-form');
        cy.get('#site-wide-navigation').invoke('css', 'display', null);
    });

    beforeEach(() => {
    });

    it('has a section called "Assignment Info"', () => {
        cy.get('#viewAssetAssignment')
          .find('h3')
          .contains('Assignment Info');
        
        cy.get('#viewAssetAssignment')
          .find('fieldset[id="assignmentInfo"]');
    });

    it('has a section called "Student Info"', () => {
        cy.get('#viewAssetAssignment')
          .find('h3')
          .contains('Student Info');
        
        cy.get('#viewAssetAssignment')
          .find('fieldset[id="studentInfo"]');
    });

    it('has a section called "Device Info"', () => {
        cy.get('#viewAssetAssignment')
          .find('h3')
          .contains('Device Info');
        
        cy.get('#viewAssetAssignment')
          .find('fieldset[id="deviceInfo"]');
    });

    it('has a section called "Additional Info"', () => {
        cy.get('#viewAssetAssignment')
          .find('h3')
          .contains('Additional Info');
        
        cy.get('#viewAssetAssignment')
          .find('fieldset[id="additionalInfo"]');
    });

    it('has a field called "Assigned By"', () => {
        cy.get('#viewAssetAssignment')
          .find('label')
          .contains('Assigned By');

        cy.get('#viewAssetAssignment')
          .find('input[id="assignedBy"]');
    });

    it('has a field called "School Code"', () => {
        cy.get('#viewAssetAssignment')
          .find('label')
          .contains('School Code');

        cy.get('#viewAssetAssignment')
          .find('input[id="assignedFromLocation"]');
    });

    it('has a field called "Date/Time Submitted"', () => {
        cy.get('#viewAssetAssignment')
          .find('label')
          .contains('Date/Time Submitted');

        cy.get('#viewAssetAssignment')
          .find('input[id="createdAt"]');
    });
});

describe('The "Assignment Info" section', () => {
    it('has a field called "Assignment Type"', () => {
      cy.get('#assignmentInfo')
      .find('label')
      .contains('Assignment Type');

      cy.get('#assignmentInfo')
        .find('input[name="isTemporary"]');
    });

    it('has a field called "Start Date"', () => {
      cy.get('#assignmentInfo')
      .find('label')
      .contains('Start Date');

      cy.get('#assignmentInfo')
        .find('input[id="startDate"]');
    });

    it('has a field called "End Date"', () => {
      cy.get('#assignmentInfo')
      .find('label')
      .contains('End Date');

      cy.get('#assignmentInfo')
        .find('input[id="endDate"]');
    });
});

describe('The "Student Info" section', () => {
    it('has a field called "Assigned To"', () => {
      cy.get('#studentInfo')
      .find('label')
      .contains('Assigned To');

      cy.get('#studentInfo')
        .find('input[id="assignedToPerson"]');
    });

    it('has a field called "Email"', () => {
      cy.get('#studentInfo')
      .find('label')
      .contains('Email');

      cy.get('#studentInfo')
        .find('input[id="assignedToPersonEmail"]');
    });

    it('has a field called "Student Number"', () => {
      cy.get('#studentInfo')
      .find('label')
      .contains('Student Number');

      cy.get('#studentInfo')
        .find('input[id="assignedToPersonNumber"]');

    });

    it('has a field called "Student Location"', () => {
      cy.get('#studentInfo')
      .find('label')
      .contains('Student Location');

      cy.get('#studentInfo')
        .find('input[id="assignedToPersonLocation"]');
    });

    it('has a field called "Received by"', () => {
      cy.get('#studentInfo')
      .find('label')
      .contains('Received by');

      cy.get('#studentInfo')
        .find('input[name="wasReceivedByAssignee"]');
    });

    it('has a field called "Received By Name"', () => {
      cy.get('#studentInfo')
      .find('label')
      .contains('Received By Name');

      cy.get('#studentInfo')
        .find('input[id="receivedBy"]');
    });

    it('has a field called "Relationship to Student"', () => {
      cy.get('#studentInfo')
      .find('label')
      .contains('Relationship to Student');

      cy.get('#studentInfo')
        .find('input[id="receivedByRole"]');
    });
});

describe('The "Device Info" section', () => {
    it('has a field called "Device Barcode"', () => {
      cy.get('#deviceInfo')
      .find('label')
      .contains('Device Barcode');

      cy.get('#deviceInfo')
        .find('input[id="assetID"]');
    });

    it('has a field called "Serial Number"', () => {
      cy.get('#deviceInfo')
      .find('label')
      .contains('Serial Number');

      cy.get('#deviceInfo')
        .find('input[id="assetSerialNumber"]');
    });

    it('has a field called "Device Type"', () => {
      cy.get('#deviceInfo')
      .find('label')
      .contains('Device Type');

      cy.get('#deviceInfo')
        .find('input[id="assetType"]');
    });

    it('has a field called "Device Location"', () => {
      cy.get('#deviceInfo')
      .find('label')
      .contains('Device Location');

      cy.get('#deviceInfo')
        .find('input[id="assetLocation"]');
    });
});

describe('The "Additional Info" section', () => {
    it('has a field called "Peripherals Provided"', () => {
      cy.get('#additionalInfo')
      .find('label')
      .contains('Peripherals Provided');

      cy.get('#additionalInfo')
        .find('input[id="untrackedAssestsIncluded"]');
    });

    it('has a field called "Notes"', () => {
      cy.get('#additionalInfo')
      .find('label')
      .contains('Notes');

      cy.get('#additionalInfo')
        .find('input[id="notes"]');
    });
});

describe('The field "Assignment Type"', () => {
    xit('has an option called "Open-ended"', () => {
      cy.get('#assignmentInfo')
        .find('input[id="isTemporaryFalse"]');
    });
    xit('has an option called "End-dated"', () => {
      cy.get('#assignmentInfo')
        .find('input[id="isTemporaryTrue"]');
    });
});

describe('The field "End Date"', () => {
    xit('is not visible on first load', () => {

    });
    xit('becomes visible when "Assignment Type" is "End-dated"', () => {

    });
    xit('is hidden when "Assignment Type" is "Open-ended"', () => {

    });
});

describe('The field "Received by"', () => {
    xit('has an option called "Student"', () => {

    });
    xit('has an option called "Other"', () => {

    });
});

describe('The field "Received By Name"', () => {
    xit('is not visible on first load', () => {

    });
    xit('becomes visible when "Received by" is "Other"', () => {

    });
    xit('is hidden when "Received by" is "Student"', () => {

    });
});

describe('The field "Relationship to Student"', () => {
    xit('is not visible on first load', () => {

    });
    xit('becomes visible when "Received by" is "Other"', () => {

    });
    xit('is hidden when "Received by" is "Student"', () => {

    });
});

describe('The field "Device Location"', () => {
    xit('is not editable', () => {

    });
    xit('is pre-populated with the currrent school code in uppercase', () => {

    });
    xit('is not part of the tab order for the form', () => {

    });
});

describe('The field "Assigned By"', () => {
    xit('is not be editable', () => {

    });
    xit("is pre-populated with the user's email address", () => {

    });
    xit('is not part of the tab order for the form', () => {

    });
});

describe('The field "School Code"', () => {
    xit('is not editable', () => {

    });
    xit('is pre-populated with the current school code in uppercase', () => {

    });
    xit('is not part of the tab order for the form', () => {

    });
});

describe('The field "Date/Time Submitted"', () => {
    xit('is not editable', () => {

    });
    xit('is pre-populated with the current date and time in the format YYYY-MM-DD HH:MM::SS', () => {

    });
    xit('is not part of the tab order for the form', () => {

    });
});
