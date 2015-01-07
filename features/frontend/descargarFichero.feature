#language: es
Característica: descargar ficheros
Para descargar ficheros
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
  Y selecciono "fichero1"
  Y selecciono "descargar"
  Entonces debo ver "Debe estar autenticado para descargar este fichero"

Escenario: descargar fichero subido por usuario anonimo como usuario autenticado
  Dado que estoy en la página de inicio
  Y estoy autenticado como "jamartinez@uco.es"
  Y selecciono "fichero1"
  Y selecciono "descargar"
  Entonces se descarga "fichero1"

Escenario: descargar fichero subido por usuario autenticado como usuario anónimo
  Dado que estoy en la página de inicio
  Y no estoy autenticado
  Y selecciono "fichero2"
  Y selecciono "descargar"
  Entonces se descarga "fichero2"

Escenario: descargar fichero subido por usuario autenticado como usuario autenticado
  Dado que estoy en la página de inicio
  Y estoy autenticado como "sergio@uco.es"
  Y selecciono "fichero2"
  Y selecciono "descargar"
  Entonces se descarga "fichero2"


