( function ( wp ) {
    const { registerPlugin } = wp.plugins;
    const { PluginDocumentSettingPanel } = wp.editPost;
    const { render, createElement, useState } = wp.element;
    const { TextControl, TextareaControl, Button, PanelBody, ToggleControl } = wp.components;
    const { useSelect, useDispatch } = wp.data;
    const { __ } = wp.i18n;

    const ReferralCodeMetaFields = () => {
        const postType = useSelect( ( select ) => select( 'core/editor' ).getCurrentPostType() );
        if ( postType !== 'referral-codes' ) {
            return null;
        }

        const meta = useSelect( ( select ) => select( 'core/editor' ).getEditedPostAttribute( 'meta' ) || {} );
        const { referral_code, referral_link, signup_bonus, referral_rewards, app_name } = meta;

        const { editPost } = useDispatch( 'core/editor' );

        const setMetaValue = ( key, value ) => {
            editPost( { meta: { ...meta, [key]: value } } );
        };

        return createElement(
            PluginDocumentSettingPanel,
            {
                name: 'referral-code-meta-fields',
                title: __( 'Referral Code Details', 'referral-code-plugin' ),
                className: 'referral-code-meta-fields',
            },
            createElement(
                TextControl,
                {
                    label: __( 'Referral Code', 'referral-code-plugin' ),
                    value: referral_code,
                    onChange: ( value ) => setMetaValue( 'referral_code', value ),
                }
            ),
            createElement(
                TextControl,
                {
                    label: __( 'Referral Link', 'referral-code-plugin' ),
                    value: referral_link,
                    onChange: ( value ) => setMetaValue( 'referral_link', value ),
                }
            ),
            createElement(
                TextControl,
                {
                    label: __( 'Sign-up Bonus', 'referral-code-plugin' ),
                    value: signup_bonus,
                    onChange: ( value ) => setMetaValue( 'signup_bonus', value ),
                }
            ),
            createElement(
                TextControl,
                {
                    label: __( 'Referral Rewards', 'referral-code-plugin' ),
                    value: referral_rewards,
                    onChange: ( value ) => setMetaValue( 'referral_rewards', value ),
                }
            ),
            createElement(
                TextControl,
                {
                    label: __( 'App Name', 'referral-code-plugin' ),
                    value: app_name,
                    onChange: ( value ) => setMetaValue( 'app_name', value ),
                }
            )
        );
    };

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

    registerPlugin( 'referral-code-meta-fields', {
        render: ReferralCodeMetaFields,
        icon: 'money',
    } );

    document.addEventListener('DOMContentLoaded', () => {
        const editorEl = document.getElementById('rcp-faq-editor');
        if (editorEl) {
            render(createElement(FaqEditor), editorEl);
        }
    });
} )( window.wp );
