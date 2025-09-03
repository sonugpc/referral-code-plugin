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
        const { referral_code, referral_link, signup_bonus, referral_rewards, app_name, rcp_faqs } = meta;

        const { editPost } = useDispatch( 'core/editor' );

        const setMetaValue = ( key, value ) => {
            editPost( { meta: { ...meta, [key]: value } } );
        };

        const handleFaqChange = ( value ) => {
            try {
                const faqs = JSON.parse( value );
                setMetaValue( 'rcp_faqs', faqs );
            } catch ( e ) {
                // For now, just log the error. A more robust solution could show an error in the UI.
                console.error( "Invalid JSON:", e );
            }
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
            ),
            createElement(
                PanelBody,
                {
                    title: __( 'FAQs (JSON)', 'referral-code-plugin' ),
                    initialOpen: true,
                },
                createElement( TextareaControl, {
                    label: __( 'Enter FAQs in JSON format', 'referral-code-plugin' ),
                    value: JSON.stringify( rcp_faqs || [], null, 2 ),
                    onChange: handleFaqChange,
                    rows: 15,
                } )
            )
        );
    };

    registerPlugin( 'referral-code-meta-fields', {
        render: ReferralCodeMetaFields,
        icon: 'money',
    } );
} )( window.wp );
