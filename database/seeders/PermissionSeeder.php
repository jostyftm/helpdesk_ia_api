<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{

    /**
     * The modules for which permissions will be created.
     * 
     * @var array
     */
    private $modules = [
        [
            'name' => 'all',
            'permissions' => [
                [
                    'display_name' => 'acceso total',
                    'name' => 'all.access',
                    'description' => 'Permite acceso total a todas las funcionalidades del sistema'
                ]
            ]
        ],
        [
            'name' => 'users',
            'permissions' => [
                [
                    'display_name' => 'listar usuarios',
                    'name' => 'users.read',
                    'description' => 'Permite listar los usuarios del sistema'
                ],
                [
                    'display_name' => 'crear usuarios',
                    'name' => 'users.create',
                    'description' => 'Permite crear nuevos usuarios en el sistema'
                ],
                [
                    'display_name' => 'actualizar usuarios',
                    'name' => 'users.update',
                    'description' => 'Permite actualizar la información de los usuarios del sistema'
                ],
                [
                    'display_name' => 'eliminar usuarios',
                    'name' => 'users.delete',
                    'description' => 'Permite eliminar usuarios del sistema'
                ]
            ]
        ],
        [
            'name' => 'roles',
            'permissions' => [
                [
                    'display_name' => 'listar roles',
                    'name' => 'roles.read',
                    'description' => 'Permite listar los roles del sistema'
                ],
                [
                    'display_name' => 'crear roles',
                    'name' => 'roles.create',
                    'description' => 'Permite crear nuevos roles en el sistema'
                ],
                [
                    'display_name' => 'actualizar roles',
                    'name' => 'roles.update',
                    'description' => 'Permite actualizar la información de los roles del sistema'
                ],
                [
                    'display_name' => 'eliminar roles',
                    'name' => 'roles.delete',
                    'description' => 'Permite eliminar roles del sistema'
                ]
            ]
        ],
        [
            'name' => 'tickets',
            'permissions' => [
                [
                    'display_name' => 'listar tickets',
                    'name' => 'tickets.read',
                    'description' => 'Permite listar los tickets del sistema'
                ],
                [
                    'display_name' => 'crear tickets',
                    'name' => 'tickets.create',
                    'description' => 'Permite crear nuevos tickets en el sistema'
                ],
                [
                    'display_name' => 'actualizar tickets',
                    'name' => 'tickets.update',
                    'description' => 'Permite actualizar la información de los tickets del sistema'
                ],
                [
                    'display_name' => 'eliminar tickets',
                    'name' => 'tickets.delete',
                    'description' => 'Permite eliminar tickets del sistema'
                ],
                // Custom permissions
                [
                    'display_name' => 'asignar tickets',
                    'name' => 'tickets.assign',
                    'description' => 'Permite asignar tickets a agentes del sistema'
                ],
                [
                    'display_name' => 'cerrar tickets',
                    'name' => 'tickets.close',
                    'description' => 'Permite cerrar tickets del sistema'
                ],
                [
                    'display_name' => 'reabrir tickets',
                    'name' => 'tickets.reopen',
                    'description' => 'Permite reabrir tickets cerrados del sistema'
                ],
                [
                    'display_name' => 'comentar tickets',
                    'name' => 'tickets.comment',
                    'description' => 'Permite agregar comentarios a los tickets del sistema'
                ],
                [
                    'display_name' => 'ver historial de tickets',
                    'name' => 'tickets.history',
                    'description' => 'Permite ver el historial de cambios y actividades de los tickets del sistema'
                ]
            ]
        ],
        [
            'name' => 'chats',
            'permissions' => [
                [
                    'display_name' => 'listar chats',
                    'name' => 'chats.read',
                    'description' => 'Permite listar los chats del sistema'
                ],
                [
                    'display_name' => 'crear chats',
                    'name' => 'chats.create',
                    'description' => 'Permite crear nuevos chats en el sistema'
                ],
                [
                    'display_name' => 'actualizar chats',
                    'name' => 'chats.update',
                    'description' => 'Permite actualizar la información de los chats del sistema'
                ],
                [
                    'display_name' => 'eliminar chats',
                    'name' => 'chats.delete',
                    'description' => 'Permite eliminar chats del sistema'
                ],
                // Custom permissions for chats can be added here if needed
                [
                    'display_name' => 'iniciar chats',
                    'name' => 'chats.start',
                    'description' => 'Permite a los usuarios iniciar nuevos chats agentes del sistema'
                ],
                [
                    'display_name' => 'ver mis chats',
                    'name' => 'chats.view_own',
                    'description' => 'Permite a los usuarios ver solo los chats en los que están involucrados'
                ],
                [
                    'display_name' => 'subir archivos en chats',
                    'name' => 'chats.upload_files',
                    'description' => 'Permite a los usuarios subir archivos adjuntos en los chats del sistema'
                ],
                [
                    'display_name' => 'cerrar chats',
                    'name' => 'chats.close',
                    'description' => 'Permite a los usuarios cerrar chats del sistema'
                ]
            ]
        ]
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->modules as $module) {
            foreach ($module['permissions'] as $permission) {
                Permission::create([
                    'name' => $permission['name'],
                    'guard_name' => 'web',
                    'display_name' => $permission['display_name'],
                    'description' => $permission['description']
                ]);
            }
        }
    }
}
