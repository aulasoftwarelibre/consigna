@delete
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
        And existing tags:
            | tagName |
            | tag1    |
            | tag2    |
        And existing files:
            | filename  |   uploadDate   | username    | folder      | userWithAccess | tags |
            | file1     |   2014/12/27   | user1       | folder1     |      user1     | tag1 |
            | file2     |   2014/12/28   | user2       | null        |      null      | tag2 |
            | file3     |   2014/12/29   | null        | folder2     |      null      | null |
        And existing folders:
            | folderName  |   uploadDate   | username    | description   | slug    | password |userWithAccess | tags |
            | folder1     |   2014/12/27   | user1       | description1  | folder1 | secret   |user2          | tag1 |
            | folder2     |   2014/12/28   | user2       | description2  | folder2 | secret   |null           | tag2 |
            | folder3     |   2014/12/29   | null        | description3  | folder3 | secret   |null           | null |



    Scenario: Remove my own file
        Given I am on the homepage
        When I follow "Delete file1"
        Then I should see "File deleted successfully"
        And I should see 5 elements

    Scenario: Remove file from another user
        Given I am authenticated as "user2" with "secret2"
        And I am on "/file/file1/delete"
        Then I should see "Access Denied"

    Scenario: Remove my own folder
        Given I am authenticated as "user2" with "secret2"
        When I follow "Delete folder2"
        Then I should see "Folder deleted successfully"
        And I should see 5 elements