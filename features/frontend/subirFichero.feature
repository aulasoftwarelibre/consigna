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

Escenario: subir fichero sin autenticar
  Dado que estoy en la página de inicio
  Y no estoy autenticado
  Y hago click en el botón "subir fichero" de "fichero1"
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
  Y hago click en el botón "subir fichero" de "fichero2"
  Y es fecha "28/12/14"
  Y introduzco como password "paquete"
  Entonces en la base de datos debe existir un registro con:
  |id |  nombre  | fechaSubida  | fechaBorrado  | propietario       | password |
  | 2 | fichero1 | 28/12/14     | 06/01/15      | anonimo           | paquete  |
  Entonces debo ver "El fichero 'fichero2' se ha subido correctamente"
