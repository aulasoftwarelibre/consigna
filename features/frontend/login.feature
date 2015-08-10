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

    Scenario: Login with an existing user
        Given I am on "/login"
        When I fill in "username" with "user1"
        And I fill in "password" with "secret1"
        And I press "Login"
        Then I should be on the homepage
        And I should see "Logout"

    Scenario: Login with a non existing user
        Given I am on "/login"
        When I fill in "username" with "user3"
        And I fill in "password" with "secret"
        And I press "Login"
        Then I should see "Bad credentials"
