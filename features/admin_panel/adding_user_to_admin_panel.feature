Feature:
  In order to add user to admin panel
  As an admin user
  I want to send email to user with invitation link

  Background:
    Given I logged in as an admin user
    And I am on the page with invitation form

  Scenario Outline: Successfully send invitation
    Given invited user is not an admin yet
    When I fill "email" with <email>
    And I send the form
    Then I should see "Successfully send invitation"
    And invited user should get an invitation link on <email>
    Examples:
    | email                     |
    | firstuser@example.com     |

  Scenario Outline: Invited user already are admin
    Given user with <email> already are admin user
    When I fill "email" with <email>
    And I send the form
    Then I should see message "This user already are admin user"
    Examples:
      | email                         |
      | existingadmin@example.com     |