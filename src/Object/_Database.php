<?php
namespace Cryslo\Core\Object;

/**
 * Created by PhpStorm.
 * User: Ross Edlin
 * Date: 26/12/2015
 * Time: 14:39
 */
interface _Database
{
	/**
	 * Add the object to the database
	 *
	 * @return boolean if the call was successful or not
	 */
	public function create();

	/**
	 * Retrieve the object from the database
	 *
	 * @param int $id the id of the object in the database
	 *
	 * @return boolean if the call was successful or not
	 */
	public function retrieve($id);

	/**
	 * Update the object in the database
	 *
	 * @return boolean if the call was successful or not
	 */
	public function update();

	/**
	 * Delete the object from the database
	 *
	 * @return boolean if the call was successful or not
	 */
	public function delete();
}