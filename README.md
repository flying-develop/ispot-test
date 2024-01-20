База данных состоит из одной таблицы products
- **id** - id строки, INT NOT NULL AUTO_INCREMENT
- **articul** - артикул товара, VARCHAR(255) NOT NULL UNIQUE
- **name** - название товара, VARCHAR(255) NOT NULL

Класс **Product** - предоставляет статические методы для работы с товарами<br/>
Класс **Database** - реализует PDO-коннектор для таблицы products