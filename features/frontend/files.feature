@files
Feature: List files
    In order to know what files are in consigna
    As a consigna user
    I want to get the list of files
    Background:
        Given existing users:
            | username    | email             | plainPassword | enabled  |
            | user1       | user1@uco.es      | secret1       | 1        |
            | user2       | user2@uco.es      | secret2       | 1        |

        And existing files:
            | filename  |   uploadDate   | username    |
            | file1     |   2014/12/27   | user1       |
            | file2     |   2014/12/28   | user2       |
            | file3     |   2014/12/29   | null        |

    @sprint1
    Scenario: List files
        Given I am on the homepage
        Then  I should see 3 files

    @sprint1
    Scenario: List files by logged user
        Given I am authenticated as "user1" with "secret1"
        When I follow "Your files"
        Then I should be on "/my-files/"
        And I should see 1 files

    @sprint1
    Scenario Outline: Search files by name
        Given I am on the homepage
        When I fill in "search-button" with "<word>"
        And I press "Submit"
        Then I should see <number> files

        Examples:
            | word      | number    |
            | file1     | 1         |
            | file      | 3         |
            | nothing   | 0         |
