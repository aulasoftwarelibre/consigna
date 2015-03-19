@login
Feature: User identification
    In order to access to consigna
    As a consigna user
    I want to get identification with a login form

    Background:
        Given existing users:
            | username    | email             | plainPassword | enabled  |
            | user1       | user1@uco.es      | secret1       | 1        |
            | user2       | user2@uco.es      | secret2       | 1        |

    Scenario: Login with an existing user
        Given I am on "/login"
        When I fill in "username" with "user1"
        And I fill in "password" with "secret1"
        And I press "submit"
        Then I should be on the homepage
        And I should see "Sign out"

    Scenario: Login with a non existing user
        Given I am on "/login"
        When I fill in "username" with "user3"
        And I fill in "password" with "secret"
        And I press "submit"
        Then I should see "Bad credentials"
