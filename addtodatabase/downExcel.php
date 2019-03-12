<?php
/**
 * PHPExcel
 *
 * Copyright (c) 2006 - 2015 PHPExcel
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
 *
 * @category   PHPExcel
 * @package    PHPExcel
 * @copyright  Copyright (c) 2006 - 2015 PHPExcel (http://www.codeplex.com/PHPExcel)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt	LGPL
 * @version    ##VERSION##, ##DATE##
 */

/** Error reporting */
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set('Europe/London');

define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');

/** Include PHPExcel */
require_once dirname(__FILE__) . '/../PHPExcel/Classes/PHPExcel.php';


include_once "../functions/database.php";
if (isset($_GET["id"])) {                  
	$activityId = $_GET["id"];
	echo "$activityId";
    get_Connection();
    $sql = "select *  from participants where registerFormId IN (select registerFormId from registerForm where acticitieId = $activityId)";
    $result = mysql_query($sql);
    $rows = mysql_num_rows($result);
    if ($rows>0) {
    	$sql = "select * from activities where activityId = $activityId";
   		$result = mysql_query($sql);
        $row =  mysql_fetch_array($result);
        $activityName = $row["activityName"];
        $activitytime = $row["activityStartTime"]."--".$row["activityEndTime"];
        $activityAddress = $row["activityAddress"];
        $time = time();
    	//$filedir = "/var/lib/mysql-files/$time$activityName"."活动名单.xls";
    	$filedir = "$time$activityName"."活动名单.xls";

		$objPHPExcel = new PHPExcel();
/*
		$objPHPExcel->getProperties()->setCreator("yangliangyong")
									 ->setLastModifiedBy("server")
									 ->setTitle("PHPExcel Document")
									 ->setSubject("PHPExcel Document")
									 ->setDescription("The cast who already signUp")
									 ->setKeywords("office PHPExcel")
									 ->setCategory("file");

		$objPHPExcel->setActiveSheetIndex(0)
		            ->setCellValue('A1', 'Hello')
		            ->setCellValue('B2', 'world!')
		            ->setCellValue('C1', 'Hello')
		            ->setCellValue('D2', 'world!');

		$objPHPExcel->getActiveSheet()->setCellValue('A8',"Hello\nWorld");
		$objPHPExcel->getActiveSheet()->getRowDimension(8)->setRowHeight(-1);
		$objPHPExcel->getActiveSheet()->getStyle('A8')->getAlignment()->setWrapText(true);

		$value = "-ValueA\n-Value B\n-Value C";
		$objPHPExcel->getActiveSheet()->setCellValue('A10', $value);
		$objPHPExcel->getActiveSheet()->getRowDimension(10)->setRowHeight(-1);
		$objPHPExcel->getActiveSheet()->getStyle('A10')->getAlignment()->setWrapText(true);
		$objPHPExcel->getActiveSheet()->getStyle('A10')->setQuotePrefix(true);

		$objPHPExcel->getActiveSheet()->setTitle('Simple');

		$objPHPExcel->setActiveSheetIndex(0);
*/	

		$objPHPExcel->getActiveSheet()->mergeCells("A1:I1");
		$objPHPExcel->getActiveSheet()->setCellValue('A1',"$activityName"."签到表");

		$objPHPExcel->getActiveSheet()->mergeCells("A2:I2");
		$objPHPExcel->getActiveSheet()->setCellValue('A2',"活动时间:"."$activitytime");
		$objPHPExcel->getActiveSheet()->getStyle('A2')->getFont()->setSize(16);
		$objPHPExcel->getActiveSheet()->getStyle('A2')->getFont()->setName('Time New Roman');

		

		$objPHPExcel->getActiveSheet()->mergeCells("A3:I3");
		$objPHPExcel->getActiveSheet()->setCellValue('A3',"活动地点:"."$activityAddress");
		$objPHPExcel->getActiveSheet()->getStyle('A3')->getFont()->setSize(16);
		$objPHPExcel->getActiveSheet()->getStyle('A3')->getFont()->setName('Time New Roman');


		$objPHPExcel->getActiveSheet()->setCellValue('A4','序号')
		->setCellValue('B4','姓名')
		->setCellValue('C4','单位')
		->setCellValue('D4','职务/职称')
		->setCellValue('E4','电话')
		->setCellValue('F4','签名')
        ->setCellValue('G4','成人/儿童')
        ->setCellValue('H4','学校')
        //->setCellValue('I1','表单id')
        ->setCellValue('I4','年龄');

        $sql = " select * from participants
                 where registerFormId IN (select registerFormId from registerForm where acticitieId = $activityId)";
                                                       
        $result = mysql_query($sql);

        $hang =5;
        while($row = mysql_fetch_array($result))
        {
        	$id = $row['participantId'];
        	$name = $row['participantName'];
			$department = $row['participantDepartment'];
			$position = $row['participantPositionalTitle'];
			$tel = $row['tel'];
			$mark=$row['mark'];
	        $adultOrChild=$row['adultOrChild'];
	        $school=$row['school'];
	        $registerformId=$row['registerformId'];
	        $age=$row['age'];

        	$objPHPExcel->getActiveSheet()->setCellValue("A$hang",($hang-4))
            ->setCellValue("B$hang",$name)
			->setCellValue("C$hang",$department)
			->setCellValue("D$hang",$position)
			->setCellValue("E$hang",$tel)
			//->setCellValue("F$hang",$mark)
	        ->setCellValue("G$hang",$adultOrChild)
	        ->setCellValue("H$hang",$school)
	        //->setCellValue("I$hang",$registerformId)
	        ->setCellValue("I$hang",$age);

	        $hang ++;

        	;

        }
        //设置列宽
		$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
		$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(16);
		$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
		//设置表头
		$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setSize(20);  
		$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true); 
		//$objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		$objPHPExcel->getActiveSheet()->getStyle('A1')->applyFromArray(
	            array(
	                'font' => array (
	                    'bold' => true
	                ),
	                'alignment' => array(
	                    'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
	                )
	            )
	        );  
       //$objPHPExcel -> getActiveSheet() -> getColumnDimension(PHPExcel_Cell::stringFromColumnIndex(0)) -> setAutoSize(true); 


		$callStartTime = microtime(true);

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		//$objWriter->save(str_replace('.php', '.xlsx', __FILE__));
		$objWriter->save("$activityName"."活动名单.xlsx");
		$callEndTime = microtime(true);
		$callTime = $callEndTime - $callStartTime;

		echo date('H:i:s') , " File written to " , str_replace('.php', '.xlsx', pathinfo(__FILE__, PATHINFO_BASENAME)) , EOL;
		echo 'Call time to write Workbook was ' , sprintf('%.4f',$callTime) , " seconds" , EOL;
		// Echo memory usage
		echo date('H:i:s') , ' Current memory usage: ' , (memory_get_usage(true) / 1024 / 1024) , " MB" , EOL;

		echo date('H:i:s') , " Write to Excel5 format" , EOL;
		$callStartTime = microtime(true);

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		//$objWriter->save(str_replace('.php', '.xls', __FILE__));
		$objWriter->save("$activityName"."活动名单.xls");
		$callEndTime = microtime(true);
		$callTime = $callEndTime - $callStartTime;

		echo date('H:i:s') , " File written to " , str_replace('.php', '.xls', pathinfo(__FILE__, PATHINFO_BASENAME)) , EOL;
		echo 'Call time to write Workbook was ' , sprintf('%.4f',$callTime) , " seconds" , EOL;
		// Echo memory usage
		echo date('H:i:s') , ' Current memory usage: ' , (memory_get_usage(true) / 1024 / 1024) , " MB" , EOL;
		// Echo memory peak usage
		echo date('H:i:s') , " Peak memory usage: " , (memory_get_peak_usage(true) / 1024 / 1024) , " MB" , EOL;
		// Echo done
		echo date('H:i:s') , " Done writing files" , EOL;
		echo 'Files have been created in ' , getcwd() , EOL;


        include_once "../functions/file_system.php";
		$url = getcwd()."/$activityName"."活动名单.xls";
		echo $url;
		$name = "$activityName"."活动名单.xls";
		//$name = "活动名单.xls";
		echo $name;
		download($url,$name);
    }else
    {
    	//当前活动无人报名
    }
}else
{
	echo "请从控制台打开此页面";
}

