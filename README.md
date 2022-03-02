# nodos-skin

Skin de la wiki Nodos http://plataformanodos.org/

Se trata de un skin creado sobre la base del skin `Vector`. A continuación se detallan los pasos necesarios para su instalación en cualquier wiki que utilice MediaWiki.

### Descargar el código de este repositorio. 

Se debe colocar dentro de una carpeta llamada `Nodos` en el directorio `/skins` de la instalación. Para obtener el código se puede clonar el repositorio:

```git clone https://github.com/cientopolis/nodos-skin```

### Habilitar el skin en la configuración de la wiki. 

Se debe editar el archivo `LocalSettings.php` de la instalación para cargar el skin:

```
// mw.v 1.24.x or less
require_once "$IP/skins/Nodos/Nodos.php";
// mw.v 1.25.x or above
wfLoadSkin( 'Nodos' );
```

### Configurar para que sea el skin por defecto. 

Para hacerlo, se debe utilizar la variable `$wgDefaultSkin` en `LocalSettings.php` a la cual se le debe asignar el nombre del skin. Los usuarios podrían cambiar su skin de preferencia desde su propia página de preferencias en caso de que hubiese más skins instalados.

`$wgDefaultSkin = 'Nodos';`

Cambiar este valor en una wiki existente automaticamente cambiará esta configuración para todos los usuarios que han estado usando el skin por defecto. 
Si no cambias este valor, `Vector` continuará siendo el skin por defecto.
