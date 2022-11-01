Feature: Creating an organization

  Background:
    Given the administrator is logged in
    And the administrator is on the create organization page

  Scenario Outline: Successfully creating an organization
    When the administrator fills in "name" with "<name>"
    And the administrator fills in "description" with "<description>"
    And the administrator sends the form
    Then the organization with following data should be created:
      | name                 | <name>                 |
      | description          | <description>          |

    And the administrator should see the message "Organization successfully created"
    Examples:
      | name                     | description          |
      | test organization        | new organization     |

  Scenario: Attempt to create an organization without credentials
    When the administrator sends the form
    Then the administrator should see the message "Name field is required"
