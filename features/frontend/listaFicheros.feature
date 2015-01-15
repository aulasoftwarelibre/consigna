#language: es
@lista
  Característica: Listar ficheros
    Para saber qué ficheros existen en consigna
    Como usuario de consigna
    Quiero una lista de los ficheros

  Antecedentes:
    Dado existen los ficheros:
    | nombre | descripcion      | fechaSubida  | password  | propietario        |
    |fichero1| fichero creado 1 | 2014/12/27   | pfichero1 | anonimo            |
    |fichero2| fichero creado 1 | 2014/12/28   | pfichero2 | jamartinez@uco.es  |
    |fichero3| fichero creado 1 | 2014/12/29   | pfichero3 | sergio@uco.es      |

    Escenario: Listar ficheros
      Dado estoy en la página de inicio
      Entonces debo ver "Número de elementos: 3"

#  Escenario: Buscar fichero existente
#    Dado que estoy en la página de inicio
#    Cuando escribo en el cuadro de búsqueda "fichero1"
#    Y presiono "búsqueda"
#    Entonces debo ver "fichero1"

#  Escenario: Buscar fichero inexistente
#    Dado que estoy en la página de inicio
#    Y escribo en el cuadro de búsqueda "guti"
#    Y presiono el botón de búsqueda
#    Entonces debo ver
#    | nombre | fechaSubida  | fechaBorrado  | propietario       |

#  Escenario: Buscar fichero sin introducir el nombre completo
 #   Dado que estoy en la página de inicio
  #  Y escribo en el cuadro de búsqueda "fich"
   # Y presiono el botón de búsqueda
    #Entonces debo ver

    #| nombre | fechaSubida  | fechaBorrado  | propietario       |
    #|fichero1| 27/12/14     | 05/01/15      | anonimo           |
    #|fichero2| 28/12/14     | 06/01/15      | jamartinez@uco.es |
    #|fichero3| 29/12/14     | 07/01/15      | sergio@uco.es     |


  #Escenario: Eliminar fichero propio.
  #  Dado que estoy en la página de iniciol.
  #  Y estoy autenticado como "jamartinez@uco.es"
  #  Y hago click en el botón "eliminar" de "fichero1"
  #  Entonces debo ver "Introduzca la contraseña"
  #  Cuando introduzco la password en el cuadro de texto de password.
  #  Y la password es correcta.
  #  Entonces debo ver "Ha eliminado 'fichero1' del sistema correctamente"
  #  Y debe eliminarse de la BD.