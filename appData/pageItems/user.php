<?php
/**
 * сообщения, имена полей, правила заполнения, связанные с
 * регистрацией, входом, профилем
 */
use app\models\UserRegistration;

$loginForm = [
    'title' => [
        'text' => [
            'ru' => 'ВОЙТИ',
            'en' => 'LOGIN'
        ],
    ],
    'rules' => [
        'title' => [
            'text' => [
                'ru' => 'заполните следующие поля для входа, используя правила:',
                'en' => 'fill out the following fields to login using the rules:'
            ]
        ],
        'content' => [
            'text' => [
                'ru' => '- Обязательные поля отмечены символом <span style="color:red">"*"</span><br>' .
                        '- если впервые заходите на наш сайт, используйте пункт меню "регистрация" '
                ,
                'en' => '- Required fields are marked with <span style="color:red">"*"</span> symbol>br>'.
                        '- if first visit our website, use the menu item "registration"'
            ]
        ]
    ],
    'messages' => [
        'username' => [
            'text' => [
                'ru' => 'Неправильное имя пользователя',
                'en' => 'Incorrect user name'
            ]
        ],
        'password' => [
            'text' => [
                'ru' => 'Неправильный пароль',
                'en' => 'Incorrect password'
            ]
        ],
    ]
];
$nameMin = UserRegistration::NAME_MIN_LENGTH;
$nameMax = UserRegistration::NAME_MAX_LENGTH;
$passwMin = UserRegistration::PASSW_MIN_LENGTH;
$passwMax = UserRegistration::PASSW_MAX_LENGTH;

$registrationForm = [
    'title' => [
        'text' => [
            'ru' => 'РЕГИСТРАЦИЯ ПОЛЬЗОВАТЕЛЯ',
            'en' => 'USER REGISTRATION'
        ],
    ],
    'rules' => [
        'title' => [
            'text' => [
                'ru' => 'заполните следующие поля для регистрации, используя правила:',
                'en' => 'fill out the following fields to registration using the rules:'
            ]
        ],
        'content' => [
            'text' => [
                'ru' =>
                    '- Обязательные поля отмечены символом <span style="color:red">"*"</span>' . '<br>' .
                    '- Для заполнения полей: "имя пользователя", "пароль" использовать следующие символы:<br>
                    строчные буквы латинского алфавита (a,..,z), десятичные цифры (0,...,9), подчёркивание (_),
                    знак минус (-). Пробелы не допускаются.' . '<br>' .
                    '- Длина поля "имя пользователя" от ' . $nameMin . ' до ' . $nameMax . ' символов ' . '<br>' .
                    '- Длина поля "пароль" от ' . $passwMin . ' до ' . $passwMax . ' символов ' . '<br>' .
                    '- Поле "электронная почта" должно иметь вид: qwerty@mail.ru' . '<br>' .
                    '- Поле "электронная почта" используется как дополнительный идентификатор пользователя,' .
                    'потому его значение должно быть уникальным' . '<br>' .
                    '- Поле "сайт" - это полный url-адрес вида: http://mysite.ru' . '<br>'
                ,
                'en' =>
                    '- Required fields are marked with <span style="color:red">"*"</span> symbol<br>' .
                    '- Fields: "username", "password" use the following symbols:<br>' .
                    'lowercase Latin letters (a..z), decimal digits (0,...,9), underscore (_),' .
                    'a minus sign (-). Spaces are not allowed.<br>' .
                    '- The length of the field "user name" from ' . $nameMin . ' to' . $nameMax . ' characters.<br>' .
                    '- The length of the "password" field from ' . $passwMin . ' to ' . $passwMax . ' characters.<br>' .
                    '- The field "email" should be: myname@mail.ru.<br>' .
                    '- The field "email" is used as an additional identifier of the user,
                       because its value must be unique<br>' .
                    '- The field "website" is the full url of the form: http://mysite.ru.'

            ]
        ],
        'messages' => [
            'success' => [
                'text' => [
                    'ru' => 'Регистрация пользователя выполнена. Другие реквизиты можно редактировать через
                         пункт меню "профиль" ',
                    'en' => 'User registration is performed. Other props can be edited via
                         the menu item "profile"'
                ]
            ],
            'error' => [
                'text' => [
                    'ru' => 'Регистрация пользователя не выполнена.',
                    'en' => 'User registration is not performed.'
                ]
            ]

        ]
    ]
];

$profileForm = [
    'title' => [
        'text' => [
            'ru' => 'РЕДАКТИРОВАНИЕ ПРОФИЛЯ ПОЛЬЗОВАТЕЛЯ',
            'en' => 'EDIT THE USER PROFILE'
        ],
    ],
    'rules' => [
        'title' => [
            'text' => [
                'ru' => 'можете изменить следующие поля профиля, используя правила:',
                'en' => 'can change the following profile fields using the rules:'
            ]
        ],
        'content' => [
            'text' => [
                'ru' =>
                    '-Обязательные поля отмечены символом <span style="color:red">"*"</span>' . '<br>' .
                    '-Поле "электронная почта" должно иметь вид: qwerty@mail.ru' . '<br>' .
                    '-Поле "сайт" - это полный url-адрес вида: http://mysite.ru' . '<br>' .
                    '-Кнопкой "восстановить" можно вернуть последние сохранённые значения' . '<br>' .
                    '-Если нажата кнопка "сохранить", то предшествующие значения будут заменены текущими'
                ,
                'en' =>
                    '-Required fields are marked with <span style="color:red"> "*"</span> symbol<br>' .
                    '-The field "email" should be: myname@mail.ru.' . '<br>' .
                    '-The field "website" is the full url of the form: http://mysite.ru.' . '<br>' .
                    '-Click "restore" to return to the last saved values' . '<br>' .
                    '-If you press "save", the previous values are replaced by the current'

            ]
        ],
        'messages' => [
            'success' => [
                'text' => [
                    'ru' => 'Профиль сохранён',
                    'en' => 'The profile is saved.'
                ]
            ],
            'error' => [
                'text' => [
                    'ru' => 'Профиль не сохранён.',
                    'en' => 'The profile is not saved.'
                ]
            ]

        ]

    ]
];
$fields = [
    'imageFile' => [
        'text' => [
            'ru' => 'файл-изображение для аватара',
            'en' => 'image file for your avatar'
        ]
    ],
    'username' => [
        'text' => [
            'ru' => 'имя пользователя',
            'en' => 'username'
        ]
    ],
    'password' => [
        'text' => [
            'ru' => 'пароль',
            'en' => 'password'
        ]
    ],
    'password_repeat' => [
        'text' => [
            'ru' => 'повторить пароль',
            'en' => 'password repeat'
        ]
    ],
    'email' => [
        'text' => [
            'ru' => 'эл-почта',
            'en' => 'email'
        ]
    ],
    'tel' => [
        'text' => [
            'ru' => 'телефон',
            'en' => 'phone'
        ]
    ],
    'site' => [
        'text' => [
            'ru' => 'сайт',
            'en' => 'web site'
        ]
    ],
    'company' => [
        'text' => [
            'ru' => 'компания',
            'en' => 'company'
        ]
    ],
    'info' => [
        'text' => [
            'ru' => 'характеристика компании',
            'en' => 'company description'
        ]
    ],
    'rememberMe' => [
        'text' => [
            'ru' => 'запомнить меня',
            'en' => 'remember me'
        ]
    ],

];
$buttons = [
    'upload' => [
        'text' => [
            'ru' => 'загрузить изображение',
            'en' => 'upload image'
        ]
    ],
    'login' => [
        'text' => [
            'ru' => 'войти',
            'en' => 'login'
        ]
    ],
    'logout' => [
        'text' => [
            'ru' => 'отключиться',
            'en' => 'logout'
        ]
    ],
    'registration' => [
        'text' => [
            'ru' => 'регистрироваться',
            'en' => 'registration'
        ]
    ],

    'saveProfile' => [
        'text' => [
            'ru' => 'сохранить профиль',
            'en' => 'save profile'
        ]
    ],
    'restoreProfile' => [
        'text' => [
            'ru' => 'восстановить прежние значения',
            'en' => 'restore previous values'
        ]
    ],


];
return [
    'forms' => [
        'loginForm' => $loginForm,
        'registrationForm' => $registrationForm,
        'profileForm' => $profileForm,
    ],
    'fields' => $fields,
    'buttons' => $buttons
];