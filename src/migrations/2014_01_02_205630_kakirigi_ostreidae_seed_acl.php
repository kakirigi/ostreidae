<?php

use Illuminate\Database\Migrations\Migration;

use Orchestra\Support\Facades\Acl;
use Orchestra\Support\Facades\App;
use Orchestra\Model\Role;

class OrchestraStorySeedAcl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $admin  = Role::admin();
        $member = Role::member();
        $acl    = Acl::make('kakirigi/ostreidae');

        $acl->roles()->attach(array($member->name, $admin->name));
        $acl->actions()->attach(array(
            'Create Post', 'Update Post', 'Delete Post', 'Manage Post',
            'Create Page', 'Update Page', 'Delete Page', 'Manage Page',
        ));

        $acl->allow($member->name, array(
            'Create Post', 'Update Post', 'Delete Post',
            'Create Page', 'Update Page', 'Delete Page',
        ));

        $acl->allow($admin->name, array(
            'Create Post', 'Update Post', 'Delete Post', 'Manage Post',
            'Create Page', 'Update Page', 'Delete Page', 'Manage Page',
        ));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        App::memory()->forget('acl_kakirigi/ostreidae');
    }
}
