<!DOCTYPE html>
<html>
<head>
	<title>Первая задача</title>
</head>
<body>
<!-- карта для скрипта -->
<!-- Имя база данных: pomidor -->
<!-- Имя таблица: pomidor -->
<!-- Содержимое таблица: id(PRIMARY, AUTO_INCREMENT), name, price -->


	<?php
	// Подключени должно быть в конфигурационный файл это для того чтобы mysqli_query сработала
	$connection = mysqli_connect('localhost', 'root', '', 'pomidor');
	if(!$connection){
		exit('Ошибка подключение к базе данных');
	}
	?>



	<center>
		<?php //////////////////////////////////// Добавить в список ///////////////////////////
		$tester = strip_tags($_POST['tester']);
		$price = strip_tags($_POST['price']);

		if ($_POST['insert']) {
			$errors = array();
		if(trim($tester) == ''){
			$errors[] = 'Введите значении для добавление';

		}

			if(trim($price) == ''){
			$errors[] = 'Введите Цену';
			echo $errors[0];

		}

		if(empty($errors)){
			$insert_to_db = "INSERT INTO `pomidor` (`id`, `name`, `price`) VALUES (NULL, '$tester', $price)";
			$add_pomidor = mysqli_query($connection, $insert_to_db);
			echo "Блогополучно добавлено в базе данных!";
		}
}
		?>
		<form method="POST" action="<? echo $_SERVER['REQUEST_URL'];  ?>">
			<h1>Добавить в список</h1>
			<label>Добавить в список</label>
			<input type="text" name="tester" placeholder="Введите имя продукта">
			<label>Цена</label>
			<input type="number" name="price" placeholder="Введите Цена">
			<input type="submit" name="insert" value="Добавить">
		</form>
	</center><hr/>







<center>
		<?php  //////////////////////////////////// Изменить запись в список ///////////////////////////
		$edit = strip_tags($_POST['edit']);

		if ($_POST['add']) {
			$errors = array();
		if(trim($edit) == ''){
			$errors[] = 'Введите значении для изменени';
			echo $errors[0];
		}

		if(empty($errors)){
			$insert_to_db = "UPDATE `pomidor` SET `name` = '$edit' ";
			$add_pomidor = mysqli_query($connection, $insert_to_db);
			echo "Изменени прошло успешно!";
		}
	}
		?>
		<form method="POST" action="<? echo $_SERVER['REQUEST_URL'];  ?>">
			<h1>Изменить запись в список</h1>
			<label>Изменить запись в список</label>
			<input type="text" name="edit" placeholder="Введите значени">
			<input type="submit" name="add" value="Изменить">
		</form>
	</center><hr/>









<center>
		<?php  //////////////////////////////////// Удалить запись из список ///////////////////////////

		if ($_POST['delete']) {
			$delete_db = "TRUNCATE TABLE `pomidor`";
			$query = mysqli_query($connection, $delete_db);
			echo "Удаление прошло успешно!";
		}


		?>
		<form method="POST" action="<? echo $_SERVER['REQUEST_URL'];  ?>">
			<h1>Удалить запись из список</h1>
			<input type="submit" name="delete" value="Удалить все">
		</form>
	</center><hr/>





	<?php  //////////////////////////// Вывод из database ///////////////////////////////////////
$query2 = mysqli_query($connection, "SELECT `name` , `price` FROM `pomidor`");

while($fetch = mysqli_fetch_assoc($query2)){
	echo '<li>' . $fetch['name'] . ' ' . 'цена' . ' ' . $fetch['price'] .  '</li>';
}

	?>
</body>
</html>
