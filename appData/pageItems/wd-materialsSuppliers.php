<?php
/**
 * направление - Поставщики специализированных строительных материалов
 * Suppliers of specialised building materials
 */
$textRu = <<<TEXT
Федеральный портал «Перестройка» уделяет внимание не только строительным бригадам — подрядчикам в возведении,
 ремонте и демонтаже зданий и сооружений — но и сопутствующим товарам и услугам.
 Одним из значимых направлений выступает поставка специализированных строительных материалов, анкеров, строительных смесей,
  металлоконструкций и железобетонных изделий.

В Российской Федерации существует большое количество предприятий строительного сектора,
готовых доставить или отправить продукцию по всей стране.
 Сухие химические смеси, купить которые можно во Владивостоке или Калининграде,
 поставляются с заводов в Свердловской области, Пермском крае или Якутии.
  Мы предлагаем исключить логистические связи и приобретать материалы напрямую.
Какие мы предлагаем специализированные строительные материалы?

Практически все. Задавая в поиске «анкерный крепеж», вы получите отзывы поставщиков химического анкера, простого,
 распорного, клинового, забивного. Сухие строительные смеси это целый сегмент, где есть отделочные материалы,
 финишные, для гидроизоляции бетона, защиты металлоконструкций, огнебиозащиты дерева, иных направлений строительства.
На федеральном проекте «Перестройка» заказывают:

    - анкерный крепеж;
    - металлоконструкции;
    - бетон и ЖБИ;
    - сухие строительные смеси;
    - металлопрокат и его изготовление.

Доставка бетона от производителя позволит выбрать самое выгодное предложение с учетом местоположения, объема и качества.
 Схожая ситуация с металлопрокатом, купить который можно от тысяч поставщиков со всей страны.
 На федеральном проекте «Перестройка» вы вправе выбрать как готовые изделия, так и металлопрокат «на заказ»,
 исходя из сформированных потребностей.
Как выбрать поставщика строительных материалов.
Интересуйтесь, как давно работает компания по производству бетона, металлопроката, сухих строительных смесей.
 Какие проекты были реализованы, каков объем рекомендаций и рекламаций.
 Уточните, есть ли на производстве собственный технолог, выпускается ли продукция по франшизе или в рамках договора подряда?
  Обязательно уточните наличие собственных мощностей.

Ведя обсуждение поставки стройматериалов с другого города или субъекта страны, уточните затраты на доставку и
стоимость логистического плеча. Ведь, если анкерам или металлоконструкциям долгая доставка не повредит,
миксер с бетоном должен провести в дороге не более двух часов. Обязательно требуйте заключения договора —
а федеральный проект «Перестройка» в этом поможет!
TEXT;
$textEn = <<<TEXT
<h2>Suppliers of specialised building materials</h2>
....................................................
....................................................
TEXT;
$pieceText = [
    'text' => [
        'ru' => 'Федеральный портал «Перестройка» уделяет внимание не только строительным бригадам — подрядчикам в возведении,
 ремонте и демонтаже зданий и сооружений — но и сопутствующим товарам и услугам.
 Одним из значимых направлений выступает поставка специализированных строительных материалов, анкеров, строительных смесей,
  металлоконструкций и железобетонных изделий ...',
        'en' => 'Federal portal "Restructuring" pays attention not only to the construction team — contractors in the construction,
repair and dismantling of buildings and structures — but related goods and services.
One of the important directions is the supply of specialized building materials, anchors, mortar,
steel structures and concrete products ...'
    ]
];
return [
    'content' => [
        'text' => [
            'ru' => $textRu,
            'en' => $textEn,
        ],
    ],
    'pieceText' => $pieceText,
];