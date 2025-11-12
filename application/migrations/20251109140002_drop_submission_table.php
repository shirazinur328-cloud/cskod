<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Drop_submission_table extends CI_Migration {

    public function up() {
        $this->dbforge->drop_table('submission', TRUE); // TRUE to suppress error if table doesn't exist
    }

    public function down() {
        // Recreate submission table if needed for rollback, but for now, leave empty
        // This is a destructive migration, so 'down' might not fully restore previous state
    }
}
?>
