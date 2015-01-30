@folder

  Feature: Access to folder
    In order to see files in a folder
    As a consigna user
    I want to access to a folder

    Background:
      #Given existing folders:
        |folderName  | description      |uploadDate  | password  |
        |Carpeta1    | carpeta número 1 | 2015/08/01 | pCarpeta1 |


    Escenario: Acceder a carpeta con clave
      Dado estoy en la página de inicio
      Cuando presiono "Carpeta1"
      Entonces debo ver "Introduzca la contraseña para acceder a la carpeta"
      Cuando relleno "password" con "ContraseñaCarpeta1"
      Entonces debo estar en "Carpeta1"


