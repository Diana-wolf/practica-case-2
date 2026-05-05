<?php

// Функция проверки введённой даты
function input($prompt) {
    while (true) {
        $value = readline($prompt);
        if (is_numeric($value) && (int)$value > 0) {
            return (int)$value; }
        echo "Ошибка: введите корректное число.\n";
    }
}

// Ввод данных
while (true) {
    $day = input("Введите день рождения: ");
    $month = input("Введите месяц рождения: ");
    $year = input("Введите год рождения: ");
    if (checkdate($month, $day, $year)) {
        break; } 
    else {echo "Ошибка: такой даты не существует. Попробуйте снова.\n\n";}
}

// Определение дня недели
function getDayOfWeek($day, $month, $year) {
    $date = DateTime::createFromFormat('d-m-Y', "$day-$month-$year");
    $days = [
        'Sunday' => 'Воскресенье',
        'Monday' => 'Понедельник',
        'Tuesday' => 'Вторник',
        'Wednesday' => 'Среда',
        'Thursday' => 'Четверг',
        'Friday' => 'Пятница',
        'Saturday' => 'Суббота'
    ];
    return $days[$date->format('l')];
}

// Високосный ли год
function isLeapYear($year) {
    return ($year % 4 == 0 && $year % 100 != 0) || ($year % 400 == 0);
}

// Возраст
function getAge($day, $month, $year) {
    $birthDate = new DateTime("$year-$month-$day");
    $today = new DateTime();
    return $today->diff($birthDate)->y;
}

// Вывод цифр символами
function printBigDigits($number) {
    $digits = [
        '0' => [" *** ", "*   *", "*   *", "*   *", " *** "],
        '1' => ["  *  ", " **  ", "  *  ", "  *  ", " *** "],
        '2' => [" *** ", "*   *", "   * ", "  *  ", "*****"],
        '3' => ["*****", "    *", " *** ", "    *", "*****"],
        '4' => ["*   *", "*   *", "*****", "    *", "    *"],
        '5' => ["*****", "*    ", "**** ", "    *", "**** "],
        '6' => [" *** ", "*    ", "**** ", "*   *", " *** "],
        '7' => ["*****", "    *", "   * ", "  *  ", "  *  "],
        '8' => [" *** ", "*   *", " *** ", "*   *", " *** "],
        '9' => [" *** ", "*   *", " ****", "    *", " *** "]
    ];

    $rows = ["", "", "", "", ""];

    foreach (str_split($number) as $digit) {
        for ($i = 0; $i < 5; $i++) {
            $rows[$i] .= $digits[$digit][$i] . "  ";
        }
    }

    foreach ($rows as $row) {
        echo $row . PHP_EOL;
    }
}

// Вывод
echo "\nДень недели: " . getDayOfWeek($day, $month, $year) . PHP_EOL;
echo "Високосный год: " . (isLeapYear($year) ? "Да" : "Нет") . PHP_EOL;
echo "Возраст: " . getAge($day, $month, $year) . PHP_EOL;

echo "\nДата рождения:\n";
$formatted = sprintf("%02d%02d%04d", $day, $month, $year);
printBigDigits($formatted);

?>