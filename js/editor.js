( function ( wp ) {
    const { registerPlugin } = wp.plugins;
    const { PluginDocumentSettingPanel } = wp.editPost;
    const { TextControl } = wp.components;
    const { useSelect, useDispatch } = wp.data;
    const { __ } = wp.i18n;
    const { createElement } = wp.element;

    const ReferralCodeMetaFields = () => {
        const postType = useSelect( ( select ) => {
            return select( 'core/editor' ).getCurrentPostType();
        } );

        if ( postType !== 'referral-codes' ) {
            return null;
        }

        const { referral_code, referral_link, signup_bonus } = useSelect( ( select ) => {
            return select( 'core/editor' ).getEditedPostAttribute( 'meta' ) || {};
        } );

        const { editPost } = useDispatch( 'core/editor' );

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
                    onChange: ( value ) => editPost( { meta: { referral_code: value } } ),
                }
            ),
            createElement(
                TextControl,
                {
                    label: __( 'Referral Link', 'referral-code-plugin' ),
                    value: referral_link,
                    onChange: ( value ) => editPost( { meta: { referral_link: value } } ),
                }
            ),
            createElement(
                TextControl,
                {
                    label: __( 'Sign-up Bonus', 'referral-code-plugin' ),
                    value: signup_bonus,
                    onChange: ( value ) => editPost( { meta: { signup_bonus: value } } ),
                }
            )
        );
    };

    registerPlugin( 'referral-code-meta-fields', {
        render: ReferralCodeMetaFields,
        icon: 'money',
    } );
} )( window.wp );
