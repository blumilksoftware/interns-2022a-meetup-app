Feature: Logging to app

  Background:
    Given there are following users:
      | email                    | password        |
      | existinguser@example.com | correctpassword |

  Scenario Outline: Attempt to log in with correct credentials
    When I fill "email" with <email>
    And I "password" with <password>
    Then I successfully logged in
    Examples:
      | email                    | password        |
      | existinguser@example.com | correctpassword |

  Scenario Outline: Attempt to log in with wrong password
    When I fill "email" with <email>
    And I fill "password" with <password>
    Then I should see message "bad credentials"
    Examples:
      | email                       | password           |
      | existinguser@example.com    | wrongpassword      |

  Scenario Outline: Attempt to log in as unregistered user
    When I fill "email" with <email>
    And I fill "password" with <password>
    Then I should see message "bad credentials"
    Examples:
      | email                       | password           |
      | nonexistinguser@example.com | password           |
