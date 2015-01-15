#language: es
  Característica: Eliminar fichero
  Para borrar un fichero del sistema
  Como usuario de consigna
  Quiero eliminar ficheros

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

    Escenario: Eliminar fichero propio.
      Dado estoy en la página de inicio.
      Cuando presiono "Eliminar fichero2"
      Y relleno "password" con "pfichero2"
      Entonces debo ver "Número de elementos: 2"

    Escenario: Eliminar fichero que no es mio.
      Dado estoy en la página de inicio.
      Cuando presiono "Eliminar fichero3"
      Entonces debo ver "No puede eliminar el fichero"
