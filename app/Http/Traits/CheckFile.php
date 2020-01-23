<?php 

namespace App\Http\Traits;

use Illuminate\Http\Request;

trait CheckFile
{
	/**
	* @var null or string
	*/ 
	protected static $filename = null;

	/**
     * Return filename or null if file exists
     *
     * @param $request Illuminate\Http\Request
     * @param $fieldName string Field name which are using to get file
     *
     * @return file name or null
    */ 
	public static function checkForFileContains(Request $request, string $fieldName)
	{
		if ($request->hasFile($fieldName)) {

			if (!self::fileStoring($request)) {
				abort(403);
			}

			return self::fileStoring($request);
		}
	}

	/**
	 * Push file into storage folder
	 * 
	 * @param \Illuminate\Http\Request $request
	 * 
	 * @return bool 
	 */ 
	protected static function fileStoring(Request $request)
	{
		if ($request->file('image')->isValid()) {
			return $request->image->store('img');
		}
	}
}