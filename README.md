# Donde
Aplicación web que permite buscar lugares cercanos gratuitos de testeo de VIH y de distribución de preservativos.

# Instrucciones para la instalación del sistema

1. Clonar este repositorio al repositorio local de trabajo.
2. Instalar dependencias necesarias para el entorno de desarrollo: php, nginx, mysql. También se puede realizar utilizando una máquina virtual (sobretodo en entornos como Windows) para mayor seguridad y facilidad, ya que no se requiere instalar las dependecias y cualquier problema se descarta el box, su uso recomendado. Ver laravel Homestead para más información https://laravel.com/docs/5.7/homestead.
3. Crear el archivo .env en la carpeta raíz, necesario para asignar las variables de entorno del sistema.
4. Crear la base de datos. Para esto, simplemente importar el último dump de producción disponible con alguna herramienta de administración de mysql. No hay necesidad de crear tablas, configurar la BD, sólo correr el script. Este paso es importante porque los dumps ya contienen algunas optimizaciones en la BD. Verificar si el script crea o no a priori la BD, sino debe crearse el schema primero.
5. Servir (php serve) o levantar la máquina virtual.
6. Probar!
