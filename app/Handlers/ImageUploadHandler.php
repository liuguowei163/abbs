<?php
namespace App\Handlers;

/**
 * 
 */
class ImageUploadHandler
{
	
	protected $allowed_ext = ["png", 'jpg', 'gif', 'jpeg'];

	public function save($file, $folder, $file_prefix){

		$folder_name = "uploads/images/$folder/" . date("Ym/d", time());
		//存储文件的路径
		$upload_path = public_path() . '/' . $folder_name;
		//获取文件的后缀名，因图片从剪贴板里黏贴时后缀名为空，所以此处确保后缀一直存在
		$extension = strtolower($file->getClientOriginalExtension()) ?: 'png';
		//存储文件的名称
		$filename = $file_prefix . '_' . time() . '_' . str_random(10) . '.' . $extension;

		if ( ! in_array($extension, $this->allowed_ext)) {
            return false;
        }

		$file->move($upload_path, $filename);

		return [
			'path' => config('app.url') . "/$folder_name/$filename"
		];

	}

}






?>