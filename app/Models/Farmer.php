<?php

namespace App\Models;

use CodeIgniter\Model;

class Farmer extends Model
{
  
	protected $DBGroup              = 'default';
	protected $table                = 'farmers';
	protected $primaryKey           = 'id';
	protected $useAutoIncrement     = true;
	protected $protectFields        = true;
	protected $allowedFields        = ['name', 'email', 'password'];


    // Dates
    protected $useTimestamps        = false;
	protected $dateFormat           = 'datetime';
	protected $createdField         = 'created_at';
	protected $updatedField         = 'updated_at';


    
}
