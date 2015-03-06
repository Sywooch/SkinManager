<?php

return [

    // models
    'ID' => 'ID',
    'User ID' => 'ID пользователя',
    'Create Time' => 'Дата создания',
    'Update Time' => 'Дата обновления',
    'Full Name' => 'Полное имя',

    'Name' => 'Имя',
    'Can Admin' => 'Имеет права админа',

    'Role' => 'Роль',
    'Role ID' => 'Номер роли',
    'Status' => 'Статус',
    'Email' => 'Email',
    'New Email' => 'Новый Email',
    'Username' => 'Логин',
    'Password' => 'Пароль',
    'Auth Key' => 'Ключ авторизации',
    'Api Key' => 'Ключ API',
    'Login Ip' => 'IP авторизации',
    'Login Time' => 'Дата авторизации',
    'Create Ip' => 'IP создания',
    'Ban Time' => 'Дата бана',
    'Ban Reason' => 'Причина бана',
    'Current Password' => 'Текущий пароль',
    'New Password' => 'Новый пароль',
//    'New Password Confirm' => '',
    'Email Confirmation' => 'Email подтверждение',

    'Provider' => 'Пригласивший',
    'Provider ID' => 'ID пользователя который пригласил',
    'Provider Attributes' => 'Атрибуты приглашения',

    'Type' => 'Тип',
    'Key' => 'Ключ',
    'Consume Time' => 'Дата получения',
    'Expire Time' => 'Срок действия',

    // models/forms
    'Email not found' => 'Email не найден',
    'Email / Username' => 'Логин/email',
    'Email / Username not found' => 'Логин/email не найдены',
    'Username not found' => 'Пользователь не найден',
    'User is banned - {banReason}' => 'Пользователя забанено - {banReason}',
    'Incorrect password' => 'Неверный пароль',
    'Remember Me' => 'Запомнить меня',
    'Email is already active' => 'Email уже активирован',
//    'Passwords do not match' => '',
//    '{attribute} can contain only letters, numbers, and "_"' => '',

    // controllers
    'Successfully registered [ {displayName} ]' => 'Успешно зарегистрирован [ {displayName} ]',
    ' - Please check your email to confirm your account' => ' - Проверьте свою почту, чтобы подтвердить свой ​​аккаунт',
    'Account updated' => 'Дата обновления аккаунта',
    'Profile updated' => 'Дата обновления профиля',
    'Confirmation email resent' => 'Подтверждение по email отправлено заново',
    'Email change cancelled' => 'Изменение email отменено',
    'Instructions to reset your password have been sent' => 'Инструкции по изменению вашего пароля, были отправлены вам на email',

    // mail
    'Please confirm your email address by clicking the link below:' => 'Пожалуйста, подтвердите свой ​​email, нажав на ссылку ниже:',
    'Please use this link to reset your password:' => 'Пожалуйста, воспользуйтесь этой ссылкой для восстановления пароля:',

    // admin views
    'Users' => 'Пользователи',
    'Banned' => 'Забанено',
    'Create' => 'Создать',
    'Update' => 'Сохранить',
    'Delete' => 'Удалить',
    'Search' => 'Поиск',
    'Reset' => 'Сбросить',
    'Create {modelClass}' => 'Создать пользователя',
    'Update {modelClass}: ' => 'Изменить пользователя: ',
    'Are you sure you want to delete this item?' => 'Вы уверены, что хотите удалить аккаунт?',

    // default views
    'Account' => 'Аккаунт',
    'Pending email confirmation: {newEmail}' => 'В ожидании подтверждения по электронной почте: {newEmail}',
    'Cancel' => 'Отменить',
    'Changing your email requires email confirmation' => 'Изменение электронной почты требует подтверждения нового адреса',
    'Confirmed' => 'Подтверждено',
    'Error' => 'Ошибка',
    'Your email [ {email} ] has been confirmed' => 'Ваш адрес электронной почты {email} был подтвержден',
    'Go to my account' => 'К моему аккаунту',
    'Go home' => 'На главную',
    'Log in here' => 'Войти сейчас',
    'Invalid key' => 'Неверный ключ',
    'Forgot password' => 'Восстановить пароль',
    'Submit' => 'Отправить',
    'Yii 2 User' => 'Yii 2 пользователь',
    'Login' => 'Войти',
    'Register' => 'Регистрация',
    'Logout' => 'Выйти',
    'Resend confirmation email' => 'Повторно отправить подтверждение по email',
    'Profile' => 'Профиль',
    'Please fill out the following fields to login:' => 'Пожалуйста, заполните следующие поля для входа:',
    'Please fill out the following fields to register:' => 'Пожалуйста, заполните следующие поля для регистрации:',
    'Resend' => 'Повторить',
    'Password has been reset' => 'Пароль восстановлено',
];