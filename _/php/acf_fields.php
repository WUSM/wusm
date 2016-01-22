<?php

if( function_exists('acf_add_options_page') ) {

    acf_add_options_page(array(
        'page_title'    => 'Header',
        'menu_title'    => 'Header',
        'menu_slug'     => 'header',
        'capability'    => 'edit_posts',
        'redirect'      => false,
        'parent'        => 'themes.php',
    ));

    register_field_group(array (
        'key' => 'group_557b2407ebbbd',
        'title' => 'Branding',
        'fields' => array (
            array (
                'key' => 'field_557b2429bbe0e',
                'label' => 'Logo',
                'name' => 'logo',
                'type' => 'radio',
                'instructions' => '',
                'required' => 1,
                'conditional_logic' => 0,
                'wrapper' => array (
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'choices' => array (
                    'WUSM' => 'School of Medicine',
                    'WUPhysicians' => 'Washington University Physicians',
                    'WUSTL' => 'Washington University',
                ),
                'other_choice' => 0,
                'save_other_choice' => 0,
                'default_value' => 'WUSM',
                'layout' => 'vertical',
            ),
        ),
        'location' => array (
            array (
                array (
                    'param' => 'options_page',
                    'operator' => '==',
                    'value' => 'header',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
    ));

    acf_add_local_field_group(array (
        'key' => 'group_562910a717be3',
        'title' => 'Two Line Site Title',
        'fields' => array (
            array (
                'key' => 'field_562910b0cb979',
                'label' => 'Line 1',
                'name' => 'line_1',
                'type' => 'text',
                'required' => 0,
            ),
            array (
                'key' => 'field_562910b8cb97a',
                'label' => 'Line 2',
                'name' => 'line_2',
                'type' => 'text',
                'required' => 0,
            ),
        ),
        'location' => array (
            array (
                array (
                    'param' => 'options_page',
                    'operator' => '==',
                    'value' => 'header',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'left',
        'instruction_placement' => 'label',
        'active' => 1,
    ));

    acf_add_options_page(array(
        'page_title'    => 'Footer',
        'menu_title'    => 'Footer',
        'menu_slug'     => 'footer',
        'capability'    => 'edit_posts',
        'redirect'      => false,
        'parent'        => 'themes.php',
    ));

    function wusm_acf_admin_head() { ?>
        <style type="text/css">
            .acf-field-56170aad6e798 .acf-label,
            .acf-field-56170de365aba .acf-label { display: none; }
            .acf-field-56170aad6e798 .acf-input p,
            .acf-field-56170de365aba .acf-input p { margin-top: 0; }
            .acf-field-56170aad6e798 .acf-input p:last-child,
            .acf-field-56170de365aba .acf-input p:last-child { margin-bottom: 0; }
        </style>
    <?php }
    add_action('acf/input/admin_head', 'wusm_acf_admin_head');

    register_field_group(array (
        'key' => 'group_5515beef13a82',
        'title' => 'Contact',
        'fields' => array (
            array (
                'key' => 'field_5515bef6d23fd',
                'label' => 'Contact',
                'name' => 'contact',
                'prefix' => '',
                'type' => 'wysiwyg',
                'instructions' => 'Edit the placeholder text below, making sure to keep the same styles and format (bold, punctuation, spacing, etc.). Remove any information that isn\'t needed.',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array (
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '<strong>Office of Lorem Ipsum</strong>
    Washington University School of Medicine
    <strong>Mailing Address:</strong> Street Address, CB ### | St. Louis, MO ZIP
    <strong>Office Location:</strong> Street Address, Suite ### | St. Louis, MO ZIP
    <strong>Phone:</strong> 314-555-5555
    <strong>Fax:</strong> 314-555-5555
    <strong>Email:</strong> <a href="mailto:office@wustl.edu">office@wustl.edu</a>',
                'tabs' => 'visual',
                'toolbar' => 'basic',
                'media_upload' => 0,
            ),
        ),
        'location' => array (
            array (
                array (
                    'param' => 'options_page',
                    'operator' => '==',
                    'value' => 'footer',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
    ));

    register_field_group(array (
        'key' => 'group_5515c1cbd596f',
        'title' => 'Link Lists',
        'fields' => array (
            array (
                'key' => 'field_56170aad6e798',
                'label' => 'Editing Link Lists',
                'name' => 'editing_link_lists',
                'type' => 'message',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array (
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'message' => 'If needed, use the list(s) to link to closely related websites or frequently accessed pages on your own site that may be difficult to find.

                If you need two lists: Group all internal links (go to your site) separately from external links (go to another site). External links go in List 2.',
                'new_lines' => 'wpautop',
                'esc_html' => 0,
            ),
            array (
                'key' => 'field_5515c1e6bf0fc',
                'label' => 'List 1',
                'name' => '',
                'prefix' => '',
                'type' => 'tab',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array (
                    'width' => 50,
                    'class' => '',
                    'id' => '',
                ),
                'placement' => 'top',
            ),
            array (
                'key' => 'field_551ab2813c52c',
                'label' => 'Title',
                'name' => 'list1_title',
                'prefix' => '',
                'type' => 'text',
                'instructions' => '(optional header for your links)',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array (
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
                'readonly' => 0,
                'disabled' => 0,
            ),
            array (
                'key' => 'field_551ab30092499',
                'label' => 'Links',
                'name' => 'list1_links',
                'prefix' => '',
                'type' => 'repeater',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array (
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'min' => '',
                'max' => '',
                'layout' => 'table',
                'button_label' => 'Add Link',
                'sub_fields' => array (
                    array (
                        'key' => 'field_551ab3009249a',
                        'label' => 'Link Text',
                        'name' => 'link_text',
                        'prefix' => '',
                        'type' => 'text',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array (
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'maxlength' => '',
                        'readonly' => 0,
                        'disabled' => 0,
                    ),
                    array (
                        'key' => 'field_551ab3009249b',
                        'label' => 'URL',
                        'name' => 'url',
                        'prefix' => '',
                        'type' => 'text',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array (
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => '',
                        'placeholder' => '',
                    ),
                ),
            ),
            array (
                'key' => 'field_5515c255ffba1',
                'label' => 'List 2',
                'name' => '',
                'prefix' => '',
                'type' => 'tab',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array (
                    'width' => 50,
                    'class' => '',
                    'id' => '',
                ),
                'placement' => 'top',
            ),
            array (
                'key' => 'field_551ab2b992492',
                'label' => 'Title',
                'name' => 'list2_title',
                'prefix' => '',
                'type' => 'text',
                'instructions' => '(optional header for your links)',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array (
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
                'readonly' => 0,
                'disabled' => 0,
            ),
            array (
                'key' => 'field_551ab2e492496',
                'label' => 'Links',
                'name' => 'list2_links',
                'prefix' => '',
                'type' => 'repeater',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array (
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'min' => '',
                'max' => '',
                'layout' => 'table',
                'button_label' => 'Add Link',
                'sub_fields' => array (
                    array (
                        'key' => 'field_551ab2ed92497',
                        'label' => 'Link Text',
                        'name' => 'link_text',
                        'prefix' => '',
                        'type' => 'text',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array (
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'maxlength' => '',
                        'readonly' => 0,
                        'disabled' => 0,
                    ),
                    array (
                        'key' => 'field_551ab2f292498',
                        'label' => 'URL',
                        'name' => 'url',
                        'prefix' => '',
                        'type' => 'url',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array (
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => '',
                        'placeholder' => '',
                    ),
                ),
            ),
        ),
        'location' => array (
            array (
                array (
                    'param' => 'options_page',
                    'operator' => '==',
                    'value' => 'footer',
                ),
            ),
        ),
        'menu_order' => 1,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
    ));

    register_field_group(array (
        'key' => 'group_5515af36c7ad2',
        'title' => 'Social Media',
        'fields' => array (
            array (
                'key' => 'field_56170de365aba',
                'label' => 'Adding Social Media Links',
                'name' => 'adding_social_media_links',
                'type' => 'message',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array (
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'message' => 'If your office/group has its own dedicated social media accounts you may add links below. Please make sure you are aware of the <a href="http://medicine.wustl.edu/brand/social-media/" target="_blank">WUSM Social Media Guidelines</a>, and contact Medical Public Affairs if you have any questions.',
                'new_lines' => 'wpautop',
                'esc_html' => 0,
            ),
            array (
                'key' => 'field_5515af4274b0c',
                'label' => 'Facebook',
                'name' => 'facebook',
                'prefix' => '',
                'type' => 'url',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array (
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'placeholder' => '',
            ),
            array (
                'key' => 'field_5515af6774b0e',
                'label' => 'Twitter',
                'name' => 'twitter',
                'prefix' => '',
                'type' => 'url',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array (
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'placeholder' => '',
            ),
            array (
                'key' => 'field_557736f387c3f',
                'label' => 'Instagram',
                'name' => 'instagram',
                'prefix' => '',
                'type' => 'url',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array (
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'placeholder' => '',
            ),
            array (
                'key' => 'field_5515af7a74b0f',
                'label' => 'LinkedIn',
                'name' => 'linkedin',
                'prefix' => '',
                'type' => 'url',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array (
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'placeholder' => '',
            ),
            array (
                'key' => 'field_5515b1d274b10',
                'label' => 'YouTube Playlist',
                'name' => 'youtube',
                'prefix' => '',
                'type' => 'url',
                'instructions' => 'Contact Medical Public Affairs to have your videos uploaded to the official School of Medicine YouTube channel.',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array (
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'placeholder' => '',
            ),
        ),
        'location' => array (
            array (
                array (
                    'param' => 'options_page',
                    'operator' => '==',
                    'value' => 'footer',
                ),
            ),
        ),
        'menu_order' => 2,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
    ));
    
}

if(function_exists("register_field_group"))
{
    register_field_group(array (
        'id' => 'acf_left-navigation-menu',
        'title' => 'Left Navigation Menu',
        'fields' => array (
            array (
                'key' => 'field_52e04d925f72e',
                'label' => 'Title',
                'name' => 'left_nav_menu_title',
                'type' => 'text',
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'formatting' => 'html',
                'maxlength' => '',
            ),
            array (
                'key' => 'field_52e7f22d0203f',
                'label' => 'Hide?',
                'name' => 'hide_in_left_nav',
                'type' => 'true_false',
                'message' => '',
                'default_value' => 0,
            ),
        ),
        'location' => array (
            array (
                array (
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'page',
                    'order_no' => 0,
                    'group_no' => 0,
                ),
                array (
                    'param' => 'page_type',
                    'operator' => '!=',
                    'value' => 'front_page',
                ),
            ),
        ),
        'options' => array (
            'position' => 'acf_after_title',
            'layout' => 'default',
            'hide_on_screen' => array (
                0 => 'custom_fields',
                1 => 'discussion',
                2 => 'comments',
                3 => 'format',
                4 => 'send-trackbacks',
            ),
        ),
        'menu_order' => 0,
    ));
}
