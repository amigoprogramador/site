<?php return [
    'plugin' => [
        'name' => 'Author Biography',
        'description' => 'Extending Backend Users for short and full biography fields'        
    ],
    'fields' => [
    	'facebook_link' => 'Facebook URL',
    	'linkedin_link' => 'LinkedIn URL',
    	'twitter_link' => 'Twitter URL',
    	'youtube_link' => 'YouTube URL',
    	'instagram_link' => 'Instagram URL',
    	'short_biography' => 'Short biography',
    	'biography' => 'Full length biography',
    	'user_position_name' => 'Work position',
        'primary_phone' => 'Primary phone number',
        'mobile_phone' => 'Mobile phone number',
        'skype_username' => 'Skype',
        'public_email' => 'Public e-mail address',
        'private_email' => 'Private e-mail address'
    ],
    'tabs' => [
    	'social_networks' => 'Social networks',
    	'contact_informations' => 'Contact informations',
    	'biography' => 'Biography'
    ],
    'roles' => [
    	'colaborative' => 'Colaborative',
    	'author' => 'Author / Writter',
    	'editor' => 'Editor',
    	'editor_in_chief' => 'Editor in chief',
    	'photographer' => 'Photographer',
    ]
];