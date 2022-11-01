Feature: Access to the admin panel

  Scenario: Successfully have access to admin panel
    Given the administrator is logged in
    When the administrator is on the admin panel route
    Then the administrator should see the admin panel page

  Scenario: Attempt to get to admin panel as authenticated non-administrator user
    Given the user is logged in
    But the user is not an administrator
    When the user is on the admin panel route
    Then the user should see "You are not allowed to access this page"

  Scenario: Attempt to get to admin panel as unauthenticated user
    Given the user is logged in
    When the user is on the admin panel route
    Then the user should be redirected to the login page
