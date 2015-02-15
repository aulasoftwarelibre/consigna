@files
Feature: Delete files
    In order to free used space
    As a consigna user
    I want to delete my files
    Background:
        Given existing users:
            | username    | email             | plainPassword | enabled  |
            | user1       | user1@uco.es      | secret1       | 1        |
            | user2       | user2@uco.es      | secret2       | 1        |
        And I am authenticated as "user1" with "secret1"
        And existing files:
            | filename  | uploadDate   | username    | slug     |
            | file1     | 2014/12/27   | user1       | file1    |
            | file2     | 2014/12/28   | user2       | file2    |
            | file3     | 2014/12/29   | null        | file3    |

    @sprint1
    Scenario: Remove my own file
        Given I am on the homepage
        When I follow "Delete file1"
        Then I should see "File deleted successfully"
        And I should see 2 files

    @sprint1
    Scenario: Remove file from another user
        Given I am authenticated as "user2" with "secret2"
        And I am on "/file/file1/delete/"
        Then I should see "Access Denied"


