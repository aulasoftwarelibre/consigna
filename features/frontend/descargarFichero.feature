#language: es
@ficheros
Característica: descargar ficheros
Para poder tener un fichero
Como usuario de consigna
Quiero poder descargar ficheros

Antecedentes:

  Dado que existen los ficheros:
  | nombre | fechaSubida  | fechaBorrado  | propietario       |
  |fichero1| 27/12/14     | 05/01/15      | anonimo           |
  |fichero2| 28/12/14     | 06/01/15      | jamartinez@uco.es |
  |fichero3| 29/12/14     | 07/01/15      | sergio@uco.es     |

  Y existen los usuarios;

  |jamartinez@uco.es|
  |sergio@uco.es    |


Escenario: descargar fichero subido por usuario anonimo sin estar autenticado
  Dado que estoy en la página de inicio
  Y no estoy autenticado
  Y hago click en el botón "descargar" de "fichero1"
  Y introduzco la contraseña.
  Entonces debo ver "Debe estar autenticado para descargar este fichero"

Escenario: descargar fichero subido por usuario anonimo como usuario autenticado
  Dado que estoy en la página de inicio
  Y estoy autenticado como "jamartinez@uco.es"
  Y hago click en el botón "descargar" de "fichero1"
  Y introduzco la contraseña.
  Entonces se descarga "fichero1"
  Y debo ver "El fichero se ha descargado correctamente"

Escenario: descargar fichero subido por usuario autenticado como usuario anónimo
  Dado que estoy en la página de inicio
  Y no estoy autenticado
  Y hago click en el botón "descargar" de "fichero2"
  Y introduzco la contraseña
  Entonces se descarga "fichero2"
  Y debo ver "El fichero se ha descargado correctamente"

Escenario: descargar fichero subido por usuario autenticado como usuario autenticado
  Dado que estoy en la página de inicio
  Y estoy autenticado como "sergio@uco.es"
  Y hago click en el botón "descargar" de "fichero2"
  Y introduzco la contraseña
  Entonces se descarga "fichero2"
  Y debo ver "El fichero se ha descargado correctamente"