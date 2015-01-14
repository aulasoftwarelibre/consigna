#language: es
@borradoAutomatico

  Característica: borrado ficheros automático.
    Para no acumular basura en consigna.
    Quiero que los ficheros se eliminen automáticamente.

  Antecedentes:
    Dado que existen los ficheros:
      | nombre | fechaSubida  | fechaBorrado  |
      |fichero1| 2015/01/07   | 2015/01/14    |
      |fichero2| 2015/01/08   | 2015/01/15    |
      |fichero3| 2015/01/09   | 2015/01/16    |

    Escenario: Eliminar fichero automáticamente
      Dado fecha actual es "2015/01/14"
      Y fechaBorrado es "2015/01/14"
      Entonces debo ver "Número de archivos: 2"