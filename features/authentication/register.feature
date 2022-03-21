Feature: Register to app

  Scenario Outline: Register with valid data
    When I fill "email" with <email>
    And I fill "password" with <password>
    And I fill "name" with <name>
    Then I have successfully sign up
    And I should get an email on <email>
    Examples:
      | email                    | password        | name          |
      | existinguser@example.com | correctpassword | existinguser  |

  Scenario: Register using existing email
    Given there are following users
      | email                    | password        |
      | existinguser@example.com | password        |
    When I fill "email" with "existinguser@example.com"
    And I fill "password" with "password"
    Then I should see message "User with this email actually exist"