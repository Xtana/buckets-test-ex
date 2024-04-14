<?php

function debug($data) {
	echo '<pre>' . var_dump($data) . '</pre>';
}

function formProcessing($data) {
	if (is_numeric($data['quantity'])) {
		addBucketsToJson($data);
		echo 'Информация добавлена';
	} else {
		echo 'Не число';
	}
}

function addBucketsToJson($data) {
	$file = 'buckets.json';

	if(hasFile($file)) {
		$bucketArr = [1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0];
		jsonInit($file, $bucketArr);
	}	
	
	$bucketArr = json_decode(file_get_contents($file), true);
	$minIndex = findIndexOfMinValInArr($bucketArr);
	$sum = (int) $bucketArr[$minIndex];

	if ($sum + $data['quantity'] <= 300) {
		$sum += (int) $data['quantity']; 
		$bucketArr[$minIndex] = $sum;
		file_put_contents($file, json_encode($bucketArr, JSON_UNESCAPED_UNICODE));
		addPeapleToJson($data, $minIndex);
	} else {
		echo 'Ошибка добавления';
	}
}

function hasFile($file) {
	return !file_exists($file) || filesize($file) == 0;
}

function jsonInit($file, $arr = []) {
	var_dump($arr);
	file_put_contents($file, json_encode($arr, JSON_UNESCAPED_UNICODE));
}

function findIndexOfMinValInArr($arr) {
	$minInd = 1;
	foreach ($arr as $k => $v) {
		if ($v < $arr[$minInd]) {
			$minInd = $k;
		}
 	}
 	return $minInd;
}

function addPeapleToJson($data, $minIndex) {
	$file = 'people.json';

	if(hasFile($file)) {
		jsonInit($file);
	}	
	
	$personArr = json_decode(file_get_contents($file), true);
	$personArr[] = [$data['name'], $data['quantity'], $minIndex];
	file_put_contents($file, json_encode($personArr, JSON_UNESCAPED_UNICODE));
}