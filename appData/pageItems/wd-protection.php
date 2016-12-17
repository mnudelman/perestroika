<?php
/**
 * направление - защита и восстановление строительных конструкций
 *Protection and restoration of building structures
 */
$textRu = <<<TEXT
Одним из наиболее важных направлений в строительстве является защита и восстановление строительных конструкций.
В отличие от переноса или демонтажа внутренних перегородок, капитальные конструкции невозможно разобрать без
нарушения целостности всего здания. И здесь важно не ошибиться с выбором специалистов!

Федеральный портал «Перестройка» знает, как сложно найти бригаду по защите строительных конструкций и создал
отдельное направление формы заказа. Здесь вы можете выбрать конкретное направление вроде гидроизоляции бетона,
защиты металла, огнебиозащиты деревянных конструкций, армирования металлоконструкций, ремонта бетона и бетонных перекрытий.
Основные направления по защите конструкций.

Чаще всего жители страны ищут в интернете гидроизоляцию фундамента, что продлевает жизнь здания в несколько раз.
 В последнее время, с ростом популярности частных домов, популярностью стала пользоваться огнезащита деревянных конструкций.
  Также защита конструкций препятствует образованию ржавчины на арматуре и металлических швеллерах, балках и таврах.
На «Перестройке» заказывают:

    - огнезащиту и гидроизоляцию строительных конструкций;
    - ремонт бетонных поверхностей с заделкой трещин и сколов;
    - восстановление несущей способности стен и полов;
    - усиление строительных конструкций металлом и пластиком;
    - восстановление внешнего вида и надежности конструкций.
В части восстановления стройконструкций специалисты ведут заделку трещин, сколов, восстановление несущей способности.
 Бетонные элементы усиливают металлоконструкциями или полимерными материалами на основе углеволокна.
  Федеральный проект «Перестройка» рекомендует заказчикам уточнять, каким именно образом будут выполнены те или иные работы.
Почему защиту и восстановление строительных конструкций заказывают в «Перестройке»?

Мы объединяем тысячи заказчиков и исполнителей со всей страны, ежедневно ищущих гидроизоляцию,
огнебиозащиту дерева, ремонт фундаментов, стен и кровель. Практически каждый из подрядчиков обладает
определенным опытом в области работ и готов представить оптимальные решения в части ремонта строительных конструкций и
обосновать свое решение.

Пользователи проекта, со своей стороны, должны понимать,
что контроль над быстрым и качественным выполнением работ лежит непосредственно на них.
Спрашивайте прайс работ, требуйте заключения договора с указанием ответственных лиц, сроков и перечня требуемых действий.
Помните: результат на 50% зависит от правильно поставленной задачи. И «Перестройка» в этом поможет!
TEXT;
$textEn = <<<TEXT
<h2>Protection and restoration of building structures</h2>
...........................................................
..........................................................
TEXT;
$pieceText = [
    'text' => [
        'ru' => 'Одним из наиболее важных направлений в строительстве является защита и восстановление строительных конструкций.
В отличие от переноса или демонтажа внутренних перегородок, капитальные конструкции невозможно разобрать без
нарушения целостности всего здания. И здесь важно не ошибиться с выбором специалистов! ...',
        'en' => 'One of the most important areas in the construction industry is the protection and restoration of building structures.
In contrast to the transfer or removal of internal partitions, capital structure impossible to understand without
the violation of the integrity of the entire building. It\'s important not to be mistaken with the choice of the professionals!'
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