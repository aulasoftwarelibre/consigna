 #language: es

  Característica: Crear carpeta
    Para poder clasificar ficheros
    Como usuario de consigna
    Quiero poder crear carpetas

  Antecedentes:
    Dado existen los ficheros:
    | nombre | descripcion      | fechaSubida  | password  | propietario        |
    |fichero1| fichero creado 1 | 2014/12/27   | pfichero1 | anonimo            |
    |fichero2| fichero creado 1 | 2014/12/28   | pfichero2 | jamartinez@uco.es  |
    |fichero3| fichero creado 1 | 2014/12/29   | pfichero3 | sergio@uco.es      |

  Escenario: Crear carpeta
    Dado estoy en la página principal
    Y fecha actual "2015/01/08"
    Cuando presiono "Crear carpeta"
    Y relleno "Nombre de la carpeta" con "Carpeta1"
    Y relleno "password" con "passwordCarpeta1"
    Entonces debo ver "Número de elementos: 4"