<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->createAdminRole();

        $this->createClientRole();

        $this->createAgentRole();
    }


    private function createAdminRole()
    {
        $adminRole = Role::create([
            'name' => 'admin',
            'guard_name' => 'web',
            'description' => 'Administrador del sistema con acceso total a todas las funcionalidades'
        ]);

        // Asignar permisos al rol admin
        $permissions = Permission::whereIn('name', ['all.access'])->get()->pluck('id')->toArray();
        $adminRole->permissions()->sync($permissions);
    }

    private function createClientRole()
    {
        $userRole = Role::create([
            'name' => 'cliente',
            'guard_name' => 'web',
            'description' => 'Cliente del sistema con permisos limitados para crear y gestionar sus propios tickets'
        ]);

        // Asignar permisos al rol user
        $permissions = Permission::whereIn('name', [
            // Tickets
            'users.read',
            'tickets.create',
            'tickets.read',
            'tickets.update',
            'tickets.history',
            'tickets.close',
            'tickets.assign',
            'tickets.comment',

            // Chats
            'chats.start',
            'chats.close',
            'chats.view_own',
            'chats.upload_files',
        ])->get()->pluck('id')->toArray();

        $userRole->permissions()->sync($permissions);
    }

    private function createAgentRole()
    {
        $agentRole = Role::create([
            'name' => 'agente',
            'guard_name' => 'web',
            'description' => 'Agente del sistema con permisos para gestionar tickets asignados y colaborar en la resolución de los mismos'
        ]);

        // Asignar permisos al rol agent
        $permissions = Permission::whereIn('name', [
            // Tickets
            'users.read',
            'tickets.read',
            'tickets.update',
            'tickets.history',
            'tickets.reopen',
            'tickets.comment',

            // Chats
            'chats.start',
            'chats.view_own',
            'chats.upload_files',
        ])->get()->pluck('id')->toArray();

        $agentRole->permissions()->sync($permissions);
    }
}
