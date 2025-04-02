<?php

return [

    'label' => ':label экспорттау',

    'modal' => [

        'heading' => ':label экспорттау',

        'form' => [

            'columns' => [

                'label' => 'Бағандар',

                'form' => [

                    'is_enabled' => [
                        'label' => ':column қосулы',
                    ],

                    'label' => [
                        'label' => ':column белгісі',
                    ],

                ],

            ],

        ],

        'actions' => [

            'export' => [
                'label' => 'Экспорттау',
            ],

        ],

    ],

    'notifications' => [

        'completed' => [

            'title' => 'Экспорт аяқталды',

            'actions' => [

                'download_csv' => [
                    'label' => '.csv жүктеу',
                ],

                'download_xlsx' => [
                    'label' => '.xlsx жүктеу',
                ],

            ],

        ],

        'max_rows' => [
            'title' => 'Экспорт тым үлкен',
            'body' => 'Сіз бір жолдан артық экспорттай алмайсыз.|Сіз :count жолдан артық экспорттай алмайсыз.',
        ],

        'started' => [
            'title' => 'Экспорт басталды',
            'body' => 'Сіздің экспорттауыңыз басталды, 1 жол фоныңда өңделеді.|Сіздің экспорттауыңыз басталды, :count жол фоныңда өңделеді.',
        ],

    ],

    'file_name' => 'export-:export_id-:model',

];
