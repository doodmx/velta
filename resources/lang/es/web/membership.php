<?php

return [

    'title'               => 'Dinero para hacer más dinero',
    'copy'                => 'Estamos generando un alto volumen de oportunidades y hemos decidido capitalizarlas con la inversión de redes de confianza con 3 formatos.',
    'profit_tax'          => '*Ganancia IVA incluido',
    'investment_plans'    => 'Membresías Velta Partners',
    'investment_plan_cta' => 'Invertir ahora',
    'vp_membership'       => [
        'title' => 'Membresía Velta Partner',
        'copy'  => 'Es tu llave de entrada a la comunidad Velta, la membresía Velta Partner te permite acceder a los diferentes proyectos que trabajarán para crecer 
                  tu inversión de forma muy superior. Mientras se crean y capitalizan las diferentes oportunidades, recibes una renta mensual por tu capital invertido, 
                  por eso también se le conoce como inmueble digital.'
    ],
    'project_actions'     => [
        'title' => 'Acciones por proyecto',
        'copy'  => 'Hemos iniciado la construcción de plazas comerciales, oficinas, departamentos, centros médicos, restaurantes y bares donde puedes invertir en 
                    acciones de cada proyecto que te interese.'
    ],
    'factoring'           => [
        'title' => 'Factoraje comercial',
        'copy'  => 'Durante el año se presentan diferentes ventanas de tiempo en donde tenemos productos vendidos antes de comprarlos y se abre la opción de que inviertas 
                    y ganes increíbles rendimientos en periodos cortos de tiempo. Otro beneficio de la membresía velta Partner.'
    ],

    'formats'    => [

        [
            'name'      => 'Formatos de inversión',
            'amount'    => 'Monto inicial',
            'profit'    => '% crecimiento anual fijo',
            'period'    => 'Plazo',
            'liquidity' => 'Liquidez del rendimiento',
            'risk'      => 'Nivel de Riesgo',
            'app'       => 'Aplicación para control de inversión',

        ],
        [
            'name'      => 'Inmueble digital',
            'subtitle'  => 'Membresía VP',
            'amount'    => '50,000 MXN',
            'profit'    => '9%, 12%, 15%',
            'period'    => '1, 3 y 5 años',
            'liquidity' => 'Mensual y/o Anual',
            'risk'      => 'Muy bajo',

        ],
        [
            'name'      => 'Factoraje comercial',
            'amount'    => '50,000 MXN',
            'profit'    => '18% - 25%',
            'period'    => 'Meses',
            'liquidity' => 'Por oportunidad',
            'risk'      => 'Bajo',

        ],
        ['name'      => 'Acciones por proyecto',
         'amount'    => '1,000,000 MXN',
         'profit'    => '25% - 50%',
         'period'    => '3, 5 y 10 años',
         'liquidity' => 'Por proyecto',
         'risk'      => 'Medio',

        ],

    ],
    'plans'      => [
        [
            'name'        => 'Bronze',
            'circle'      => 'bronze',
            'from_amount' => '50,000 MXN',
            'to_amount'   => '250,000 MXN',
            'features'    => [
                'Invitación prioritaria para proyectos de oportunidad',
                'App Velta',
                'Invitación evento anual',
                'Descuentos en negocios del grupo',
            ]
        ],
        [
            'name'        => 'Silver',
            'circle'      => 'silver',
            'from_amount' => '300,000 MXN',
            'to_amount'   => '600,000 MXN',
            'features'    => [
                'Invitación prioritaria para proyectos de oportunidad',
                'App Velta',
                'Invitación evento anual',
                'Descuentos en negocios del grupo',
            ]
        ],
        [
            'name'        => 'Gold',
            'circle'      => 'gold',
            'from_amount' => '700,000 MXN',
            'to_amount'   => '1,000,000 MXN',
            'features'    => [
                'Invitación prioritaria para proyectos de oportunidad',
                'App Velta',
                'Invitación evento anual',
                'Descuentos en negocios del grupo',
                'Soporte Fiscal VIP',
            ]
        ],
        [
            'name'        => 'Black',
            'circle'      => 'black',
            'from_amount' => '+1,000,000 MXN',
            'to_amount'   => '',
            'features'    => [
                'Invitación prioritaria para proyectos de oportunidad',
                'App Velta',
                'Invitación evento anual',
                'Descuentos en negocios del grupo',
                'Soporte Fiscal VIP'
            ]
        ]
    ],
    'calculator' => [
        'title'       => 'Simulador del crecimiento de tu inversión en una membresía Velta',
        'subtitle'    => '*Aún si no participaras en ningún proyecto extra tu crecimiento es hasta 3 veces superior que el de comprar inmuebles',
        'input_label' => 'Mi Inversión',
        'cta'         => 'Calcular'
    ],
    'profits'    => [
        'anual'   => [
            'title'       => 'Ganancia anual',
            'table_cross' => 'Inversión/Años',
            'first_year'  => '1er año',
            'third_year'  => '3er año',
            'fifth_year'  => '5to año',
        ],
        'monthly' => [
            'title'             => 'Ganancia mensual',
            'table_cross'       => 'Inversión/Meses',
            'twelve_months'     => '12 meses',
            'thirty_six_months' => '36 meses',
            'sixty_months'      => '60 meses',
        ]

    ],
    'app_copy'   => 'Hemos desarrollado la aplicación para que tengas en tus manos el control de tu capital y puedas estar enterado 
                     de los nuevos proyectos y oportunidades de inversión. '
];
