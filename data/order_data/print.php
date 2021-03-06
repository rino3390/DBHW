<?php
	//引入套件
	require ("Classes/PHPExcel.php");
	//創建excel物件
	$excel = new PHPExcel();
	//創建寫檔物件->excel物件
	$writer = PHPExcel_IOFactory::createWriter($excel, "Excel2007");
	//創建表單
	$excel->createSheet("訂單資料");
	// 獲取表單
	$sheet = $excel->getSheet(0);
	//引入SQL連線
	include ("./data/linkSQL.php");
	//設定是否成功flag
	$tf=false;
	//確認資料量
	$sqlQuery2="SELECT COUNT(*)".$_SESSION['sqlQuery'];
	if ($result=$connection->query($sqlQuery2)) {
		$row = $result->fetch_row();
		//輸出標題列
		$sheet->setCellValueByColumnAndRow(0, 1, "身分證字號");
		$sheet->setCellValueByColumnAndRow(1, 1, "訂貨日期");
		$sheet->setCellValueByColumnAndRow(2, 1, "預計遞交日期");
		$sheet->setCellValueByColumnAndRow(3, 1, "實際遞交日期");
		$sheet->setCellValueByColumnAndRow(4, 1, "訂貨品名");
		$sheet->setCellValueByColumnAndRow(5, 1, "單位");
		$sheet->setCellValueByColumnAndRow(6, 1, "數量");
		$sheet->setCellValueByColumnAndRow(7, 1, "單價");
		$sheet->setCellValueByColumnAndRow(8, 1, "訂貨金額");
		$sheet->setCellValueByColumnAndRow(9, 1, "供應商名稱");
		$sheet->setCellValueByColumnAndRow(10, 1, "供應商編號");
		if($row[0]==0) {	//無資料
			$sheet->setCellValue("A2", "無資料");
			$sheet->mergeCells('A2:K2');
			$tf=true;
		}else{				//取得資料
			$sqlQuery="SELECT *".$_SESSION['sqlQuery'];
			if ($result=$connection->query($sqlQuery)) {
				// 取得結果
				$con=1;
				while ($row = $result->fetch_row()) {
					$con++;
					$sheet->setCellValueByColumnAndRow(0, $con, $row[0]);
					$sheet->setCellValueByColumnAndRow(1, $con, date("Y/m/d", strtotime($row[1])));
					$sheet->setCellValueByColumnAndRow(2, $con, date("Y/m/d", strtotime($row[2])));
					if ($row[3] == "0000-00-00" || $row[3] ==  NULL)
						$sheet->setCellValueByColumnAndRow(3, $con, "尚未交貨。");
					else
						$sheet->setCellValueByColumnAndRow(3, $con, date("Y/m/d", strtotime($row[3])));
					for($c=4;$c<11;$c++){
						$sheet->setCellValueByColumnAndRow($c, $con, $row[$c]);
					}
				}
				// 釋放資源
				$result->close();
				$tf=true;
			}else {
				echo "執行失敗：" . $connection->error;
			}
		}
	}else {
		echo "執行失敗：" . $connection->error;
	}
	// 關閉 MySQL/MariaDB 連線
	$connection->close();
	//寬度自適應(效果不佳，請手動重新調整)
	for($a=0;$a<9;$a++){
		$sheet->getColumnDimension(chr($a+65))->setAutoSize(true);
		$sheet->getColumnDimension(chr($a+65))->setAutoSize(true);
	}
	if($tf){
		//存檔
		date_default_timezone_set('Asia/Taipei');
		$fileName= "print/訂單資料表".date("Y.m.d_hi",time()).".xlsx";
		$writer->save($fileName);
		echo "<script>alert('已匯出成excel！\\n(列印前推薦挑整:常用-格式-自動調整欄寬、列印-橫向方向、列印-將所有欄放入一頁面、列印-版面設置-工作表-標題列=\'$1:$1\')。;</script>";
	}
