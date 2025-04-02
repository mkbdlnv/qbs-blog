<?php

return [

    'label' => ':label импорттау',

    'modal' => [

        'heading' => ':label импорттау',

        'form' => [

            'file' => [
                'label' => 'Файл',
                'placeholder' => 'CSV файлын жүктеңіз',
            ],

            'columns' => [
                'label' => 'Бағандар',
                'placeholder' => 'Бағанды таңдаңыз',
            ],

        ],

        'actions' => [

            'download_example' => [
                'label' => 'CSV файл мысалын жүктеу',
            ],

            'import' => [
                'label' => 'Импорттау',
            ],

        ],

    ],

    'notifications' => [

        'completed' => [

            'title' => 'Импорттау аяқталды',

            'actions' => [

                'download_failed_rows_csv' => [
                    'label' => 'Қате жолдар туралы ақпаратты жүктеу|Қате жолдар туралы ақпаратты жүктеу',
                ],

            ],

        ],

        'max_rows' => [
            'title' => 'Жүктелген CSV файлы тым үлкен.',
            'body' => 'Сіз бір уақытта 1 жолдан көп импорттай алмайсыз.|Сіз бір уақытта :count жолдан көп импорттай алмайсыз.',
        ],

        'started' => [
            'title' => 'Импорттау басталды',
            'body' => 'Сіздің импорттауыңыз басталды, және 1 жол фондық режимде өңделеді.|Сіздің импорттауыңыз басталды, және :count жолдар фондық режимде өңделеді.',
        ],

    ],

    'example_csv' => [
        'file_name' => ':importer-example',
    ],

    'failure_csv' => [
        'file_name' => 'import-:import_id-:csv_name-сәтсіз-жолдар',
        'error_header' => 'Қате',
        'system_error' => 'Жүйелік қате, техникалық қолдау қызметіне хабарласыңыз.',
    ],

];
