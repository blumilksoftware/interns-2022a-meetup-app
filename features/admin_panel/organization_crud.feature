Feature: Organization CRUD operations
  In order to managing organizations
  As a admin user
  I want to be able to use CRUD operations for organization

  Background:
    Given there are following organization
      | id | name                    | description            |
      | 1  | example organization    | existing organization  |
    And I am logged in as admin

  Scenario Outline: Creating new organization
    Given I am on the create organization page
    When I fill the "name" with <name>
    And I fill the "description" with <description>
    Then new organization with matching data should be created
    And I should see message "Organization was created"
    Examples:
      | name                     | description          |
      | test organization        | new organization     |

  Scenario Outline: Updating organization
    Given I am on the update organization page with organization id equals <id>
    When I change the "name" with <name>
    And I change the "description" with <description>
    Then I should see updating organization with matching data
    And I should see message "Organization was updated"
    Examples:
      | id | name                    | description          |
      | 1  | updated organization    | updated organization  |
