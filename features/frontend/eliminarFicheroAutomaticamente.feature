#language: es
@ficheros

  Característica: borrado ficheros automático.
    Para no acumular basura en consigna.
    Quiero que los ficheros se eliminen automáticamente tras unos días prefijados.

  Antecedentes:
    Dado que existen los ficheros:
    | nombre | fechaSubida  | fechaBorrado  | propietario       |
    |fichero1| 27/12/14     | 05/01/15      | anonimo           |
    |fichero2| 28/12/14     | 06/01/15      | jamartinez@uco.es |
    |fichero3| 29/12/14     | 07/01/15      | sergio@uco.es     |

  Y tiempoAntesDeBorrado es:

    |7|

  Escenario: Eliminar fichero automáticamente
    Dado que hoy es fecha "05/01/15"
    Y "fichero1" fue subido en "27/12/14"
    Entonces el número total de ficheros debe ser 2.
