( function ( wp ) {
    const { registerPlugin } = wp.plugins;
    const { PluginDocumentSettingPanel } = wp.editPost;
    const { TextControl, TextareaControl, Button, PanelBody } = wp.components;
    const { useSelect, useDispatch } = wp.data;
    const { __ } = wp.i18n;
    const { createElement, Fragment } = wp.element;

    const ReferralCodeMetaFields = () => {
        const postType = useSelect( ( select ) => select( 'core/editor' ).getCurrentPostType() );
        if ( postType !== 'referral-codes' ) {
            return null;
        }

        const meta = useSelect( ( select ) => select( 'core/editor' ).getEditedPostAttribute( 'meta' ) || {} );
        const { referral_code, referral_link, signup_bonus, rcp_faqs } = meta;

        const { editPost } = useDispatch( 'core/editor' );

        const setMetaValue = ( key, value ) => {
            editPost( { meta: { ...meta, [key]: value } } );
        };

        const handleFaqChange = ( index, field, value ) => {
            const faqs = [ ...( rcp_faqs || [] ) ];
            faqs[ index ] = { ...faqs[ index ], [ field ]: value };
            setMetaValue( 'rcp_faqs', faqs );
        };

        const addFaq = () => {
            const faqs = [ ...( rcp_faqs || [] ) ];
            faqs.push( { question: '', answer: '' } );
            setMetaValue( 'rcp_faqs', faqs );
        };

        const removeFaq = ( index ) => {
            const faqs = [ ...( rcp_faqs || [] ) ];
            faqs.splice( index, 1 );
            setMetaValue( 'rcp_faqs', faqs );
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
                PanelBody,
                {
                    title: __( 'FAQs', 'referral-code-plugin' ),
                    initialOpen: true,
                },
                ( rcp_faqs || [] ).map( ( faq, index ) =>
                    createElement(
                        Fragment,
                        { key: index },
                        createElement( TextControl, {
                            label: __( 'Question', 'referral-code-plugin' ),
                            value: faq.question,
                            onChange: ( value ) => handleFaqChange( index, 'question', value ),
                        } ),
                        createElement( TextareaControl, {
                            label: __( 'Answer', 'referral-code-plugin' ),
                            value: faq.answer,
                            onChange: ( value ) => handleFaqChange( index, 'answer', value ),
                        } ),
                        createElement(
                            Button,
                            {
                                isLink: true,
                                isDestructive: true,
                                onClick: () => removeFaq( index ),
                            },
                            __( 'Remove FAQ', 'referral-code-plugin' )
                        )
                    )
                ),
                createElement(
                    Button,
                    {
                        isPrimary: true,
                        onClick: addFaq,
                    },
                    __( 'Add FAQ', 'referral-code-plugin' )
                )
            )
        );
    };

    registerPlugin( 'referral-code-meta-fields', {
        render: ReferralCodeMetaFields,
        icon: 'money',
    } );
} )( window.wp );
