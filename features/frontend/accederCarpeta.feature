#language: es
@carpetas

  Característica: Acceder a una carpeta
    Para poder ver los ficheros que me han compartido en una carpeta
    Como usuario de consigna
    Quiero poder acceder a carpetas

  Antecedentes:

    existe la carpeta:

    |id|nombre  |fechaCreacion|fechaBorrado|propietario      |
    |01|Carpeta1|  08/01/2015 |15/01/2015  |jamartinez@uco.es|

  Escenario: Acceder a una carpeta

    Dado que estoy en la página de inicio
    Y hago click en la carpeta "Carpeta1"
    Entonces debo ver "Introduzca la contraseña para acceder a la carpeta"
    Cuando introduzco "ContraseñaCarpeta1" en el cuadro de texto de password.
    Entonces debo estar en la página de la carpeta.


