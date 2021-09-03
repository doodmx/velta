<?php

return [
    'contact'  => [
        'title'  => 'Do you want to know more about Velta?',
        'success' => 'We have received your request',
        'error'   => 'There was an error sending your request, try later',
        'action' => 'Submit',
        'fields' => [
            'email'    => [
                'placeholder' => 'Email'
            ],
            'whatsapp' => [
                'placeholder' => 'WhatsApp'
            ]
        ]
    ],
    'schedule' => [
        'title'  => 'Make an appointment',
        'success' => 'We have received your request',
        'error'   => 'There was an error sending your request, try later',
        'action' => 'Submit',
        'fields' => [
            'name'     => [
                'placeholder' => 'First Name'
            ],
            'lastname' => [
                'placeholder' => 'Last Name'
            ],
            'email'    => [
                'placeholder' => 'Email'
            ],
            'whatsapp' => [
                'placeholder' => 'WhatsApp'
            ]
        ]
    ],
    'register' => [
        'title'  => '<span class="d-block">Join to</span><strong>Velta Partners</strong>',
        'action' => 'Submit',
        'copy'   => 'Fill the data',
        'fields' => [
            'name'            => [
                'placeholder'  => 'First name',
                'validate_msg' => [
                    'required' => 'First name is required.'
                ]
            ],
            'lastname'        => [
                'placeholder'  => 'Last name',
                'validate_msg' => [
                    'required' => 'Last name is required.'
                ]
            ],
            'email'           => [
                'placeholder'  => 'Email',
                'validate_msg' => [
                    'required' => 'Email is required.',
                    'type'     => 'Email is not valid.'
                ]
            ],
            'whatsapp'        => [
                'placeholder'  => 'WhatsApp',
                'validate_msg' => [
                    'required'  => 'Whatsapp is required.',
                    'minlength' => 'The number is invalid.'
                ]
            ],
            'id_card'         => [
                'placeholder'  => 'Upload your ID',
                'validate_msg' => [
                    'required' => 'ID is required.',
                ]
            ],
            'proof_residence' => [
                'placeholder'  => 'Upload your proof of residence',
                'validate_msg' => [
                    'required' => 'Proof of residence is required.',
                ]
            ],
            'terms'           => [
                'placeholder'  => 'I agree to privacy policy.',
                'validate_msg' => [
                    'required' => 'Please accept terms and conditions.',
                ]
            ]
        ]
    ]
];
