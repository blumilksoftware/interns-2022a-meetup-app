Feature: Adding a user to admin panel

  Background:
    Given the administrator is logged in
    And the administrator is on the page with invitation form

  Scenario Successfully send invitation to unregistered user
    Given the invited user doesn't have an account
    When the administrator fills in "email" with "firstuser@example.com"
    And the administrator sends the form
    Then the administrator should see "Successfully send invitation"
    And the invited user should get an invitation link on "firstuser@example.com"

  Scenario: An administrator fills in invited user email field with invalid email
    When the administrator fills in "email" with "wrongemail@"
    And the administrator sends the form
    Then the administrator should see "Invalid email"

  Scenario: An administrator sends the form with empty invited user email field
    When the administrator sends the form
    Then the administrator should see "Email field is required"

  Scenario: The invited user is already an administrator
    Given the user with "existingadmin@example.com" email address is already an administrator
    When the administrator fills in "email" with "existingadmin@example.com"
    And the administrator sends the form
    Then the administrator should see the message "This user is already an administrator"

  Scenario: Successfully send invitation to already registered user
    Given There is a user with "firstuser@example.com" email address
    And the invited user is not an administrator yet
    When the administrator fills in "email" with "firstuser@example.com"
    And the administrator sends the form
    Then the administrator should see "Successfully send invitation"
    And invited user should get an invitation link on "firstuser@example.com"
