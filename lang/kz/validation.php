<?php

declare(strict_types=1);

return [
    'accepted'               => ':attribute қабылдануы тиіс.',
    'accepted_if'            => ':attribute қабылдануы тиіс, егер :other :value тең болса.',
    'active_url'             => ':attribute өрісінің мәні дұрыс URL болуы керек.',
    'after'                  => ':attribute өрісінің мәні :date кейінгі күн болуы тиіс.',
    'after_or_equal'         => ':attribute өрісінің мәні :date кейінгі немесе тең күні болуы тиіс.',
    'alpha'                  => ':attribute өрісінің мәні тек әріптерден тұруы керек.',
    'alpha_dash'             => ':attribute өрісінің мәні тек әріптерден, сандардан, дефис пен астын сызудан тұруы керек.',
    'alpha_num'              => ':attribute өрісінің мәні тек әріптер мен сандардан тұруы керек.',
    'array'                  => ':attribute өрісінің мәні массив болуы керек.',
    'ascii'                  => ':attribute өрісінің мәні тек бір байтты әріп-сан таңбаларынан тұруы керек.',
    'before'                 => ':attribute өрісінің мәні :date алдындағы күн болуы тиіс.',
    'before_or_equal'        => ':attribute өрісінің мәні :date алдындағы немесе тең күні болуы тиіс.',
    'between'                => [
        'array'   => ':attribute өрісіндегі элементтердің саны :min мен :max арасында болуы тиіс.',
        'file'    => ':attribute өрісіндегі файлдың өлшемі :min мен :max Кб арасында болуы тиіс.',
        'numeric' => ':attribute өрісінің мәні :min мен :max аралығында болуы тиіс.',
        'string'  => ':attribute өрісіндегі таңбалардың саны :min мен :max аралығында болуы тиіс.',
    ],
    'boolean'                => ':attribute өрісінің мәні логикалық типте болуы тиіс.',
    'can'                    => ':attribute өрісінің мәні рұқсат етілген болуы тиіс.',
    'confirmed'              => ':attribute өрісінің мәні растаумен сәйкес келмейді.',
    'contains'               => ':attribute өрісінде қажетті мән жоқ.',
    'current_password'       => 'Құпиясөз дұрыс емес.',
    'date'                   => ':attribute өрісінің мәні дұрыс күн болуы керек.',
    'date_equals'            => ':attribute өрісінің мәні :date күнге тең болуы тиіс.',
    'date_format'            => ':attribute өрісінің мәні :format күн пішіміне сәйкес болуы керек.',
    'decimal'                => ':attribute өрісінің мәні :decimal ондық сандарынан тұруы тиіс.',
    'declined'               => ':attribute өрісінің мәні қабылданбауы тиіс.',
    'declined_if'            => ':attribute өрісінің мәні қабылданбауы тиіс, егер :other :value тең болса.',
    'different'              => ':attribute және :other өрістері әртүрлі болуы тиіс.',
    'digits'                 => ':attribute өрісіндегі таңбалар саны :digits болуы тиіс.',
    'digits_between'         => ':attribute өрісіндегі таңбалар саны :min мен :max арасында болуы тиіс.',
    'dimensions'             => ':attribute өрісіндегі сурет рұқсат етілмеген өлшемдерге ие.',
    'distinct'               => ':attribute өрісіндегі элементтер қайталанбауы тиіс.',
    'doesnt_end_with'        => ':attribute өрісінің мәні келесімен аяқталмауы тиіс: :values.',
    'doesnt_start_with'      => ':attribute өрісінің мәні келесімен басталмауы тиіс: :values.',
    'email'                  => ':attribute өрісінің мәні дұрыс электронды пошта мекенжайы болуы тиіс.',
    'ends_with'              => ':attribute өрісінің мәні келесімен аяқталуы тиіс: :values',
    'enum'                   => ':attribute өрісінің мәні рұқсат етілген тізімде жоқ.',
    'exists'                 => ':attribute өрісінің мәні жоқ.',
    'extensions'             => ':attribute өрісіндегі файл келесі кеңейтулердің біріне ие болуы тиіс: :values.',
    'file'                   => ':attribute өрісінің мәні файл болуы керек.',
    'filled'                 => ':attribute өрісінің мәні міндетті түрде толтырылуы тиіс.',
    'gt'                     => [
        'array'   => ':attribute өрісіндегі элементтердің саны :value-ден көп болуы тиіс.',
        'file'    => ':attribute өрісіндегі файлдың өлшемі :value Кб-тан үлкен болуы тиіс.',
        'numeric' => ':attribute өрісінің мәні :value-ден көп болуы тиіс.',
        'string'  => ':attribute өрісіндегі таңбалар саны :value-ден көп болуы тиіс.',
    ],
    'gte'                    => [
        'array'   => ':attribute өрісіндегі элементтердің саны :value немесе одан көп болуы тиіс.',
        'file'    => ':attribute өрісіндегі файлдың өлшемі :value Кб немесе одан көп болуы тиіс.',
        'numeric' => ':attribute өрісінің мәні :value немесе одан көп болуы тиіс.',
        'string'  => ':attribute өрісіндегі таңбалар саны :value немесе одан көп болуы тиіс.',
    ],
    'hex_color'              => ':attribute өрісінің мәні HEX форматында дұрыс түс болуы тиіс.',
    'image'                  => ':attribute өрісіндегі файл сурет болуы тиіс.',
    'in'                     => ':attribute өрісінің мәні рұқсат етілген тізімде жоқ.',
    'in_array'               => ':attribute өрісінің мәні :other өрісінде болуы тиіс.',
    'integer'                => ':attribute өрісінің мәні бүтін сан болуы тиіс.',
    'ip'                     => ':attribute өрісінің мәні дұрыс IP мекенжайы болуы тиіс.',
    'ipv4'                   => ':attribute өрісінің мәні дұрыс IPv4 мекенжайы болуы тиіс.',
    'ipv6'                   => ':attribute өрісінің мәні дұрыс IPv6 мекенжайы болуы тиіс.',
    'json'                   => ':attribute өрісінің мәні JSON жолы болуы тиіс.',
    'list'                   => ':attribute өрісінің мәні тізім болуы тиіс.',
    'lowercase'              => ':attribute өрісінің мәні кіші әріптермен болуы тиіс.',
    'lt'                     => [
        'array'   => ':attribute өрісіндегі элементтердің саны :value-ден аз болуы тиіс.',
        'file'    => ':attribute өрісіндегі файлдың өлшемі :value Кб-тан аз болуы тиіс.',
        'numeric' => ':attribute өрісінің мәні :value-ден аз болуы тиіс.',
        'string'  => ':attribute өрісіндегі таңбалар саны :value-ден аз болуы тиіс.',
    ],
    'lte'                    => [
        'array'   => ':attribute өрісіндегі элементтердің саны :value немесе одан аз болуы тиіс.',
        'file'    => ':attribute өрісіндегі файлдың өлшемі :value Кб немесе одан аз болуы тиіс.',
        'numeric' => ':attribute өрісінің мәні :value немесе одан аз болуы тиіс.',
        'string'  => ':attribute өрісіндегі таңбалар саны :value немесе одан аз болуы тиіс.',
    ],
    'mac_address'            => ':attribute өрісінің мәні дұрыс MAC мекенжайы болуы тиіс.',
    'max'                    => [
        'array'   => ':attribute өрісіндегі элементтердің саны :max-тан көп болмауы тиіс.',
        'file'    => ':attribute өрісіндегі файлдың өлшемі :max Кб-тан көп болмауы тиіс.',
        'numeric' => ':attribute өрісінің мәні :max-тан көп болмауы тиіс.',
        'string'  => ':attribute өрісіндегі таңбалардың саны :max-тан көп болмауы тиіс.',
    ],
    'max_digits'             => ':attribute өрісінің мәні :max санынан көп болмауы тиіс.',
    'mimes'                  => ':attribute өрісіндегі файл келесі түрлердің біріне ие болуы тиіс: :values.',
    'mimetypes'              => ':attribute өрісіндегі файл келесі түрлердің біріне ие болуы тиіс: :values.',
    'min'                    => [
        'array'   => ':attribute өрісіндегі элементтердің саны :min-тан аз болмауы тиіс.',
        'file'    => ':attribute өрісіндегі файлдың өлшемі :min Кб-тан аз болмауы тиіс.',
        'numeric' => ':attribute өрісінің мәні :min-тан аз болмауы тиіс.',
        'string'  => ':attribute өрісіндегі таңбалардың саны :min-тан аз болмауы тиіс.',
    ],
    'min_digits'             => ':attribute өрісінің мәні кемінде :min санынан тұруы тиіс.',
    'missing'                => ':attribute өрісінің мәні болмауы тиіс.',
    'missing_if'             => ':attribute өрісінің мәні :other :value тең болғанда болмауы тиіс.',
    'missing_unless'         => ':attribute өрісінің мәні :other :value тең болмаса болмауы тиіс.',
    'missing_with'           => ':attribute өрісінің мәні :values бар болғанда болмауы тиіс.',
    'missing_with_all'       => ':attribute өрісінің мәні :values бар болғанда болмауы тиіс.',
    'multiple_of'            => ':attribute өрісінің мәні :value санына еселі болуы тиіс.',
    'not_in'                 => ':attribute өрісінің мәні тыйым салынған тізімде бар.',
    'not_regex'              => ':attribute өрісінің мәні дұрыс пішінде емес.',
    'numeric'                => ':attribute өрісінің мәні сан болуы тиіс.',
    'password'               => [
        'letters'  => ':attribute өрісінің мәні әріптерден тұруы тиіс.',
        'mixed'    => ':attribute өрісінің мәні кіші және бас әріптерден тұруы тиіс.',
        'numbers'  => ':attribute өрісінің мәні сандардан тұруы тиіс.',
        'symbols'  => ':attribute өрісінің мәні арнайы таңбалардан тұруы тиіс.',
        'uncompromised' => ':attribute өрісінің мәні қауіпсіз емес.',
    ],
    'present'                => ':attribute өрісінің мәні болуы тиіс, бірақ бос болуы мүмкін.',
    'prohibited'             => ':attribute өрісінің мәні тыйым салынған.',
    'prohibited_if'          => ':attribute өрісінің мәні :other :value болғанда тыйым салынған.',
    'prohibited_unless'      => ':attribute өрісінің мәні :other :value тең болмаса тыйым салынған.',
    'prohibits'              => ':attribute өрісі :other өрісінің мәнін қамтуы тыйым салынған.',
    'regex'                  => ':attribute өрісінің мәні дұрыс пішімде болуы тиіс.',
    'required'               => ':attribute өрісінің мәні міндетті түрде енгізілуі тиіс.',
    'required_if'            => ':attribute өрісінің мәні :other :value тең болғанда міндетті түрде енгізілуі тиіс.',
    'required_unless'        => ':attribute өрісінің мәні :other :value тең болмаса міндетті түрде енгізілуі тиіс.',
    'required_with'          => ':attribute өрісінің мәні :values бар болғанда міндетті түрде енгізілуі тиіс.',
    'required_with_all'      => ':attribute өрісінің мәні :values бар болғанда міндетті түрде енгізілуі тиіс.',
    'required_without'       => ':attribute өрісінің мәні :values жоқ болғанда міндетті түрде енгізілуі тиіс.',
    'required_without_all'   => ':attribute өрісінің мәні :values ешқайсысы жоқ болғанда міндетті түрде енгізілуі тиіс.',
    'same'                   => ':attribute және :other өрістері бірдей болуы тиіс.',
    'size'                   => [
        'array'   => ':attribute өрісіндегі элементтердің саны :size болуы тиіс.',
        'file'    => ':attribute өрісіндегі файлдың өлшемі :size Кб болуы тиіс.',
        'numeric' => ':attribute өрісінің мәні :size болуы тиіс.',
        'string'  => ':attribute өрісіндегі таңбалардың саны :size болуы тиіс.',
    ],
    'starts_with'            => ':attribute өрісінің мәні келесімен басталуы тиіс: :values',
    'string'                 => ':attribute өрісінің мәні мәтін болуы тиіс.',
    'timezone'               => ':attribute өрісінің мәні дұрыс аймақ болуы тиіс.',
    'unique'                 => ':attribute өрісінің мәні қайталанбайтын болуы тиіс.',
    'uploaded'               => ':attribute өрісіндегі файлды жүктеу сәтсіз аяқталды.',
    'url'                    => ':attribute өрісінің мәні дұрыс URL болуы тиіс.',
    'uuid'                   => ':attribute өрісінің мәні дұрыс UUID болуы тиіс.',
];

