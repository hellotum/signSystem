<?php
// define('DIR', "uploads");
function upload($file, $path, $identifier)
//保存上传文件$file 于path/下 文件名为时间戳加identifier
{
    $result = ['message' => '']; //返回的数组
    $error  = $file['error'];
    switch ($error) {
        case 0:
            // $type = $file['type'];
            // if ($type == "image/bmp" || $type == "image/jpeg" || $type == "image/png") {
            # code...
            $file_name   = $file['name'];
            $extend_name = extension_name($file_name);
            $upload_name = time() . '_' . $identifier . '.' . $extend_name; //保存时的名字
            $destination = iconv("UTF-8", "GB2312", $path . "/" . $upload_name);
            $file_temp   = $file['tmp_name'];
            if (move_uploaded_file($file_temp, $destination)) {
                $result['message']     = 'file_upload_success';
                $result['destination'] = $destination;
                $result['extend_name'] = $extend_name;
                return $result;
            } else {
                $result['message'] = '文件上传失败';
                return $result;
            }
            break;
        case 1:
            $result['message'] = '上传附件超过了php.ini中upload_max_filesize选项限制的值!';
            return $result;
        case 2:
            $result['message'] = "上传附件的大小超过了form表单MAX_FILE_SIZE选项指定的值";
            return $result;
        case 3:

            $result['message'] = "附件只有部分被上传!";
            return $result;
        case 4:
            $result['message'] = "没有选择上传的附件!";
            return $result;
        default:
            $result['message'] = "未知错误!";
            return $result;
    }
}
function download($file_dir, $file_name)
{
    //$file_dir = iconv("UTF-8", "gb2312", $file_dir);
    //echo $file_dir;
    if (!file_exists($file_dir)) {
        exit('文件不存在或者已经被删除!');
    } else {
        ob_clean();//清除缓存区
        $file           = fopen($file_dir, "r");
        $file_size      = filesize($file_dir);
        $extension_name = extension_name($file_name);
        $content_type   = content_type($extension_name);
        header("Content-Type:$content_type");
        header("Accept-Length:" . $file_size);
        header("Content-Disposition:attachment;filename=" . $file_name);
        Header("Accept-Ranges:bytes");
        $buffer     = 1024;
        $file_count = 0;
        while (!feof($file) && $file_count < $file_size) {
            $file_con = fread($file, $buffer);
            //$file_con = iconv("UTF-8", "gb2312", $file_con);
            $file_count += $buffer;
            echo $file_con;
        }
        fclose($file);
        exit;
    }
}
function delete_file($file_dir)
{
    $path = iconv("UTF-8", "gb2312", $file_dir);
    if (file_exists($path)) {
        unlink($path);
    }

}
function extension_name($file_name)
{
    $extension = explode(".", $file_name);
    $key       = count($extension) - 1;
    return $extension[$key];
}
function content_type($extension)
{
    //IE
    $mime_type = array(
        //image
        'gif'   => 'image/gif',
        'jpg'   => 'image/jpeg',
        'png'   => 'image/png',
        'bmp'   => 'image/bmp',
        'psd'   => 'application/octet-stream',
        'ico'   => 'image/x-icon',
        'rar'   => 'application/octet-stream',
        'zip'   => 'application/zip',
        '7z'    => 'application/octet-stream',
        'exe'   => 'application/octet-stream',
        'avi'   => 'video/avi',
        'rmvb'  => 'application/vnd.rn-realmedia-vbr',
        '3gp'   => 'application/octet-stream',
        'flv'   => 'application/octet-stream',
        'mp3'   => 'audio/mpeg',
        'wav'   => 'audio/wav',
        'krc'   => 'application/octet-stream',
        'lrc'   => 'application/octet-stream',
        'txt'   => 'text/plain',
        'doc'   => 'application/msword',
        'xls'   => 'application/vnd.ms-excel',
        'ppt'   => 'application/vnd.ms-powerpoint',
        'pdf'   => 'application/pdf',
        'chm'   => 'application/octet-stream',
        'mdb'   => 'application/msaccess',
        'sql'   => 'application/octet-stream',
        'con'   => 'application/octet-stream',
        'log'   => 'text/plain',
        'dat'   => 'application/octet-stream',
        'ini'   => 'application/octet-stream',
        'php'   => 'application/octet-stream',
        'html'  => 'text/html',
        'ttf'   => 'application/octet-stream',
        'fon'   => 'application/octet-stream',
        'js'    => 'application/x-javascript',
        'xml'   => 'text/xml',
        'dll'   => 'application/octet-stream',
        'class' => 'application/java',
    );
    if (array_key_exists($extension, $mime_type)) {
        # code...
        return $mime_type[$extension];
    } else {
        return "";
    }
}
function get_bsFile_Type($extension){
    $type = array(
        'pdf'   => 'pdf', 
        'gif'   => 'image',
        'jpg'   => 'image',
        'png'   => 'image',
        'bmp'   => 'image', 
        'txt'   => 'text',
        'avi'   => 'video',
        'mp3'   => 'video',
        'mp4'   => 'video',
    );
    if (array_key_exists($extension, $type)) {
        # code...
        return $type[$extension];
    } else {
        return "html";
    }
}
function get_bsFile_icon($extension){
    $arr = array(
        'doc'=> '<i class="fa fa-file-word-o text-primary"></i>',
        'xls'=> '<i class="fa fa-file-excel-o text-success"></i>',
        'ppt'=> '<i class="fa fa-file-powerpoint-o text-danger"></i>',
        'pdf'=> '<i class="fa fa-file-pdf-o text-danger"></i>',
        'zip'=> '<i class="fa fa-file-archive-o text-muted"></i>',
        'htm'=> '<i class="fa fa-file-code-o text-info"></i>',
        'txt'=> '<i class="fa fa-file-text-o text-info"></i>',
        'mov'=> '<i class="fa fa-file-movie-o text-warning"></i>',
        'mp3'=> '<i class="fa fa-file-audio-o text-warning"></i>',
        'jpg'=> '<i class="fa fa-file-photo-o text-danger"></i>', 
        'gif'=> '<i class="fa fa-file-photo-o text-muted"></i>', 
        'png'=> '<i class="fa fa-file-photo-o text-primary"></i>'    
    );
    if (array_key_exists($extension, $arr)) {
        # code...
        return $arr[$extension];
    } else {
        return "<i class='fa fa-file-text-o text-info'></i>";   
    }
}