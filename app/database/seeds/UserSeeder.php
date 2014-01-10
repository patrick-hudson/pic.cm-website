<?php

class UserSeeder extends DatabaseSeeder {

    public function run() {
        $user = [
            [
                "username" => "connorw600",
                "password" => Hash::make("p@ssw0rd!"),
                "email" => "connorw700@gmail.com"
            ]
        ];
        foreach ($user as $u) {
            User::create($u);
        }
    }

}
