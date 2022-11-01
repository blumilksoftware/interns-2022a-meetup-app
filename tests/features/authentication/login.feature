Feature: User logging

  Background:
    Given there are following users:
      | email                    | password        |
      | existinguser@example.com | correctpassword |
    And the user is on the login page

  Scenario Outline: Attempt to log in with correct credentials
    When the user fills in "email" with "<email>"
    And the user fills in "password" with "<password>"
    Then the user has successfully logged in
    Examples:
      | email                    | password        |
      | existinguser@example.com | correctpassword |

  Scenario Outline: Attempt to log in with wrong password
    When the user fills in "email" with "<email>"
    And the user fills in "password" with "<password>"
    Then the user should see message "bad credentials"
    Examples:
      | email                       | password           |
      | existinguser@example.com    | wrongpassword      |

  Scenario Outline: Attempt to log in as unregistered user
    When the user fills in "email" with "<email>"
    And the user fills in "password" with "<password>"
    Then the user should see the message "bad credentials"
    Examples:
      | email                       | password           |
      | nonexistinguser@example.com | password           |

  Scenario: Attempt to log in without data
    When the user submits form
    Then the user should see "email field is required"
    And the user should see "password field is required"
