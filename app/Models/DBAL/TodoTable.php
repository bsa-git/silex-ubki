<?php

// app/Models/DBAL/TodoTable.php

namespace Models\DBAL;

use Doctrine\DBAL\Schema\Table;

/**
 * Class TodoTable
 *
 * @category Model
 * @package  app\Models\DBAL
 * @author   Sergei Beskorovainyi <bsa2657@yandex.ru>
 * @license  MIT <http://www.opensource.org/licenses/mit-license.php>
 * @link     https://github.com/bsa-git/silex-mvc/
 */
class TodoTable extends Table {

    /**
     * Overrides parent constructor
     * @param string $tableName The table name
     * @throws \Doctrine\DBAL\DBALException
     */
    public function __construct($tableName = 'todo') {
        parent::__construct($tableName);

        $this->_build();
    }

    /**
     * Build table
     * @return void
     */
    private function _build() {// created
        $this->addColumn(
                'id', 'integer', array('unsigned' => true, 'autoincrement' => 'auto',)
        );
        $this->addColumn(
                'title', 'string', array('length' => 255, 'notnull' => true)
        );
        $this->addColumn(
                'task_order', 'integer', array('notnull' => true)
        );
        $this->addColumn(
                'done', 'boolean', array('notnull' => true)
        );
        $this->setPrimaryKey(array('id'));
    }

}
