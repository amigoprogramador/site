<?php
return [
    'plugin' => [
        'name' => 'Comments',
        'description' => 'Allows users to comment on blog post',
    ],
    'comment' => [
        'author' => 'TallPro',
        'content' => 'Content',
        'status' => 'Status',
        'comments' => 'Comments',
    ],
    'settings' => [
        'allow_guest_label' => 'Allow Guest',
        'allow_guest_above' => 'Guest posted comments',
        'status_label' => 'Status',
        'login_notification' => 'Login notification',
        'login_notification_comment' => 'for example: Please Login to leave a comment ',
        'approved_notification' => 'Approved comment notification',
        'pending_notification' => 'Pending comment notification',

        'approved_notification_comment' => 'For example: Thanks for your comment!',
        'pending_notification_comment' => 'For example: Your comment is in review!',

        'status_above' => 'Default status for add new comment',
        'section_recaptcha_label' => 'reCAPTCHA Settings',
        'section_recaptcha_comments' => 'Show or Hide reCAPTCHA on contact us form',
        'recaptcha_label' => 'reCAPTCHA',
        'recaptcha_comment' => 'Display reCAPTCHA widget on the form',
        'site_key_label' => 'Site Key',
        'site_key_comment' => 'Your site key provided by google',
        'secret_key_label' => 'Secret Key',
        'secret_key_comment' => 'Your secret key provided by google',
        'no_post' => 'We can\'t recognise your blog post. Make sure your component settings are right.',
        'blog_slug' => 'Blog Slug',
        'blog_slug_comment' => 'By default is ":slug" but maybe yours is ":blogslug" or ":blog-slug". We need to identify your post slug.'
    ]
];