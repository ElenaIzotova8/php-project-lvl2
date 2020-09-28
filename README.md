# php-project-lvl2

Проект Вычислитель отличий - второй учебный проект на [Хекслете](https://hexlet.io) в рамках обучения по профессии [PHP-программист](https://ru.hexlet.io/professions/php).
Вычислитель отличий – программа, определяющая разницу между двумя структурами данных. Возможности утилиты:

    -Поддержка разных входных форматов: yaml и json
    -Генерация отчета в виде plain text, stylish и json

Загрузка проекта - composer global require eleizotova/php-project-lvl2.

Пример работы пакета - сравнение 2 плоских файлов формата json:

gendiff before.json after.json

[![asciicast](https://asciinema.org/a/360299.svg)](https://asciinema.org/a/360299)

Пример работы пакета - сравнение 2 плоских файлов формата yaml:

gendiff before.yml after.yml

[![asciicast](https://asciinema.org/a/360301.svg)](https://asciinema.org/a/360301)

Пример работы пакета для файлов, имеющих вложенные структуры:

gendiff beforeIter.json afterIter.json

gendiff beforeIter.yml afterIter.yml

[![asciicast](https://asciinema.org/a/360302.svg)](https://asciinema.org/a/360302)

Возможность выбора вывода различий в формате plain:

gendiff --format plain beforeIter.json afterIter.json

gendiff --format plain beforeIter.yml afterIter.yml

[![asciicast](https://asciinema.org/a/360304.svg)](https://asciinema.org/a/360304)

Возможность выбора вывода различий в формате json:

gendiff --format json beforeIter.json afterIter.json

gendiff --format json beforeIter.yml afterIter.yml

[![asciicast](https://asciinema.org/a/362333.svg)](https://asciinema.org/a/362333)

<a href="https://codeclimate.com/github/ElenaIzotova8/php-project-lvl2/maintainability"><img src="https://api.codeclimate.com/v1/badges/41613d85cfce08259c64/maintainability" /></a>
<a href="https://codeclimate.com/github/ElenaIzotova8/php-project-lvl2/test_coverage"><img src="https://api.codeclimate.com/v1/badges/41613d85cfce08259c64/test_coverage" /></a>
![PHP CI](https://github.com/ElenaIzotova8/php-project-lvl2/workflows/PHP%20CI/badge.svg)
