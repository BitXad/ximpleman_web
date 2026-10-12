# Ximpleman Web V1.5

Primera modernización incremental sobre la página original funcional.

## Qué se modificó

- Cabecera superior más compacta y ligera.
- Menú principal limpio, sin alterar su lógica Bootstrap 3.
- Slider original SKDSlider conservado, con proporciones, textos, flechas e indicadores modernizados vía CSS.
- Franja de pasos de compra reducida visualmente.
- Buscador y filtros modernizados, conservando los mismos IDs y funciones JavaScript.
- Se corrigió el comentario HTML incompleto en el menú de inicio de sesión.
- Se retiró el bloque PHP comentado con HTML que ejecutaba `sizeof()` sobre texto y podía detener PHP 8.
- `skdslider.css` ahora se carga en `<head>` y se evita la carga duplicada al final.

## Archivos modificados/nuevos

- `application/views/web/index.php`
- `resources/web/css/ximpleman-v15.css` (nuevo)

## Instalación

1. Haz una copia de respaldo de tu `application/views/web/index.php` actual.
2. Copia los archivos del ZIP respetando sus rutas.
3. No reemplaces `Website.php`, `Pagina_web_model.php`, `web_producto.js`, `style.css` ni `skdslider.min.js`.
4. Recarga con `Ctrl + F5` para forzar la carga de `ximpleman-v15.css?v=1.5.0`.

## Objetivo de esta fase

No se modifican aún las tarjetas de productos, ofertas, carrito, login ni la lógica AJAX. Esta fase se limita a cabecera + navegación + slider + buscador para validar la dirección visual sin arriesgar la página funcional.
