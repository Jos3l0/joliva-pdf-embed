<?php
/**
 * Plugin Name: JO PDF Embed + Download
 * Description: Convierte URLs de PDF en visores embebidos con botón de descarga y agrega un bloque de Gutenberg para insertar PDFs fácilmente.
 * Author: Portal Educativo DGE Gob. de Mendoza
 * Version: 2.2.0
 * Text Domain: joliva-pdf-embed
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Constantes básicas
 */
define( 'JPE_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'JPE_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

/**
 * Encolar estilos públicos
 */
function jpe_enqueue_public_assets() {
    wp_enqueue_style(
        'jpe-public-style',
        JPE_PLUGIN_URL . 'assets/css/public.css',
        array(),
        '1.0.0'
    );
}
add_action( 'wp_enqueue_scripts', 'jpe_enqueue_public_assets' );

/**
 * Genera el HTML del visor PDF + botón descarga
 *
 * @param string $url           URL del PDF.
 * @param string $button_label  Texto del botón de descarga.
 *
 * @return string
 */
function jpe_get_pdf_embed_html( $url, $button_label = 'Descargar PDF' ) {

    $pdf_url      = esc_url( $url );
    $button_label = esc_html( $button_label );
    $file_name    = basename( parse_url( $pdf_url, PHP_URL_PATH ) );

    ob_start();
    ?>
    <div class="jpe-pdf-wrapper">
        <div class="jpe-pdf-embed">
            <iframe
                class="jpe-pdf-iframe"
                src="https://docs.google.com/viewer?url=<?php echo urlencode( $pdf_url ); ?>&amp;embedded=true"
                title="<?php echo esc_attr( sprintf( 'Documento PDF: %s', $file_name ) ); ?>"
                loading="lazy"
                allowfullscreen
                frameborder="0"
            ></iframe>
        </div>

        <div class="jpe-pdf-download">
            <a
                class="jpe-pdf-button"
                href="<?php echo $pdf_url; ?>"
                target="_blank"
                rel="noopener noreferrer"
                download="<?php echo esc_attr( $file_name ); ?>"
            >
                <span class="jpe-pdf-button-icon" aria-hidden="true">⬇</span>
                <span class="jpe-pdf-button-text"><?php echo $button_label; ?></span>
            </a>
        </div>
    </div>
    <?php
    return ob_get_clean();
}

/**
 * Filtro para reemplazar SOLO URLs sueltas de PDF en el contenido por el visor embebido.
 * Si el PDF está enlazado desde un texto (anchor <a>), se respeta el enlace.
 */
function jpe_filter_content_pdfs( $content ) {

    if ( is_admin() || is_feed() || is_preview() ) {
        return $content;
    }

    // URLs sueltas que terminen en .pdf y que NO formen parte de un href="...pdf"
    $content = preg_replace_callback(
        '~(?<!href=["\'])(https?://[^\s"\']+\.pdf)~i',
        function ( $matches ) {
            $url = $matches[1];
            return jpe_get_pdf_embed_html( $url );
        },
        $content
    );

    return $content;
}
add_filter( 'the_content', 'jpe_filter_content_pdfs', 20 );

/**
 * Registro de bloque Gutenberg
 */
function jpe_register_gutenberg_block() {

    wp_register_script(
        'jpe-block-script',
        JPE_PLUGIN_URL . 'assets/js/block.js',
        array( 'wp-blocks', 'wp-element', 'wp-editor', 'wp-components', 'wp-i18n' ),
        '1.0.0',
        true
    );

    register_block_type(
        'jpe/pdf-viewer',
        array(
            'editor_script'   => 'jpe-block-script',
            'render_callback' => 'jpe_render_pdf_block',
            'attributes'      => array(
                'url'            => array(
                    'type'    => 'string',
                    'default' => '',
                ),
                'buttonText'     => array(
                    'type'    => 'string',
                    'default' => 'Descargar PDF',
                ),
                'viewButtonText' => array(
                    'type'    => 'string',
                    'default' => 'Ver pantalla completa',
                ),
                'height'         => array(
                    'type'    => 'string',
                    'default' => 'auto',
                ),
            ),
        )
    );
}
add_action( 'init', 'jpe_register_gutenberg_block' );

/**
 * Render del bloque dinámico
 *
 * @param array $attributes Atributos del bloque.
 *
 * @return string
 */
function jpe_render_pdf_block( $attributes ) {

    $url         = isset( $attributes['url'] ) ? esc_url_raw( $attributes['url'] ) : '';
    $button_text = isset( $attributes['buttonText'] ) ? $attributes['buttonText'] : 'Descargar PDF';

    if ( empty( $url ) ) {
        return '';
    }

    return jpe_get_pdf_embed_html( $url, $button_text );
}