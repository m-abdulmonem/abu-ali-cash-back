<?php

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermissionTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tableNames = config('permission.table_names');
        $columnNames = config('permission.column_names');

        if (empty($tableNames)) {
            throw new \Exception('Error: config/permission.php not found and defaults could not be merged. Please publish the package configuration before proceeding.');
        }

        Schema::create($tableNames['permissions'], function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('name_ar');
            $table->string('guard_name');
            $table->timestamps();
        });

        Schema::create($tableNames['roles'], function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('name_ar');
            $table->string('guard_name');
            $table->timestamps();
        });

        Schema::create($tableNames['model_has_permissions'], function (Blueprint $table) use ($tableNames, $columnNames) {
            $table->unsignedBigInteger('permission_id');

            $table->string('model_type');
            $table->unsignedBigInteger($columnNames['model_morph_key']);
            $table->index([$columnNames['model_morph_key'], 'model_type'], 'model_has_permissions_model_id_model_type_index');

            $table->foreign('permission_id')
                ->references('id')
                ->on($tableNames['permissions'])
                ->onDelete('cascade');

            $table->primary(['permission_id', $columnNames['model_morph_key'], 'model_type'],
                    'model_has_permissions_permission_model_type_primary');
        });

        Schema::create($tableNames['model_has_roles'], function (Blueprint $table) use ($tableNames, $columnNames) {
            $table->unsignedBigInteger('role_id');

            $table->string('model_type');
            $table->unsignedBigInteger($columnNames['model_morph_key']);
            $table->index([$columnNames['model_morph_key'], 'model_type'], 'model_has_roles_model_id_model_type_index');

            $table->foreign('role_id')
                ->references('id')
                ->on($tableNames['roles'])
                ->onDelete('cascade');

            $table->primary(['role_id', $columnNames['model_morph_key'], 'model_type'],
                    'model_has_roles_role_model_type_primary');
        });

        Schema::create($tableNames['role_has_permissions'], function (Blueprint $table) use ($tableNames) {
            $table->unsignedBigInteger('permission_id');
            $table->unsignedBigInteger('role_id');

            $table->foreign('permission_id')
                ->references('id')
                ->on($tableNames['permissions'])
                ->onDelete('cascade');

            $table->foreign('role_id')
                ->references('id')
                ->on($tableNames['roles'])
                ->onDelete('cascade');

            $table->primary(['permission_id', 'role_id'], 'role_has_permissions_permission_id_role_id_primary');
        });

        app('cache')
            ->store(config('permission.cache.store') != 'default' ? config('permission.cache.store') : null)
            ->forget(config('permission.cache.key'));

        DB::table('roles')->insert([
            ['name' => 'super-admin','name_ar' => 'المدير العام','guard_name' => 'web'],
            ['name' => 'admin','name_ar' => 'المدير','guard_name' => 'web'],
            ['name' => 'writer','name_ar' => 'الكاتب','guard_name' => 'web']
        ]);
        DB::table("permissions")->insert([
            ['name' => 'edit social links','name_ar' => 'تعديل روابط مواقع التواصل الاجتماعى','guard_name' => 'web'],
            ['name' => 'edit site maintenance','name_ar' => 'تعديل بيانات صيانة الموقع','guard_name' => 'web'],
            ['name' => 'edit mobile app links','name_ar' => 'تعديل روابط تطبيق الهاتف الذكى','guard_name' => 'web'],
            ['name' => 'edit site settings','name_ar' => 'تعديل بيانات الموقع','guard_name' => 'web'],
            ['name' => 'view site settings','name_ar' => 'عرض بيانات الموقع','guard_name' => 'web'],

            ['name' => 'create user','name_ar' => 'إنشاء مسؤل','guard_name' => 'web'],
            ['name' => 'edit user','name_ar' => 'تعديل مسؤل','guard_name' => 'web'],
            ['name' => 'view users','name_ar' => 'عرض المسؤلين','guard_name' => 'web'],
            ['name' => 'delete user','name_ar' => 'حذف مسؤل','guard_name' => 'web'],

            ['name' => 'edit client','name_ar' => 'تعديل عميل','guard_name' => 'web'],
            ['name' => 'view client','name_ar' => 'عرض عميل','guard_name' => 'web'],
            ['name' => 'view clients','name_ar' => 'عرض عملاء','guard_name' => 'web'],
            ['name' => 'delete client','name_ar' => 'حذف عميل','guard_name' => 'web'],

            ['name' => 'view offers','name_ar' => 'عرض العروض','guard_name' => 'web'],
            ['name' => 'view offer','name_ar' => 'عرض عرض','guard_name' => 'web'],
            ['name' => 'create offer','name_ar' => 'إنشاء عرض','guard_name' => 'web'],
            ['name' => 'edit offer','name_ar' => 'تعديل عرض','guard_name' => 'web'],
            ['name' => 'delete offer','name_ar' => 'حذف عرض','guard_name' => 'web'],

            ['name' => 'create cash_back','name_ar' => 'إنشاء تفاصيل العرض','guard_name' => 'web'],
            ['name' => 'edit cash_back','name_ar' => 'تعديل تفاصيل العرض','guard_name' => 'web'],
            ['name' => 'delete cash_back','name_ar' => 'حذف تفاصيل العرض','guard_name' => 'web'],

            ['name' => 'view categories','name_ar' => 'عرض تصنيفات','guard_name' => 'web'],
            ['name' => 'view category','name_ar' => 'عرض تصنيف','guard_name' => 'web'],
            ['name' => 'create category','name_ar' => 'إنشاء تصنيف','guard_name' => 'web'],
            ['name' => 'edit category','name_ar' => 'تعديل تصنيف','guard_name' => 'web'],
            ['name' => 'delete category','name_ar' => 'حذف تصنيف','guard_name' => 'web'],

//            ['name' => '','name_ar' => '','guard_name' => 'web'],
        ]);

        \Spatie\Permission\Models\Role::findByName("super-admin")->givePermissionTo([
            'edit social links',
            'edit site maintenance',
            'edit mobile app links',
            'edit site settings',
            'view site settings',
            'create user',
            'edit user',
            'view users',
            'delete user',
            'edit client',
            'view client',
            'view clients',
            'delete client',

            'view offers',
            'view offer',
            'create offer',
            'edit offer',
            'delete offer',

            'create cash_back',
            'edit cash_back',
            'delete cash_back',

            'view categories',
            'view category',
            'create category',
            'edit category',
            'delete category',
        ]);

        \Spatie\Permission\Models\Role::findByName("admin")->givePermissionTo([
            'edit social links',
            'edit site maintenance',
            'edit mobile app links',

            'view offers',
            'view offer',
            'create offer',
            'edit offer',
            'delete offer',

            'create cash_back',
            'edit cash_back',
            'delete cash_back',

            'view categories',
            'view category',
            'create category',
            'edit category',
            'delete category',

        ]);
        \Spatie\Permission\Models\Role::findByName("writer")->givePermissionTo([
            'view offers',
            'view offer',
            'create offer',
            'edit offer',
            'delete offer',

            'create cash_back',
            'edit cash_back',
            'delete cash_back',

            'view categories',
            'view category',
            'create category',
            'edit category',
            'delete category',
        ]);

        $user = User::find(1);
        $user->assignRole(['super-admin']);
        $user->givePermissionTo([
            'edit social links',
            'edit site maintenance',
            'edit mobile app links',
            'edit site settings',
            'view site settings',

            'edit user',
            'view users',
            'delete user',

            'edit client',
            'view client',
            'delete client',

            'view offers',
            'view offer',
            'create offer',
            'edit offer',
            'delete offer',

            'create cash_back',
            'edit cash_back',
            'delete cash_back',

            'view categories',
            'view category',
            'create category',
            'edit category',
            'delete category',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     * @throws Exception
     */
    public function down()
    {
        $tableNames = config('permission.table_names');

        if (empty($tableNames)) {
            throw new \Exception('Error: config/permission.php not found and defaults could not be merged. Please publish the package configuration before proceeding, or drop the tables manually.');
        }

        Schema::drop($tableNames['role_has_permissions']);
        Schema::drop($tableNames['model_has_roles']);
        Schema::drop($tableNames['model_has_permissions']);
        Schema::drop($tableNames['roles']);
        Schema::drop($tableNames['permissions']);
    }
}
