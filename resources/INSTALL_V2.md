# Ximpleman Web V2

Versión paralela de la página web actual para CodeIgniter 3 y PHP 8. No reemplaza la web existente hasta que decidas activarla.

## 1. Copiar archivos

Copia las carpetas del ZIP respetando la estructura:

- `application/controllers/Website_v2.php`
- `application/models/Website_v2_model.php`
- `application/views/web_v2/`
- `resources/web_v2/`

No borres los archivos actuales de `application/views/web/` ni `resources/web/`.

## 2. Probar sin tocar rutas

Abre:

`http://localhost/ximpleman_web/index.php/website_v2/index/1`

Si tienes `index_page` vacío y mod_rewrite configurado:

`http://localhost/ximpleman_web/website_v2/index/1`

## 3. URL amigable opcional

En `application/config/routes.php` agrega:

```php
$route['website/v2/(:num)'] = 'website_v2/index/$1';
$route['website/v2'] = 'website_v2/index/1';
```

Entonces podrás abrir:

`http://localhost/ximpleman_web/website/v2/1`

## 4. Qué reutiliza de la base actual

- `pagina_web`
- `menu_principal`
- `menu`
- `submenu`
- `slide`
- `categoria_producto`
- `subcategoria_producto`
- `producto`
- `seccion`
- `red_social`
- `mapa`
- `sistema`
- `carrito`

Los registros visibles se consideran activos cuando `estadopag_id = 1` o `estado_id = 1` según la tabla.

## 5. Rutas de imágenes que conserva

- Slider: `resources/web/images/sliders/`
- Productos: `resources/images/productos/`
- Categorías: `resources/images/categorias/`

Si tus categorías usan otra carpeta, cambia solo la ruta en `application/views/web_v2/partials/category_strip.php`.

## 6. Características de V2

- Sin SKDSlider.
- Sin dependencia de jQuery para la V2.
- Slider nativo CSS/JavaScript con fade, autoplay, flechas e indicadores.
- Menú dinámico de tres niveles: `menu_principal > menu > submenu`.
- Responsive para PC, tablet y móvil.
- Catálogo AJAX por texto, categoría y subcategoría.
- Carrito AJAX sobre la tabla `carrito` existente.
- Inicio de sesión compatible con `website/sesioncliente` de la web actual.
- Redes sociales, contacto y mapa desde las tablas actuales.
- La web antigua permanece disponible mientras pruebas V2.

## 7. Si la página queda en 404

Verifica que `pagina_web.estadopag_id = 1` para el idioma solicitado. El controlador V2 requiere una página activa.

Consulta útil:

```sql
SELECT *
FROM pagina_web
WHERE idioma_id = 1;
```

## 8. Si no aparecen slides

```sql
SELECT *
FROM slide
WHERE pagina_id = TU_PAGINA_ID
  AND estadopag_id = 1
  AND slide_tipo = 1
ORDER BY slide_id;
```

## 9. Activarla como página principal

Primero prueba V2. Cuando esté validada, puedes redirigir la raíz con una ruta o cambiar el método que carga la portada. No recomiendo eliminar todavía la vista antigua.
