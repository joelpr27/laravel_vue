# Manual de instalación

## 1 Como usar
###     1.1 Clonar Repositorio
```bash
        git clone "url del proyecto en GIT"
```
###    1.2 Instalar vía Composer
```bash

        composer install
```
###    1.3 Copiar el fichero .env.example a .env edita las credenciales y la url
####        Campos a cambiar:
        ```bash
            APP_NAME=TemplateDaw2
            APP_URL=http://localhost:8000
            DB_HOST=127.0.0.1
            DB_PORT=3306
            DB_DATABASE=templateDaw2
            DB_USERNAME=root
```
###    1.4 Generar Application Key
```bash
        php artisan key:generate
```
###    1.5 Migrar base de datos
```bash
        php artisan migrate
```
###    1.6 Lanzar Seeders
```bash
        php artisan db:seed
```
###    1.7 Instalar las dependencias de Node
```bash
        npm install
```
```bash
        npm run dev
```
###    1.8 Activar storage para ver las imagenes de ra carpeta public
```bash
        php artisan storage:link
```

## 2 Clonacion a GIT personal
###    2.1 Creación git
####        Primero eliminar el origin que hay actualmente 
            Haciendo git remote -v los podemos ver
```bash

```
####        Borrar las ramas de origin
```bash
            git remote rm origin 
```
###    2.2 Seguir estos comandos cada uno con su url del nuevo proyecto del git
```bash
        git remote add origin "url a tu nuevo proyecto en GIT"
```
```bash
        git branch -M main
```
```bash
        git push -u origin main
```
