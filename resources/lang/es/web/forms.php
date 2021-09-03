<?php

return [
    'contact'  => [
        'title'   => '¿Quieres saber más sobre velta?',
        'success' => 'Hemos recibido tu mensaje, en un momento nos comunicaremos contigo.',
        'error'   => 'Ocurrio un error intente mas tarde',
        'action'  => 'Conectar',
        'fields'  => [
            'email'    => [
                'placeholder' => 'Correo Electrónico'
            ],
            'whatsapp' => [
                'placeholder' => 'WhatsApp'
            ]
        ]
    ],
    'schedule' => [
        'title'  => 'Agenda una cita personalizada.',
        'success' => 'Hemos recibido tu solicitud para agendar una cita, en breve nos comunicaremos contigo.',
        'error'   => 'Ocurrio un error intente mas tarde',
        'action' => 'Enviar',
        'fields' => [
            'name'     => [
                'placeholder' => 'Nombre'
            ],
            'lastname' => [
                'placeholder' => 'Apellidos'
            ],
            'email'    => [
                'placeholder' => 'Correo Electrónico'
            ],
            'whatsapp' => [
                'placeholder' => 'WhatsApp'
            ]
        ]
    ],
    'register' => [
        'title'  => '<span class="d-block">Forma parte de</span><strong>Velta Partner</strong>',
        'action' => 'Enviar solicitud',
        'copy'   => 'Llena la información de tu inversionista',
        'fields' => [
            'name'            => [
                'placeholder'  => 'Nombre',
                'validate_msg' => [
                    'required' => 'El campo nombre es obligatorio.'
                ]
            ],
            'lastname'        => [
                'placeholder'  => 'Apellidos',
                'validate_msg' => [
                    'required' => 'El campo apellidos es obligatorio.'
                ]
            ],
            'email'           => [
                'placeholder'  => 'Correo Electrónico',
                'validate_msg' => [
                    'required' => 'El campo correo electrónico es obligatorio.',
                    'type'     => 'Este valor debe ser un correo electrónico válido..'
                ]
            ],
            'whatsapp'        => [
                'placeholder'  => 'WhatsApp',
                'validate_msg' => [
                    'required'  => 'El campo whatsapp es obligatorio.',
                    'minlength' => 'El número ingresado es incorrecto.'
                ]
            ],
            'id_card'         => [
                'placeholder'  => 'Cargar Identificación',
                'validate_msg' => [
                    'required' => 'Este valor es requerido.',
                ]
            ],
            'proof_residence' => [
                'placeholder'  => 'Cargar Comprobante de domicilio',
                'validate_msg' => [
                    'required' => 'Este valor es requerido.',
                ]
            ],
            'terms'           => [
                'placeholder'  => 'Acepto y conozco el aviso de privacidad.',
                'validate_msg' => [
                    'required' => 'Es necesario aceptar términos y condiciones.',
                ]
            ]
        ]
    ]
];
