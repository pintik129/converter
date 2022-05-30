<?php
$parametres = array ('action','number1','number2','units');
require_once 'parametres.php'; //страница парамеров
$convert = array (//массив с величинами
    'Электричество в рубли'=>'($number1-$number2)*3.19', //Разница величин, умноженная на тариф
    'Воду в рубли'=>'($number1-$number2)*31.49'
);
$result = ''; //формула
if (isset($action)) {
    if (!is_numeric($number2)) $number2 = 0;
    if (!is_numeric($number1)) $number1 = 0;//условия ввода
    foreach ($convert as $key=>$value) if ($key == $units) {
        eval("\$result=$value;"); break;
    }
}
?>
<!DOCTYPE html PUBLIC "–//W3C//DTD HTML 4.01//EN">
<html><head>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
    <meta http–equiv="Content–Type" content="text/html; charset=Windows–1251" /><title>Конвертер счетчика</title>
</head><body><h3>Конвертер счетчика электричества и воды</h3><form method="post">
    <p>Предыдущий месяц: <input type="text" name="number1" value="<?php echo $number2; ?>" maxlength="10" size="11">
    <p>Этот месяц: <input type="text" name="number2" value="<?php echo $number1; ?>" maxlength="10" size="11">
    <p>Что считаем?: <select name="units" size="1">
            <?php
            foreach ($convert as $key=>$value)
                echo '<option value="'.$key.'"'.($key==$units?' selected':'').'>'.$key;
            ?>
        </select>
        <input type="submit" name="action" value="Посчитать"></p></form><!--Кнопка ввода --!>
<?php
if (isset($action)) {
    echo '<p>Ответ=' . round($result, 2) . '</p>'; //Вывод результата
}
?>
<script>
    $.ajax({
        url: '/test.php',         /* Куда пойдет запрос */
        method: 'get',             /* Метод передачи (get) */
        dataType: 'html',          /* Тип данных в ответе /
        data: {text: '$result'},     /* Параметры передаваемые в запросе. */
        success: function(data){   /* функция которая будет выполнена после успешного запроса.  */
            alert(data);            /* В переменной data содержится ответ от index.php. */
        }
    });
</script>


</body></html>
