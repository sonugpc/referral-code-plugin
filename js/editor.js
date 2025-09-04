( function ( wp ) {
    const { render, createElement, useState } = wp.element;
    const { TextControl, TextareaControl, Button, PanelBody, ToggleControl } = wp.components;
    const { useSelect, useDispatch } = wp.data;
    const { __ } = wp.i18n;

    const FaqEditor = () => {
        const meta = useSelect( ( select ) => select( 'core/editor' ).getEditedPostAttribute( 'meta' ) || {} );
        const { rcp_faqs } = meta;
        const { editPost } = useDispatch( 'core/editor' );
        const [showJson, setShowJson] = useState(false);

        const setMetaValue = ( key, value ) => {
            editPost( { meta: { ...meta, [key]: value } } );
        };

        const handleFaqChange = ( index, key, value ) => {
            const newFaqs = [...(rcp_faqs || [])];
            newFaqs[index][key] = value;
            setMetaValue( 'rcp_faqs', newFaqs );
        };

        const addFaq = () => {
            const newFaqs = [...(rcp_faqs || []), { question: '', answer: '' }];
            setMetaValue( 'rcp_faqs', newFaqs );
        };

        const removeFaq = ( index ) => {
            const newFaqs = [...(rcp_faqs || [])];
            newFaqs.splice( index, 1 );
            setMetaValue( 'rcp_faqs', newFaqs );
        };

        const handleFaqJsonChange = ( value ) => {
            try {
                const faqs = JSON.parse( value );
                setMetaValue( 'rcp_faqs', faqs );
            } catch ( e ) {
                console.error( "Invalid JSON:", e );
            }
        };

        return createElement(
            'div',
            {},
            createElement(ToggleControl, {
                label: 'Show Raw JSON Editor',
                checked: showJson,
                onChange: () => setShowJson(!showJson)
            }),
            showJson ?
                createElement( TextareaControl, {
                    label: __( 'Enter FAQs in JSON format', 'referral-code-plugin' ),
                    value: JSON.stringify( rcp_faqs || [], null, 2 ),
                    onChange: handleFaqJsonChange,
                    rows: 15,
                } ) :
                createElement(
                    'div',
                    {},
                    (rcp_faqs || []).map((faq, index) => 
                        createElement(
                            'div',
                            { key: index, style: { marginBottom: '1em', border: '1px solid #ddd', padding: '1em' } },
                            createElement(TextControl, {
                                label: `Question ${index + 1}`,
                                value: faq.question,
                                onChange: (value) => handleFaqChange(index, 'question', value)
                            }),
                            createElement(TextareaControl, {
                                label: `Answer ${index + 1}`,
                                value: faq.answer,
                                onChange: (value) => handleFaqChange(index, 'answer', value)
                            }),
                            createElement(Button, {
                                isDestructive: true,
                                onClick: () => removeFaq(index)
                            }, 'Remove FAQ')
                        )
                    ),
                    createElement(Button, {
                        isPrimary: true,
                        onClick: addFaq
                    }, 'Add FAQ')
                )
        );
    };

    document.addEventListener('DOMContentLoaded', () => {
        const editorEl = document.getElementById('rcp-faq-editor');
        if (editorEl) {
            render(createElement(FaqEditor), editorEl);
        }
    });
} )( window.wp );
