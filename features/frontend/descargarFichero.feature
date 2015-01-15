#language: es

  Característica: descargar ficheros con usuario autenticado.
    Para poder tener un fichero
    Como usuario autenticado
    Quiero poder descargar ficheros

  Antecedentes:
    Dado existen los ficheros:
    | nombre | descripcion      | fechaSubida  | password  | propietario        |
    |fichero1| fichero creado 1 | 2014/12/27   | pfichero1 | anonimo            |
    |fichero2| fichero creado 1 | 2014/12/28   | pfichero2 | jamartinez@uco.es  |
    |fichero3| fichero creado 1 | 2014/12/29   | pfichero3 | sergio@uco.es      |

  Y existen los usuarios;
    |nombre       |email            |password|
    |Juan Antonio |jamartinez@uco.es|paquete |
    |Sergio       |sergio@uco.es    |putoamo |

  Y estoy autenticado como "jamartinez@uco.es"

  Escenario: descargar fichero subido por usuario anónimo
    Dado estoy en la página de inicio
    Cuando presiono "Descargar fichero1"
    Y relleno "password" con "pfichero1"
    Entonces debo ver "El fichero se ha descargado correctamente"

  Escenario: descargar fichero subido por mi
    Dado estoy en la página de inicio
    Cuando presiono "Descargar fichero2"
    Y relleno "password" con "pfichero2"
    Entonces debo ver "El fichero se ha descargado correctamente"

#Escenario: descargar fichero de usuario anonimo sin estar autenticado
#Dado que estoy en la página de inicio
#Y no estoy autenticado
#Y hago click en el botón "descargar" de "fichero1"
#Y introduzco la contraseña.
#Entonces debo ver "Debe estar autenticado para descargar este fichero"

#Escenario: descargar fichero subido por usuario autenticado como usuario anónimo
#Dado que estoy en la página de inicio
#Y no estoy autenticado
#Y hago click en el botón "descargar" de "fichero2"
#Y introduzco la contraseña
#Entonces se descarga "fichero2"
#Y debo ver "El fichero se ha descargado correctamente"