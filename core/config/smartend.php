<?php

return [
    'backend_path' => env('BACKEND_PATH', 'admin'),
    'default_language' => env('DEFAULT_LANGUAGE', 'en'),
    'mail_from_address' => env('MAIL_FROM_ADDRESS', 'email@site.com'),
    'mail_username' => env('MAIL_USERNAME', ''),
    'mail_password' => env('MAIL_PASSWORD', ''),
    'mail_driver' => env('MAIL_DRIVER', ''),
    'mail_host' => env('MAIL_HOST', ''),
    'mail_port' => env('MAIL_PORT', ''),
    'mail_encryption' => env('MAIL_ENCRYPTION', ''),
    'backend_pagination' => env('BACKEND_PAGINATION', 30),
    'frontend_pagination' => env('FRONTEND_PAGINATION', 30),
    'frontend_topics_order' => env('FRONTEND_TOPICS_ORDER', 'asc'),
    'date_format' => env('DATE_FORMAT', 'Y-m-d'),
    'nocaptcha_status' => env('NOCAPTCHA_STATUS', false),
    'geoip_status' => env('GEOIP_STATUS', false),
    'geoip_service' => env('GEOIP_SERVICE', "ipapi"),
    'geoip_service_key' => env('GEOIP_SERVICE_KEY', ""),
    'rss_status' => env('RSS_STATUS', false),
    'facebook_status' => env('FACEBOOK_STATUS', false),
    'facebook_id' => env('FACEBOOK_ID', ""),
    'facebook_secret' => env('FACEBOOK_SECRET', ""),
    'twitter_status' => env('TWITTER_STATUS', false),
    'twitter_id' => env('TWITTER_ID', ""),
    'twitter_secret' => env('TWITTER_SECRET', ""),
    'google_status' => env('GOOGLE_STATUS', false),
    'google_id' => env('GOOGLE_ID', ""),
    'google_secret' => env('GOOGLE_SECRET', ""),
    'linkedin_status' => env('LINKEDIN_STATUS', false),
    'linkedin_id' => env('LINKEDIN_ID', ""),
    'linkedin_secret' => env('LINKEDIN_SECRET', ""),
    'github_status' => env('GITHUB_STATUS', false),
    'github_id' => env('GITHUB_ID', ""),
    'github_secret' => env('GITHUB_SECRET', ""),
    'bitbucket_status' => env('BITBUCKET_STATUS', false),
    'bitbucket_id' => env('BITBUCKET_ID', ""),
    'bitbucket_secret' => env('BITBUCKET_SECRET', ""),
    'google_maps_key' => env('GOOGLE_MAPS_KEY', ""),
    'first_day_of_week' => env('FIRST_DAY_OF_WEEK', 0),
    'app_debug' => env('APP_DEBUG', 0),
    'newsletter_status' => env('NEWSLETTER_STATUS', 0),
    'newsletter_provider' => env('NEWSLETTER_PROVIDER', "mailchimp"),
    'newsletter_api_key' => env('NEWSLETTER_API_KEY', ""),
    'newsletter_endpoint' => env('NEWSLETTER_ENDPOINT', ""),
    'newsletter_list_id' => env('NEWSLETTER_LIST_ID', ""),
];