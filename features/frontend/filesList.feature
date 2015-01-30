@sprint1
  Feature: List files
    In order to know what files are in consigna
    As a consigna user
    I want a list of files

  Background:
    Given existing files:
    | filename | description      | uploadDate   | password  | owner              |
    |fichero1  | fichero creado 1 | 2014/12/27   | pfichero1 | anonimo            |
    |fichero2  | fichero creado 1 | 2014/12/28   | pfichero2 | juanan             |
    |fichero3  | fichero creado 1 | 2014/12/29   | pfichero3 | sergio             |

    Scenario: List files
      Given I am on the homepage
      Then  I should see "Número de elementos: 3"


    #Escenario: Buscar fichero existente
    #  Dado estoy en la página de inicio
    #  Cuando relleno "buscar" con "fichero1"
    #  Y presiono "búsqueda"
    #  Entonces debo ver "Número de elementos: 1"

    #Escenario: Buscar fichero inexistente
    #  Dado estoy en la página de inicio
    #  Cuando relleno "buscar" con "guti"
    #  Y presiono "búsqueda"
    #  Entonces debo ver "Número de elementos: 0"

    #Escenario: Buscar fichero sin completar cuadro de búsqueda
    #  Dado estoy en la página de inicio
    #  Cuando relleno "buscar" con "fich"
    #  Y presiono "búsqueda"
    #  Entonces debo ver "Número de elementos: 3"