<?php
/**
 * сообщения, имена полей, правила заполнения, связанные с
 * регистрацией, входом, профилем
 */
use app\models\UserRegistration ;
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
                'ru' => 'Обязательные поля отмечены символом "*"',
                'en' => 'Required fields are marked with "*"symbol'
            ]
        ]
    ]
] ;
$nameMin = UserRegistration::NAME_MIN_LENGTH ;
$nameMax = UserRegistration::NAME_MAX_LENGTH ;
$passwMin = UserRegistration::PASSW_MIN_LENGTH ;
$passwMax = UserRegistration::PASSW_MAX_LENGTH  ;

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
                    '-Обязательные поля отмечены символом "*"'.'<br>'.
                    '-Для заполнения полей: "имя пользователя", "пароль" использовать следующие символы:
                    строчные буквы латинского алфавита (a,..,z), десятичные цифры (0,...,9), подчёркивание (_),
                    знак минус (-). Пробелы не допускаются.'.'<br>'.
                    '-Длина поля "имя пользователя" от ' . $nameMin . ' до ' . $nameMax .' символов '.'<br>'.
                    '-Длина поля "пароль" от ' . $passwMin . ' до ' . $passwMax .' символов '.'<br>'.
                    '-Поле "электронная почта" должно иметь вид: qwerty@mail.ru'. '<>br'.
                    '-Поле "сайт" - это полный url-адрес вида: http://mysite.ru'. '<>br'
                ,
                'en' =>
                    '-Required fields are marked with "*"symbol<br>' .
                    '-Fields: "username", "password" use the following symbols:' .
                    'lowercase Latin letters (a..z), decimal digits (0,...,9), underscore (_),' .
                     'a minus sign (-). Spaces are not allowed.' .
                     '-The length of the field "user name" from ' . $nameMin . ' to' . $nameMax .' characters.' .
                     '-The length of the "password" field from ' . $passwMin . ' to ' . $passwMax .' characters.' .
                     '-The field "email" should be: myname@mail.ru.' .
                     '-The field "website" is the full url of the form: http://mysite.ru.'

            ]
        ]
    ]
] ;

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
                    '-Обязательные поля отмечены символом "*"'.'<br>'.
                    '-Для заполнения полей: "имя пользователя", "пароль" использовать следующие символы:
                    строчные буквы латинского алфавита (a,..,z), десятичные цифры (0,...,9), подчёркивание (_),
                    знак минус (-). Пробелы не допускаются.'.'<br>'.
                    '-Длина поля "имя пользователя" от ' . $nameMin . ' до ' . $nameMax .' символов '.'<br>'.
                    '-Длина поля "пароль" от ' . $passwMin . ' до ' . $passwMax .' символов '.'<br>'.
                    '-Поле "электронная почта" должно иметь вид: qwerty@mail.ru'. '<>br'.
                    '-Поле "сайт" - это полный url-адрес вида: http://mysite.ru'. '<>br'
                ,
                'en' =>
                    '-Required fields are marked with "*"symbol<br>' .
                    '-Fields: "username", "password" use the following symbols:' .
                    'lowercase Latin letters (a..z), decimal digits (0,...,9), underscore (_),' .
                    'a minus sign (-). Spaces are not allowed.' .
                    '-The length of the field "user name" from ' . $nameMin . ' to' . $nameMax .' characters.' .
                    '-The length of the "password" field from ' . $passwMin . ' to ' . $passwMax .' characters.' .
                    '-The field "email" should be: myname@mail.ru.' .
                    '-The field "website" is the full url of the form: http://mysite.ru.'

            ]
        ]
    ]
] ;