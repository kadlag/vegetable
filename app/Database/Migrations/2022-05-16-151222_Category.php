<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class category extends Migration
{
    public function up() {
       $this->forge->addField([
         'id' => [
            'type' => 'INT',
            'constraint' => 5,
            'unsigned' => true,
            'auto_increment' => true,
         ],
         'title' => [
            'type' => 'VARCHAR',
            'constraint' => '100',
         ],
         'image_name' => [
            'type' => 'VARCHAR',
            'constraint' => '100',
         ],
         'featured' => [
            'type' => 'VARCHAR',
            'constraint' => '100',
         ],
         'active' => [
            'type' => 'VARCHAR',
            'constraint' => '100',
         ],
       ]);
       $this->forge->addKey('id', true);
       $this->forge->createTable('category');
    }

    //--------------------------------------------------------------------

    public function down() {
       $this->forge->dropTable('subjects');
    }
}

