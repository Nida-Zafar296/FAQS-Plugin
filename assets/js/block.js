(function (blocks, element) {
    const { registerBlockType } = blocks;
    const { createElement: el } = element;
    const { RichText, InspectorControls } = wp.blockEditor;
    const { PanelBody, TextControl } = wp.components;

    registerBlockType('faq/faq-block', {
        title: 'FAQ Block',
        icon: 'editor-help',
        category: 'common',
        attributes: {
            question: {
                type: 'string',
                source: 'text',
                selector: 'h3',
            },
            answer: {
                type: 'string',
                source: 'html',
                selector: 'div',
            },
        },
        edit({ attributes, setAttributes }) {
            const { question, answer } = attributes;

            return el(
                'div',
                {},
                el(InspectorControls, {},
                    el(PanelBody, { title: 'FAQ Settings' },
                        el(TextControl, {
                            label: 'Question',
                            value: question,
                            onChange: (value) => setAttributes({ question: value }),
                        })
                    )
                ),
                el(RichText, {
                    tagName: 'h3',
                    value: question,
                    onChange: (value) => setAttributes({ question: value }),
                    placeholder: 'Enter the FAQ question',
                }),
                el(RichText, {
                    tagName: 'div',
                    value: answer,
                    onChange: (value) => setAttributes({ answer: value }),
                    placeholder: 'Enter the FAQ answer',
                })
            );
        },
        save({ attributes }) {
            const { question, answer } = attributes;

            return el(
                'div',
                {},
                el('h3', {}, 'Question: ' + question), // Add 'Question: ' before the question
                el('div', {},
                    el('strong', {}, 'Answer: '), // Add 'Answer: ' before the answer
                    el('span', {}, answer) // Wrap the answer in a span
                )
            );
        },
    });
})(
    window.wp.blocks,
    window.wp.element
);
