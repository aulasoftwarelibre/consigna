#language: es
@symfony

Antecedentes:

    Dado que existen los ficheros con nombreFichero:
    |fichero1|
    |fichero2|
    |fichero3|

    Y id:

    |01|
    |02|
    |03|

    Y fechaSubida:
    |27/12/14|
    |28/12/14|
    |29/12/14|

    Y fechaBorrado:
    |05/01/15|
    |06/01/15|
    |07/01/15|

    Y propietario:

    |anonimo|
    |jamartinez@uco.es|
    |decano@uco.es|
    

    Escenario: listar ficheros
        Dado que estoy en la página de inicio
        Entonces debo ver "Número de archivos: 3"
        Entonces debo ver 
        "id   Nombre    fecha de subida fecha de borrado propietario 
        |01| |fichero1|   |27/12/14|       |05/01/15|     |anonimo|"

        Entonces debo ver 
        "id   Nombre    fecha de subida fecha de borrado propietario 
        |02| |fichero2|   |28/12/14|       |06/01/15|     |jamartinez@uco.es|"

        Entonces debo ver 
        "id   Nombre    fecha de subida fecha de borrado propietario 
        |03| |fichero3|   |29/12/14|       |07/01/15|     |decano@uco.es|"
