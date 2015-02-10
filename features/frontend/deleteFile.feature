@sprint1
  Feature: Delete File
    In order to delete a file of the system
    As a consigna user

  Background:
    Given existing users:
     |username     |email             |plainPassword   |enabled |
     |juanan       |jamartinez@uco.es |paquete          |  1     |
     |sergio       |sergio@uco.es     |putoamo          |  1     |
     |anonimo      |anonimo@uco.es    |putoamo          |  1     |

    And I am authenticated as "juanan"

    And existing files:
    |filename  |  uploadDate   | password  | username |
    |fichero1  |  2014/12/27   | pfichero1 | juanan   |
    |fichero2  |  2014/12/28   | pfichero2 | sergio   |
    |fichero3  |  2014/12/29   | pfichero3 | anonimo  |


    Scenario: Delete my own file
      Given I am on the homepage
      Then  I should see "Sign out"
      When I follow "Eliminar fichero1"
      Then I should see "fichero2"
      And I should see "fichero3"

    Scenario: Delete file which is not mine.
      Given I am on the homepage
      Then I should not see "Eliminar fichero1"
      And  I should not see "Eliminar fichero3"
