Feature: Access to admin panel
  In order to managing app
  As an admin user
  I want to see admin panel

  Scenario: I have access to admin panel
    Given I am logged in as an admin user
    When I get to admin panel route
    Then I should see admin panel page

  Scenario: Unauthorized access
    Given I am not logged in as an admin user
    When I get to admin panel route
    Then I should see "You do not have access"