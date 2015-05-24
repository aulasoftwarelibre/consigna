@items
Feature: manage items
  In order to get and to share items
  As a consigna user
  I want to manage items
  Background:
    Given existing users:
      | username    | email             | plainPassword | enabled  |
      | user1       | user1@uco.es      | secret1       | 1        |
      | user2       | user2@uco.es      | secret2       | 1        |
      | user3       | user3@uco.es      | secret3       | 1        |

    And existing tags:
      | tagName |
      | tag1    |
      | tag2    |

    And existing folders:
      | folderName  | username  | userWithAccess | tags |
      | folder1     | user1     | user2          | tag1 |
      | folder2     | user2     | null           | tag2 |
      | folder3     | user3     | null           | tag1, tag2 |

    And existing files:
      | filename  | username    | folder      | userWithAccess | tags |
      | file1     | user1       | folder1     |      user1     | tag1 |
      | test.pdf  | user3       | null        |      null      | tag2 |
      | file3     | null        | null        |      null      | null |

    And I am authenticated as "user1" with "secret1"

  Scenario: List elements in a folder
      Given I am on the main folder
      And I am authenticated as "user1" with "secret1"
      And "user1" has access to "folder1"
      When I follow "folder1"
      Then I should be on "en/folder/folder1"
      And I should see 1 elements

  Scenario: Access to a protected folder
      Given I am on the main folder
      And I am authenticated as "user3" with "secret3"
      When I follow "folder1"
      Then I should see "Password"
      When I fill in "Password" with "secret"
      And I press "Check password"
      Then access is granted to "user3" in "folder1"
      Then I should be on "en/folder/folder1"

  @javascript
  Scenario: Upload a file
    Given I am on the main folder
    Then I should be on the main folder
    When I follow "Upload file"
    Then I should be now on "file_upload"
    When I attach the file "~/Descargas/test2.pdf" to "File"
    And I fill in "Tags" with "tag2"
    And I fill in "Password" with "secret4"
    And I fill in "Repeat password" with "secret4"
    And I press "Upload"
    Then I should see 6 elements
    And I should see "File test2.pdf has been uploaded successfully"

  Scenario: Download a file
    Given I am on the main folder
    When I follow "Download test.pdf"
    Then I should see "Download file"
    When I fill in "Password" with "secret"
    And I press "Check password"
    Then access is granted to "user1" in file "test.pdf"
    And I should see "valid"
    When I follow "Download test.pdf"
    Then I should see response status code "200"
    And I should see in the header "content-type":"application/pdf"

  @javascript
  Scenario: Create a folder
    Given I am on the main folder
    When I follow "New folder"
    Then I should be now on "folder_new"
    When I fill in "Name" with "folder4"
    And I fill in "Tags" with "tag2"
    And I fill in "Password" with "secret4"
    And I fill in "Repeat password" with "secret4"
    And I press "Create folder"
    Then I should see 6 elements
    Then I should see "Folder folder4 has been created successfully"

