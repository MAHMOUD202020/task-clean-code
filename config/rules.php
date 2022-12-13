<?php

return [
    'name' => ['required', 'string', 'min:4', 'max:20'],
    'phone' => ['required', 'min:7', 'max:20', 'regex:/^([0-9\s\-\+\(\)]*)$/'],
    'password' => ['required', 'string', 'min:6'],
    'email' => ['required', 'email', 'max:100'],
    'communication_channel' => ['required', 'string', 'in:1,2']
];
