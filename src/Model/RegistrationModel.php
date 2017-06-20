<?php

namespace Shop\Model;

use John\Frame\Validator\Validator;

class RegistrationModel extends MainModel
{
    protected $table = 'users';

    public function doRegistarte($data)
    {
        $validator = new Validator($data, [
            'form_input' => ['require' =>
                [
                'name' => $data['fName'],
                'family' => $data['lName'],
                'email' => $data['email'],
                'password' => $data['password'],
                'password1' => $data['password1']
                ],
            'equal' =>
                [
                'Пароль' => $data['password'],
                'Подтвердить пароль' => $data['password1']
                ]
            ]
        ]);
        $validator->validate();
        if($res=$validator->getErrors()) {
            $errors['errors'] = [];
            foreach ($res as $array) {
                foreach ($array as $key => $value) {
                    array_push($errors, $value);
                }
            }
            return $errors;
        }
        $email = $data['email'];
        $count = $this->findEmail($email);
        if (count($count) > 0)  {
            return ['errors'=>'', 5 => "Пользователь с таким email уже существует" ];
        }
        $name = $data['fName'];
        $family = $data['lName'];
        $email = $data['email'];
        $password = crypt($data['password'], 'salt');
        $this->insertUser($name, $family, $email, $password);
    }
}