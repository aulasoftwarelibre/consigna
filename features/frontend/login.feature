@login
Feature: User identification
    In order to access to consigna
    As a consigna user
    I want to get identification with a login form

    Background:
        Given existing organizations:
            | name                  | code      | enabled       |
            | Organization A        | a.org     | true          |
            | Organization B        | b.org     | false         |
        Given existing users:
            | username    | email            | plainPassword | enabled  | organization |
            | user1       | user1@a.org      | secret1       | 1        | a.org        |
            | user2       | user2@b.org      | secret2       | 1        | b.org        |
            | user3       | user3@b.org      | secret3       | 0        | b.org        |

    Scenario: Login with an existing user
        Given I am on "/login"
        When I fill in "username" with "user1"
        And I fill in "password" with "secret1"
        And I press "Login"
        Then I should be on the homepage
        And I should see "Logout"

    Scenario: Login with a non existing user
        Given I am on "/login"
        When I fill in "username" with "user4"
        And I fill in "password" with "secret"
        And I press "Login"
        Then I should see "Bad credentials"

    Scenario: Login with a disabled user
        Given I am on "/login"
        When I fill in "username" with "user3"
        And I fill in "password" with "secret3"
        And I press "Login"
        Then I should see "Account is disabled"

    Scenario: Login with an user from a disabled organization
        Given I am on "/login"
        When I fill in "username" with "user2"
        And I fill in "password" with "secret2"
        And I press "Login"
        Then I should see "login.organization_disabled"
