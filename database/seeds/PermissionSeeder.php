<?php

use Illuminate\Database\Seeder;


use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();

        Permission::create(['name' => 'access_to_admin_panel', 'description' => 'Acceso a Panel de Administración', 'module' => 'admin_panel', 'guard_name' => 'web']);
        Permission::create(['name' => 'analytics', 'description' => 'Acceso a Estadísticas del Sitio', 'module' => 'admin_panel', 'guard_name' => 'web']);


        //Blog Category Permissions
        Permission::create(['name' => 'view_categories', 'description' => 'Ver catálogo', 'guard_name' => 'web', 'module' => 'blog_categories']);
        Permission::create(['name' => 'edit_category', 'description' => 'Editar', 'guard_name' => 'web', 'module' => 'blog_categories']);
        Permission::create(['name' => 'create_category', 'description' => 'Crear', 'guard_name' => 'web', 'module' => 'blog_categories']);
        Permission::create(['name' => 'delete_category', 'description' => 'Eliminar/Restaurar', 'guard_name' => 'web', 'module' => 'blog_categories']);


        //Tag Permissions
        Permission::create(['name' => 'view_tags', 'description' => 'Ver catálogo', 'guard_name' => 'web', 'module' => 'tags']);
        Permission::create(['name' => 'edit_tag', 'description' => 'Editar', 'guard_name' => 'web', 'module' => 'tags']);
        Permission::create(['name' => 'create_tag', 'description' => 'Crear', 'guard_name' => 'web', 'module' => 'tags']);
        Permission::create(['name' => 'delete_tag', 'description' => 'Eliminar', 'guard_name' => 'web', 'module' => 'tags']);


        //Blog Permissions
        Permission::create(['name' => 'view_blogs', 'description' => 'Ver catálogo', 'guard_name' => 'web', 'module' => 'blogs']);
        Permission::create(['name' => 'edit_blog', 'description' => 'Editar', 'guard_name' => 'web', 'module' => 'blogs']);
        Permission::create(['name' => 'create_blog', 'description' => 'Crera', 'guard_name' => 'web', 'module' => 'blogs']);


        // Course'Category Permissions
        Permission::create(['name' => 'view_course_categories', 'description' => 'Ver catálogo', 'guard_name' => 'web', 'module' => 'course_categories']);
        Permission::create(['name' => 'edit_course_category', 'description' => 'Editar', 'guard_name' => 'web', 'module' => 'course_categories']);
        Permission::create(['name' => 'create_course_category', 'description' => 'Crear', 'guard_name' => 'web', 'module' => 'course_categories']);
        Permission::create(['name' => 'delete_course_category', 'description' => 'Eliminar/Restaurar', 'guard_name' => 'web', 'module' => 'course_categories']);


        // Course Permissions
        Permission::create(['name' => 'view_courses', 'description' => 'Ver catálogo', 'guard_name' => 'web', 'module' => 'courses']);
        Permission::create(['name' => 'create_course', 'description' => 'Crear', 'guard_name' => 'web', 'module' => 'courses']);
        Permission::create(['name' => 'edit_course', 'description' => 'Editar', 'guard_name' => 'web', 'module' => 'courses']);
        Permission::create(['name' => 'delete_course', 'description' => 'Eliminar/Restaurar', 'guard_name' => 'web', 'module' => 'courses']);

        //Chapter Permissions
        Permission::create(['name' => 'view_chapters', 'description' => 'Ver catálogo', 'guard_name' => 'web', 'module' => 'chapters']);
        Permission::create(['name' => 'create_chapter', 'description' => 'Crear', 'guard_name' => 'web', 'module' => 'chapters']);
        Permission::create(['name' => 'edit_chapter', 'description' => 'Editar', 'guard_name' => 'web', 'module' => 'chapters']);
        Permission::create(['name' => 'delete_chapter', 'description' => 'Eliminar', 'guard_name' => 'web', 'module' => 'chapters']);


        // Course Quizz Permissions
        Permission::create(['name' => 'view_course_quiz', 'description' => 'Ver catálogo', 'guard_name' => 'web', 'module' => 'quizzes']);
        Permission::create(['name' => 'edit_course_quiz', 'description' => 'Editar', 'guard_name' => 'web', 'module' => 'quizzes']);
        Permission::create(['name' => 'create_course_quiz', 'description' => 'Crear', 'guard_name' => 'web', 'module' => 'quizzes']);

        // Users Permissions
        Permission::create(['name' => 'view_users', 'description' => 'Ver catálogo', 'guard_name' => 'web', 'module' => 'users']);
        Permission::create(['name' => 'change_role_user', 'description' => 'Cambiar Rol', 'guard_name' => 'web', 'module' => 'users']);
        Permission::create(['name' => 'verify_account', 'description' => 'Verificar partners', 'guard_name' => 'web', 'module' => 'users']);
        Permission::create(['name' => 'edit_users', 'description' => 'Editar Perfil', 'guard_name' => 'web', 'module' => 'users']);
        Permission::create(['name' => 'delete_users', 'description' => 'Eliminar', 'guard_name' => 'web', 'module' => 'users']);
        Permission::create(['name' => 'reset_credentials', 'description' => 'Cambiar credenciales', 'guard_name' => 'web', 'module' => 'users']);

        // User Investment Permissions
        Permission::create(['name' => 'view_users_investment', 'description' => 'Ver Detalle de Inversión', 'guard_name' => 'web', 'module' => 'users']);

        Permission::create(['name' => 'view_users_investment_transactions', 'description' => 'Ver Movimientos de la Inversión', 'guard_name' => 'web', 'module' => 'users']);
        Permission::create(['name' => 'create_user_investment_transaction', 'description' => 'Crear Movimiento de la Inversión', 'guard_name' => 'web', 'module' => 'users']);

        Permission::create(['name' => 'view_users_investment_reports', 'description' => 'Ver Reportes de la Inversión', 'guard_name' => 'web', 'module' => 'users']);
        Permission::create(['name' => 'create_user_investment_report', 'description' => 'Crear Reporte de la Inversión', 'guard_name' => 'web', 'module' => 'users']);
        Permission::create(['name' => 'delete_user_investment_report', 'description' => 'Eliminar Reporte de la Inversión', 'guard_name' => 'web', 'module' => 'users']);



        //Roles Permission
        Permission::create(['name' => 'view_roles', 'description' => 'Ver catálogo', 'guard_name' => 'web', 'module' => 'roles']);
        Permission::create(['name' => 'edit_role', 'description' => 'Editar', 'guard_name' => 'web', 'module' => 'roles']);
        Permission::create(['name' => 'create_role', 'description' => 'Crear', 'guard_name' => 'web', 'module' => 'roles']);
        Permission::create(['name' => 'delete_role', 'description' => 'Eliminar/Restaurar', 'guard_name' => 'web', 'module' => 'roles']);


        //Payments
        Permission::create(['name' => 'view_payments', 'guard_name' => 'web']);


        // Create Super Admin user
        Role::create(['name' => 'Super Admin', 'guard_name' => 'web']);


        // Roles Creation
        Role::create(['name' => 'Investment', 'guard_name' => 'web']);
        $partner = Role::create(['name' => 'Partner', 'guard_name' => 'web']);


    }
}
