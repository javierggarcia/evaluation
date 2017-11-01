# PHP Software Engineer Technical Evaluation

El siguiente README explica algunas de las características del proyecto desarrollado para realizar la prueba de nivel de PHP y Symfony para Paradigma Digital. El contenido del proyecto se ajusta al enunciado recibido por email para dicha prueba (PHPSoftwareEngineerTechnicalEvaluation.pdf)

## Software utilizado

A continuación se describe el software usado para el desarrollo:

  * **PHP** - Versión 7.0.51
  * **Symfony** - Versión 3.3.10

## Descripción del proyecto

El proyecto recoge un sitio web para un equipo de fútbol español. El código implementado obtiene información de los partidos celebrados y en curso, así como otras funcionalidades como el envío de dicha información por email y sms.

La información de la que se alimenta el desarrollo se genera con un controller (SimulateWSController). Este simulará unas peticiones y hará uso de los servicios de serialización/deserialización y de guardado de datos (DataHelper). La ruta para ejecutar estas peticiones es /areafootball/simulatews/{page}.

El valor de {page} dependerá de lo siguiente:

* **Page=0** - Borra datos de fixtures y match.
* **Page=1** - Envía fixtures (default).
* **Page=2** - Envía un nuevo fixture y envia los match.
* **Page=3** - Envía match actualizados.

### Páginas

* **Página principal** - En la ruta /areafootball/ se visualiza la página principal (areafootball).
* **Fixtures** - En la ruta /areafootball/fixtures se visualiza un listado con los equipos enfrentados. Por cada equipo enfrentado hay un link que enlaza con el detalle del partido (match).
* **Match** - En la ruta /areafootball/match/{id_match} se visualiza el detalle del partido. El valor de id_match es el identificador del partido.

## License

GPLv2

## Author Information
javierggarcia (javier.ggarcias@gmail.com)