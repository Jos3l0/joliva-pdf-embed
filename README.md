# JO PDF Embed + Download

[![WordPress](https://img.shields.io/badge/WordPress-6.0%2B-blue.svg)](https://wordpress.org/)
[![License](https://img.shields.io/badge/License-GPL%20v2%2B-blue.svg)](https://www.gnu.org/licenses/gpl-2.0.html)
[![PHP](https://img.shields.io/badge/PHP-7.4%2B-purple.svg)](https://php.net/)

Un plugin de WordPress que convierte URLs de PDF en visores embebidos con botón de descarga, y proporciona un bloque de Gutenberg para insertar PDFs de forma sencilla.

## ✨ Características

- 📄 **Visor de PDF integrado** - Utiliza PDF.js de Mozilla para visualizar PDFs directamente en tu sitio
- 🎨 **Bloque de Gutenberg** - Inserta PDFs fácilmente desde el editor de bloques de WordPress
- 📱 **Diseño responsive** - Se adapta perfectamente a dispositivos móviles, tablets y escritorio
- 🌙 **Modo oscuro** - Soporte automático para preferencias de color del sistema
- ⚡ **Conversión automática** - Detecta y convierte automáticamente los enlaces a PDFs en visores embebidos
- ♿ **Accesible** - Cumple con estándares de accesibilidad WCAG
- 🌐 **Listo para traducción** - Soporte completo de internacionalización (i18n)
- 🖨️ **Optimizado para impresión** - Estilos específicos para impresión de páginas

## 📦 Instalación

### Método 1: Instalación manual

1. Descarga el archivo ZIP del plugin
2. Ve a **Plugins > Añadir nuevo** en tu panel de WordPress
3. Haz clic en **Subir plugin** y selecciona el archivo ZIP
4. Activa el plugin

### Método 2: Vía FTP

1. Extrae el archivo ZIP
2. Sube la carpeta `joliva-pdf-embed` a `/wp-content/plugins/`
3. Activa el plugin desde el panel de administración

## 🚀 Uso

### Método automático
El plugin detecta automáticamente cualquier URL que termine en `.pdf` en el contenido de tus entradas y páginas, y la convierte en un visor embebido con botón de descarga.

### Método con bloque de Gutenberg

1. Edita una entrada o página
2. Añade el bloque **"Visor de PDF (JO)"** desde la categoría "Incrustar"
3. Configura en el panel lateral:
   - **URL del PDF**: La dirección del archivo PDF
   - **Texto del botón**: Personaliza el texto del botón de descarga (por defecto: "Descargar PDF")

## 📋 Requisitos

- WordPress 5.0 o superior
- PHP 7.4 o superior
- Navegador moderno con soporte para JavaScript

## 🎨 Personalización

El visor utiliza CSS personalizado que puedes sobrescribir en tu tema:

```css
/* Cambiar la altura del visor */
.jpe-pdf-embed {
    --jpe-pdf-height: 600px;
}

/* Personalizar el botón de descarga */
.jpe-pdf-button {
    background: #tu-color;
}
```

## 🛠️ Soporte

Si encuentras algún problema o tienes sugerencias:

1. Revisa las [issues existentes](https://github.com/tu-usuario/joliva-pdf-embed/issues)
2. Abre una nueva issue describiendo el problema

## 👥 Autor

**Equipo Portal Educativo DGE Bob. de Mendoza**

Desarrollado para facilitar la visualización de documentos PDF en entornos educativos.

## 📄 Licencia

Este plugin está licenciado bajo GPLv2 o posterior.

```
JO PDF Embed + Download
Copyright (C) 2024 Equipo Portal Educativo DGE Bob. de Mendoza

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.
```

## 🙏 Agradecimientos

- [PDF.js](https://mozilla.github.io/pdf.js/) - Biblioteca de visualización de PDF de Mozilla
- Comunidad de WordPress

---

**Versión:** 2.2.0  
**Requiere WordPress:** 5.0+  
**Probado hasta:** 6.9
**Requiere PHP:** 7.4+
