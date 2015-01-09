#language: es
@ficheros
Característica: subir ficheros
Para subir ficheros
Como usuario de consigna
Quiero poder subir ficheros

Antecedentes:

Dado que existen los usuarios;

|jamartinez@uco.es|
|sergio@uco.es

Y tiempoAntesDeBorrado es:

|7|

Y existe la carpeta:

  |Carpeta1|

Escenario: subir fichero sin autenticar
  Dado que estoy en la página de inicio
  Y no estoy autenticado
  Y hago click en el botón "subir fichero"
  Y selecciono el fichero "fichero1"
  Y es fecha "27/12/14"
  Y introduzco como password "paquete"
  Entonces se analiza el fichero en busca de virus.
  Entonces en la base de datos debe existir un registro con:
  |id |  nombre  | fechaSubida  | fechaBorrado  | propietario       | password |
  | 1 | fichero1 | 27/12/14     | 05/01/15      | anonimo           | paquete  |
  Entonces debo ver "El fichero 'fichero1' se ha subido correctamente"

Escenario: subir fichero autenticado
  Dado que estoy en la página de inicio
  Y estoy autenticado como "jamartinez@uco.es"
  Y hago click en el botón "subir fichero"
  Y selecciono el fichero "fichero2"
  Y es fecha "28/12/14"
  Y introduzco como password "paquete"
  Entonces en la base de datos debe existir un registro con:
  |id |  nombre  | fechaSubida  | fechaBorrado  | propietario       | password |
  | 2 | fichero1 | 28/12/14     | 06/01/15      | anonimo           | paquete  |
  Entonces debo ver "El fichero 'fichero2' se ha subido correctamente"


Escenario: subir fichero a una carpeta
   Dado que estoy en la página de inicio
   Y estoy autenticado como "jamartinez@uco.es"
   Y hago click en la carpeta "Carpeta1"
   Entonces debo ver "Introduzca la contraseña para acceder a la carpeta"
   Cuando introduzco "ContraseñaCarpeta1" en el cuadro de texto de password.
   Entonces debo estar en la página de la carpeta.
   Cuando hago click en el botón "subir fichero"
   Y selecciono el fichero "fichero3"
   Y es fecha "08/01/15"
   Entonces se analiza el fichero en busca de virus.
   Entonces en la base de datos debe existir un registro con:
    |id |  nombre  | fechaSubida  | fechaBorrado  | propietario       | password            |
    | 3 | fichero3 | 08/01/15     | 15/01/15      | jamartinez@uco.es | ContraseñaCarpeta1  |
