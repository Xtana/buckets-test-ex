<?php
error_reporting(0);
?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>

	<link rel="stylesheet" href="styles.css">
	<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

	<script>
		$(document).ready(function() {
			$("form").on('submit', function(event) {
				event.preventDefault();
				$.post("form.php", $(this).serialize());
			});
		});
	</script>
</head>
<body>

<div class="container">
	<div>
		<form method="post" id="form">
         <div class="mb-3">
			   <label for="name">Имя</label>
			   <input type="text" class="form-control" id="name" name="name" required>
		   </div>

		  <div class="mb-3">
			   <label for="quantity">Литры</label>
			   <input type="text" class="form-control" id="quantity" name="quantity" required>
		  </div>

		  <button type="submit">Отправить</button>
		</form>
	</div>
	<div>
		<table class="table">
			<caption>Цистерны</caption>
			<thead>
				<tr>
					<th>1</th>
					<th>2</th>
					<th>3</th>
					<th>4</th>
					<th>5</th>
				</tr>
			</thead>
			<tbody>
            <?php 
            	$bucketArr = json_decode(file_get_contents('buckets.json'), true);
               echo '<tr>
                        <td>' . $bucketArr[1] . '</td>
                        <td>' . $bucketArr[2] . '</td>
                        <td>' . $bucketArr[3] . '</td>
                        <td>' . $bucketArr[4] . '</td>
                        <td>' . $bucketArr[5] . '</td>
                     </tr>';
               ?>
         </tbody>
      </table>
	</div>
	<div>
		<table class="table">
			<caption>Заполнители</caption>
			<thead>
				<tr>
					<th>Имя</th>
					<th>Литры</th>
					<th>Номер цистеры</th>
				</tr>
			</thead>
			<tbody>
            <?php 
            	$personArrr = json_decode(file_get_contents('people.json'), true);
            	foreach ($personArrr as $v) {
            		echo '<tr>
                        <td>' . $v[0] . '</td>
                        <td>' . $v[1] . '</td>
                        <td>' . $v[2] . '</td>
                     </tr>';
            	}
               ?>
         </tbody>
      </table>
	</div>
</div>
</body>
</html>

<?php 

require_once __DIR__ . '\form.php';

?>