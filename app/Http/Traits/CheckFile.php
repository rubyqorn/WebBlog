<?php 

namespace App\Http\Traits;

trait CheckFile
{
	/**
	* @var null or string
	*/ 
	protected static $filename = null;

	/**
     * Return filename or null if file exists
     *
     * @param $request 	object Illuminate\Http\Request
     * @param $fieldName string Field name which are using to get file
     *
     * @return file name or null
    */ 
	public static function checkForFileContains(object $request, string $fieldName)
	{
		if ($request->hasFile($fieldName)) {
			$file = $request->file($fieldName)->getClientOriginalName();

			return self::$filename = $file;
		}
	}
}