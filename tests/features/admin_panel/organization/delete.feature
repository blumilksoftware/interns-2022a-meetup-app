Feature: Deleting an organization

  Background:
    Given there are following organizations:
      | id | name                    | description            |
      | 1  | example organization    | existing organization  |
    And the administrator is logged in

  Scenario: Successfully deleting an organization
    Given the administrator is on the deleting organization page with organization id "1"
    When the administrator clicks on the delete organization button
    Then the administrator should see the message "Organization successfully deleted"
