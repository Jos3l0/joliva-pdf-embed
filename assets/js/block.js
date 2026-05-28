(function (blocks, element, editor, components, i18n) {
  const el = element.createElement;
  const TextControl = components.TextControl;
  const InspectorControls = editor.InspectorControls;
  const PanelBody = components.PanelBody;

  const __ = i18n.__;

  blocks.registerBlockType("jpe/pdf-viewer", {
    title: __("Visor de PDF (JO)", "joliva-pdf-embed"),
    icon: "media-document",
    category: "embed",
    description: __(
      "Inserta un visor de PDF responsive con botón de descarga.",
      "joliva-pdf-embed",
    ),
    keywords: ["pdf", "documento", "archivo", "viewer"],

    attributes: {
      url: {
        type: "string",
        default: "",
      },
      buttonText: {
        type: "string",
        default: __("Descargar PDF", "joliva-pdf-embed"),
      },
    },

    edit: function (props) {
      const attributes = props.attributes;

      function onChangeUrl(newUrl) {
        props.setAttributes({ url: newUrl });
      }

      function onChangeButtonText(newText) {
        props.setAttributes({ buttonText: newText });
      }

      return [
        el(
          InspectorControls,
          { key: "inspector" },
          el(
            PanelBody,
            {
              title: __("Configuración del PDF", "joliva-pdf-embed"),
              initialOpen: true,
            },
            el(TextControl, {
              label: __("URL del PDF", "joliva-pdf-embed"),
              value: attributes.url,
              onChange: onChangeUrl,
              placeholder: "https://tusitio.com/archivo.pdf",
            }),
            el(TextControl, {
              label: __("Texto del botón", "joliva-pdf-embed"),
              value: attributes.buttonText,
              onChange: onChangeButtonText,
              placeholder: __("Descargar PDF", "joliva-pdf-embed"),
            }),
          ),
        ),

        el(
          "div",
          {
            className: "jpe-block-editor-preview",
            key: "preview",
          },
          attributes.url
            ? [
                el(
                  "div",
                  {
                    className: "jpe-pdf-embed",
                    key: "embed",
                  },
                  el("iframe", {
                    className: "jpe-pdf-iframe",
                    src:
                      "https://docs.google.com/viewer?url=" +
                      encodeURIComponent(attributes.url) +
                      "&embedded=true",
                    title: __("Vista previa del PDF", "joliva-pdf-embed"),
                  }),
                ),
                el(
                  "div",
                  {
                    className: "jpe-pdf-download",
                    key: "buttons",
                  },
                  el(
                    "a",
                    {
                      className: "jpe-pdf-button",
                      href: attributes.url,
                      target: "_blank",
                      rel: "noopener noreferrer",
                      onClick: function (e) {
                        e.preventDefault();
                      },
                    },
                    el(
                      "span",
                      { className: "jpe-pdf-button-icon", "aria-hidden": true },
                      "⬇",
                    ),
                    el(
                      "span",
                      { className: "jpe-pdf-button-text" },
                      attributes.buttonText ||
                        __("Descargar PDF", "joliva-pdf-embed"),
                    ),
                  ),
                ),
              ]
            : el("div", { style: { textAlign: "center" } }, [
                el(
                  "p",
                  {
                    key: "icon",
                    style: { fontSize: "3rem", marginBottom: "0.5rem" },
                  },
                  "📄",
                ),
                el(
                  "p",
                  { key: "text" },
                  __(
                    "Pega la URL de un PDF en la barra lateral para ver la previa.",
                    "joliva-pdf-embed",
                  ),
                ),
              ]),
        ),
      ];
    },

    save: function () {
      return null;
    },
  });
})(
  window.wp.blocks,
  window.wp.element,
  window.wp.editor,
  window.wp.components,
  window.wp.i18n,
);
