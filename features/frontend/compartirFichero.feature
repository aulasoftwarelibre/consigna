#language: es
Característica: compartir ficheros
Para compartir ficheros
Como usuario de consigna
Quiero poder generar enlaces

Antecedentes:

Dado que existen los ficheros:
| nombre | fechaSubida  | fechaBorrado  | propietario       |
|fichero1| 27/12/14     | 05/01/15      | anonimo           |
|fichero2| 28/12/14     | 06/01/15      | jamartinez@uco.es |
|fichero3| 29/12/14     | 07/01/15      | sergio@uco.es     |

Y existen los usuarios;

|jamartinez@uco.es|
|sergio@uco.es    |


Escenario: compartir enlace sin autenticar
Dado que estoy en la página de inicio
Y no estoy autenticado
Y selecciono "fichero1"
Y selecciono "compartir"
Entonces debo ver "Debe estar autenticado para compartir este fichero"

Escenario: compartir fichero subido mi mismo.
Dado que estoy en la página de inicio
Y estoy autenticado como "jamartinez@uco.es"
Y selecciono "fichero2"
Y selecciono "compartir"
Entonces se genera enlace.

Escenario: compartir fichero subido por otro usuario.
Dado que estoy en la página de inicio
Y estoy autenticado como "jamartinez@uco.es"
Y selecciono "fichero3"
Y selecciono "compartir"
Entonces debo ver "Solo 'sergio@uco.es' puede compartir este fichero "



