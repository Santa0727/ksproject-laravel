<?php

return [

    'seat_size' => [
        'width' => 25,
        'height' => 25,
    ],

    'session' => [
        'admin' => [
            'account' => 'MELAKA_ADMIN_ACCOUNT',
            'agent' => 'MELAKA_ADMIN_AGENT',
            'counter' => 'MELAKA_ADMIN_COUNTER',
            'event' => 'MELAKA_ADMIN_EVENT',
            'show' => 'MELAKA_ADMIN_SHOW',
            'venue' => 'MELAKA_ADMIN_VENUE',
            'booking' => 'MELAKA_ADMIN_BOOKING',
        ],
        'agent' => [
            'user' => 'MELAKA_AGENT_USER',
        ]
    ],

    'login_user' => 'MELAKA_TICKETING_USER',

    'upload' => [
        'user_photo' => '',

    ],

    'account_type' => [
        'admin' => 'ADMIN',
        'sub_admin' => 'SUB_ADMIN',
        'agent' => 'AGENT',
        'sub_agent_lv3' => 'SUB_AGENT_LV3',
        'sub_agent_lv4' => 'SUB_AGENT_LV4',
        'counter' => 'COUNTER',
    ],
    'account_active' => [
        'yes' => 'T',
        'no' => 'F',
    ],
    'account_role_level' => [
        'view' => 'R',
        'change' => 'W',
    ],
    'agent_type' => [
        'Travel Agent' => 'A',
        'Tour Guide' => 'G',
        'Hotel' => 'H',
        'Rasa Melaka' => 'Z',
    ],

    'payment_type' => [
        'Cash' => 'CASH',
        'Credit / Debit Card' => 'CARD',
        'PayPal' => 'PAYPAL',
        'iPay88' => 'IPAY88',
        'WeChat Pay & Ali-Pay' => 'WECHAT',
    ],

    'ticket_type' => [
        'M' => 'Malaysian',
        'NM' => 'Non-Malaysian',
        'C' => 'Concession',
        'VIP' => 'VIP',
        'MC' => 'Melaka Citizens',
        'F' => 'Free Ticket',
    ],

    'available' => [
        'yes' => 'T',
        'no' => 'F',
    ],

    'ticket_status' => [
        'available' => 'A',
        'pending' => 'S',
        'purchased' => 'P',
        'locked' => 'L',
    ],

    'week' => [
        'WEEKDAY' => 'Weekday',
        'WEEKEND' => 'Weekend',
        'BOTH' => 'Both',
    ],
];
