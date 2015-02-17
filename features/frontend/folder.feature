@folder
Feature: List folders
  In order to know what folders are in consigna
  As a consigna user
  I want to get the list of folders

  Background:
    Given existing users:
      | username    | email             | plainPassword | enabled  |
      | user1       | user1@uco.es      | secret1       | 1        |
      | user2       | user2@uco.es      | secret2       | 1        |

    And existing folders:
      | folderName  |   uploadDate   | username    | description   |
      | folder1     |   2014/12/27   | user1       | description1  |
      | folder2     |   2014/12/28   | user2       | description2  |
      | folder3     |   2014/12/29   | null        | description3  |


  @sprint2
  Scenario: List files
    Given I am on the homepage
    Then  I should see 3 folders
