<p>В качестве СУБД использовал PostgreSQL. Для того, чтобы использовать страницу админа, необходимо создать запись в таблице Users (код для этого есть в файле init.sql).</p>
<p>Для подключения к БД, необходимо в файле /src/classes/DataBaseConfig.php поменять в строчке: <code>$this->db = new PDO('pgsql:host=localhost;port=5432;dbname=postgres;user=postgres;password=111');</code>
dbname - на ваше название БД, user - на ваше логин от БД, password - соответственно, на ваш пароль.</p>
