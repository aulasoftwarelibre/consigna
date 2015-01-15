#language: es

  Característica: compartir ficheros
    Para que otros usuarios vean mis ficheros.
    Como usuario autenticado de consigna
    Quiero compartir enlaces públicos a ficheros.

  Antecedentes:
    Dado existen los ficheros:
    | nombre | fechaSubida  | fechaBorrado  | propietario       |
    |fichero1| 27/12/14     | 05/01/15      | anonimo           |
    |fichero2| 28/12/14     | 06/01/15      | jamartinez@uco.es |
    |fichero3| 29/12/14     | 07/01/15      | sergio@uco.es     |

    Y existen los usuarios;
    |nombre       |email            |password|
    |Juan Antonio |jamartinez@uco.es|paquete |
    |Sergio       |sergio@uco.es    |putoamo |

    Y estoy autenticado como "jamartinez@uco.es"

    Escenario: compartir enlace sin autenticar
      Dado estoy en la página de inicio
      Cuando presiono "Compartir fichero1".
      Entonces debo ver "Debe estar autenticado para compartir este fichero"

    Escenario: compartir enlace propio
      Dado estoy en la página de inicio
      Cuando presiono "Compartir fichero2".
      Entonces debo ver "Enlace generado satisfactoriamente"

    Escenario: compartir enlace no propio.
      Dado estoy en la página de inicio
      Cuando presiono "Compartir fichero3"
      Entonces debo ver "No puede compartir este fichero "




