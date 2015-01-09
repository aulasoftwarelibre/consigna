#language: es
@ficheros
Característica: eliminar ficheros
Para no acumular ficheros que ya no necesite.
Como usuario de consigna
Quiero poder eliminar ficheros.

Antecedentes:
Dado que existen los ficheros:
| nombre | fechaSubida  | fechaBorrado  | propietario       |
|fichero1| 27/12/14     | 05/01/15      | anonimo           |
|fichero2| 28/12/14     | 06/01/15      | jamartinez@uco.es |
|fichero3| 29/12/14     | 07/01/15      | sergio@uco.es     |

  Escenario: Eliminar fichero propio.
    Dado que estoy en la página de inicio.
    Y estoy autenticado como "jamartinez@uco.es"
    Y hago click en el botón "eliminar" de "fichero2"
    Entonces debo ver "Introduzca la contraseña"
    Cuando introduzco la password en el cuadro de texto de password.
    Y la password es correcta.
    Entonces debo ver "Ha eliminado 'fichero1' del sistema correctamente"
    Y debe eliminarse de la BD.

  Escenario: Eliminar fichero que no es mío.
    Dado que estoy en la página de inicio.
    Y estoy autenticado como "jamartinez@uco.es"
    Y hago click en el botón "eliminar" de "fichero3"
    Entonces debo ver "Solo 'sergio@uco.es' puede eliminar este fichero"


  Escenario: Eliminar un fichero creado por un usuario anónimo.
    Dado que estoy en la página principal
    Y soy cualquier usuario de consigna.
    Y hago click en el botón "eliminar" de "fichero1"
    Entonces debo ver "este fichero no puede ser eliminado manualmente"
