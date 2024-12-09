<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use  Spatie\Permission\Models\Role;
use  Spatie\Permission\Models\Permission;

class RolesPermisosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //roles para el area de abastecimineto :
        //Super Usuarios
        // $role = Role::create(['name' => 'admin','tipo'=>'cargo']);
        // //roles por departamento
        // $role1 = Role::create(['name' => 'Abastecimiento','tipo'=>'panel']);
        // $role2 = Role::create(['name' => 'Compras','tipo'=>'panel']);
        // $role3 = Role::create(['name' => 'Finanzas','tipo'=>'panel']);
        // $role4 = Role::create(['name' => 'Ventas','tipo'=>'panel']);
        // $role5 = Role::create(['name' => 'Adminstrar','tipo'=>'panel']);
        // $role6 = Role::create(['name' => 'Seguridad','tipo'=>'panel']);

        //*roles actor
        $role7 = Role::create(['name' => 'gerente_general','description' => 'Gerente General','tipo'=>'cargo']);
        $role8 = Role::create(['name' => 'cocinero','description' => 'Cocinero','tipo'=>'cargo']);
        $role9 = Role::create(['name' => 'asistente_cocina','description' => 'Asistente de cocina','tipo'=>'cargo']);
        $role10 = Role::create(['name' => 'encargado_publico','description' => 'Encargados atención al público','tipo'=>'cargo']);
        $role11 = Role::create(['name' => 'gerente_ventas','description' => 'Gerente de ventas','tipo'=>'cargo']);
        $role12 = Role::create(['name' => 'mesero','description' => 'Mesero','tipo'=>'cargo']);
        //roles actor de venta y finanzas
        // $role11 = Role::create(['name' => 'Contador','tipo'=>'cargo']);
        // $role12 = Role::create(['name' => 'Vendedor','tipo'=>'cargo']);
        // $role13 = Role::create(['name' => 'Jefe de Personal','tipo'=>'cargo']);
        // //roles actor de seguridad
        // $role14 = Role::create(['name' => 'Jefe Seguridad','tipo'=>'cargo']);
        // $role15 = Role::create(['name' => 'Brigadista','tipo'=>'cargo']);
        // $role16 = Role::create(['name' => 'Prevencionista','tipo'=>'cargo']);

        //---------------------------------------------------------------------------------------------------------------

        // Aqui hazme seeder pero para mis paneles que yo tengo en mi sistema
        //panel de dashboard
        Permission::create([
            'name' => 'panel.Dashboard',
            'description' => 'Acceso al panel de Dashboard',
            'tipo' => 'panel'
        ])->syncRoles([$role7]);
        //panel de reportes
        Permission::create([
            'name' => 'panel.Reportes',
            'description' => 'Acceso al panel de Reportes',
            'tipo' => 'panel'
        ])->syncRoles([$role7]);
        //panel de ia
        Permission::create([
            'name' => 'panel.IA',
            'description' => 'Acceso al panel de IA',
            'tipo' => 'panel'
        ])->syncRoles([$role7]);
        //panel de roles
        Permission::create([
            'name' => 'panel.Roles',
            'description' => 'Acceso al panel de Roles',
            'tipo' => 'panel'
        ])->syncRoles([$role7]);
        //panel de empleados
        Permission::create([
            'name' => 'panel.Empleados',
            'description' => 'Acceso al panel de Empleados',
            'tipo' => 'panel'
        ])->syncRoles([$role7]);
        //panel de mesas
        Permission::create([
            'name' => 'panel.Mesas',
            'description' => 'Acceso al panel de Mesas',
            'tipo' => 'panel'
        ])->syncRoles([$role7, $role12]);
        //panel de categorias
        Permission::create([
            'name' => 'panel.Categorias',
            'description' => 'Acceso al panel de Categorias',
            'tipo' => 'panel'
        ])->syncRoles([$role7, $role8, $role9]);
        //panel de inventario
        Permission::create([
            'name' => 'panel.Inventario',
            'description' => 'Acceso al panel de Inventario',
            'tipo' => 'panel'
        ])->syncRoles([$role7, $role8, $role9]);
        //panel de menu
        Permission::create([
            'name' => 'panel.Menu',
            'description' => 'Acceso al panel de Menu',
            'tipo' => 'panel'
        ])->syncRoles([$role7, $role8, $role9]);
        //panel de clientes
        Permission::create([
            'name' => 'panel.Clientes',
            'description' => 'Acceso al panel de Clientes',
            'tipo' => 'panel'
        ])->syncRoles([$role7, $role12]);
        //panel de ordenes
        Permission::create([
            'name' => 'panel.Ordenes',
            'description' => 'Acceso al panel de Ordenes',
            'tipo' => 'panel'
        ])->syncRoles([$role7, $role12]);
        //panel de comandas
        Permission::create([
            'name' => 'panel.Comandas',
            'description' => 'Acceso al panel de Comandas',
            'tipo' => 'panel'
        ])->syncRoles([$role7, $role12]);
        //panel de comprobantes
        Permission::create([
            'name' => 'panel.Comprobantes',
            'description' => 'Acceso al panel de Comprobantes',
            'tipo' => 'panel'
        ])->syncRoles([$role7, $role12]);


        //permisos
        Permission::create(
            [
                'name' => 'panel.Abastecimiento',
                'description' => 'Acceso al panel de Inventario',
                'tipo' => 'panel'
            ]
        )->syncRoles([ $role7, $role8, $role9, $role10]);
        Permission::create([
            'name' => 'panel.Compras',
            'description' => 'Acceso al panel de Compras',
            'tipo' => 'panel'

        ])->syncRoles([$role7, $role8]);
        Permission::create([
            'name' => 'panel.Finanzas',
            'description' => 'Acceso al panel de Administracion',
            'tipo' => 'panel'
        ])->syncRoles([$role10, $role9]);
        Permission::create([
            'name' => 'panel.Ventas',
            'description' => 'Acceso al panel de Ventas',
            'tipo' => 'panel'
        ])->syncRoles([$role11, $role12]);
        Permission::create([
            'name' => 'panel.Adminstrar',
            'description' => 'Acceso al panel de Abastecimiento ',
            'tipo' => 'panel'
        ])->syncRoles([$role9, $role11]);


        //Todo lo que puede hacer el supervisor en el area de abastecimiento OJO EL GERENTE TAMBIEN
        //* Productos:
        // Permission::create([
        //     'name' => 'productos.index',
        //     'description' => 'Ver listado de productos',
        //     'tipo' => 'crud'
        // ])->syncRoles([$role7, $role, $role10]);
        // Permission::create([
        //     'name' => 'productos.create',
        //     'description' => 'Crear producto',
        //     'tipo' => 'crud'
        // ])->syncRoles([$role7, $role, $role10]);
        // Permission::create([
        //     'name' => 'productos.show',
        //     'description' => 'Ver detalle de producto',
        //     'tipo' => 'crud'
        // ])->syncRoles([$role7, $role, $role10]);
        // Permission::create([
        //     'name' => 'productos.edit',
        //     'description' => 'Editar producto',
        //     'tipo' => 'crud'
        // ])->syncRoles([$role7, $role, $role10]);
        // Permission::create([
        //     'name' => 'productos.destroy',
        //     'description' => 'Eliminar producto',
        //     'tipo' => 'crud'
        // ])->syncRoles([$role7, $role, $role10]);
        // //*Solicitudes:
        // Permission::create([
        //     'name' => 'solicituds.index',
        //     'description' => 'Crear solicitud',
        //     'tipo' => 'crud'
        // ])->syncRoles([$role7, $role, $role10, $role9]);
        // Permission::create([
        //     'name' => 'solicituds.create',
        //     'description' => 'Ver listado de solicitudes',
        //     'tipo' => 'crud'
        // ])->syncRoles([$role7, $role, $role10, $role9]);
        // Permission::create([
        //     'name' => 'solicituds.show',
        //     'description' => 'Ver detalle de solicitud',
        //     'tipo' => 'crud'
        // ])->syncRoles([$role7, $role, $role10, $role9]);
        // Permission::create([
        //     'name' => 'solicituds.edit',
        //     'description' => 'Editar solicitud',
        //     'tipo' => 'crud'
        // ])->syncRoles([$role7, $role, $role10, $role9]);
        // Permission::create([
        //     'name' => 'solicituds.destroy',
        //     'description' => 'Eliminar solicitud',
        //     'tipo' => 'crud'
        // ])->syncRoles([$role7, $role, $role10, $role9]);
        // //*Ventas:
        // Permission::create([
        //     'name' => 'ventas.index',
        //     'description' => 'Ver listado de ventas',
        //     'tipo' => 'crud'
        // ])->syncRoles([$role]);
        // Permission::create([
        //     'name' => 'ventas.create',
        //     'description' => 'Crear venta',
        //     'tipo' => 'crud'
        // ])->syncRoles([$role]);
        // Permission::create([
        //     'name' => 'ventas.show',
        //     'description' => 'Ver detalle de venta',
        //     'tipo' => 'crud'
        // ])->syncRoles([$role]);
        // Permission::create([
        //     'name' => 'ventas.edit',
        //     'description' => 'Editar venta',
        //     'tipo' => 'crud'
        // ])->syncRoles([$role]);
        // Permission::create([
        //     'name' => 'ventas.destroy',
        //     'description' => 'Eliminar venta',
        //     'tipo' => 'crud'
        // ])->syncRoles([$role]);
        // //*Finanzas:
        // Permission::create([
        //     'name' => 'documentos-contables.index',
        //     'description' => 'Ver listado de documentos contables',
        //     'tipo' => 'crud'
        // ])->syncRoles([$role]);
        // Permission::create([
        //     'name' => 'documentos-contables.create',
        //     'description' => 'Crear documento contable',
        //     'tipo' => 'crud'
        // ])->syncRoles([$role]);
        // Permission::create([
        //     'name' => 'documentos-contables.show',
        //     'description' => 'Ver detalle de documento contable',
        //     'tipo' => 'crud'
        // ])->syncRoles([$role]);
        // Permission::create([
        //     'name' => 'documentos-contables.edit',
        //     'description' => 'Editar documento contable',
        //     'tipo' => 'crud'
        // ])->syncRoles([$role]);
        // Permission::create([
        //     'name' => 'documentos-contables.destroy',
        //     'description' => 'Eliminar documento contable',
        //     'tipo' => 'crud'
        // ])->syncRoles([$role]);
        // Permission::create([
        //     'name' => 'tipo-pagos.index',
        //     'description' => 'Ver listado de tipo de pagos',
        //     'tipo' => 'crud'
        // ])->syncRoles([$role]);
        // Permission::create([
        //     'name' => 'tipo-pagos.create',
        //     'description' => 'Crear tipo de pago',
        //     'tipo' => 'crud'
        // ])->syncRoles([$role]);
        // Permission::create([
        //     'name' => 'tipo-pagos.show',
        //     'description' => 'Ver detalle de tipo de pago',
        //     'tipo' => 'crud'
        // ])->syncRoles([$role]);
        // Permission::create([
        //     'name' => 'tipo-pagos.edit',
        //     'description' => 'Editar tipo de pago',
        //     'tipo' => 'crud'
        // ])->syncRoles([$role]);
        // Permission::create([
        //     'name' => 'tipo-pagos.destroy',
        //     'description' => 'Eliminar tipo de pago',
        //     'tipo' => 'crud'
        // ])->syncRoles([$role]);
        // Permission::create([
        //     'name' => 'tipo-comprobante.index',
        //     'description' => 'Ver listado de tipo de comprobantes',
        //     'tipo' => 'crud'
        // ])->syncRoles([$role]);
        // Permission::create([
        //     'name' => 'tipo-comprobante.create',
        //     'description' => 'Crear tipo de comprobante',
        //     'tipo' => 'crud'
        // ])->syncRoles([$role]);
        // Permission::create([
        //     'name' => 'tipo-comprobante.show',
        //     'description' => 'Ver detalle de tipo de comprobante',
        //     'tipo' => 'crud'
        // ])->syncRoles([$role]);
        // Permission::create([
        //     'name' => 'tipo-comprobante.edit',
        //     'description' => 'Editar tipo de comprobante',
        //     'tipo' => 'crud'
        // ])->syncRoles([$role]);
        // Permission::create([
        //     'name' => 'tipo-comprobante.destroy',
        //     'description' => 'Eliminar tipo de comprobante',
        //     'tipo' => 'crud'
        // ])->syncRoles([$role]);
        // //*Seguridad:
        // Permission::create([
        //     'name' => 'capacitacions.index',
        //     'description' => 'Ver listado de capacitaciones',
        //     'tipo' => 'crud'
        // ])->syncRoles([$role]);
        // Permission::create([
        //     'name' => 'capacitacions.create',
        //     'description' => 'Crear capacitacion',
        //     'tipo' => 'crud'
        // ])->syncRoles([$role]);
        // Permission::create([
        //     'name' => 'capacitacions.show',
        //     'description' => 'Ver detalle de capacitacion',
        //     'tipo' => 'crud'
        // ])->syncRoles([$role]);
        // Permission::create([
        //     'name' => 'capacitacions.edit',
        //     'description' => 'Editar capacitacion',
        //     'tipo' => 'crud'
        // ])->syncRoles([$role]);
        // Permission::create([
        //     'name' => 'capacitacions.destroy',
        //     'description' => 'Eliminar capacitacion',
        //     'tipo' => 'crud'
        // ])->syncRoles([$role]);
        // Permission::create([
        //     'name' => 'departamentos.index',
        //     'description' => 'Ver listado de departamentos',
        //     'tipo' => 'crud'
        // ])->syncRoles([$role]);
        // Permission::create([
        //     'name' => 'departamentos.create',
        //     'description' => 'Crear departamento',
        //     'tipo' => 'crud'
        // ])->syncRoles([$role]);
        // Permission::create([
        //     'name' => 'departamentos.show',
        //     'description' => 'Ver detalle de departamento',
        //     'tipo' => 'crud'
        // ])->syncRoles([$role]);
        // Permission::create([
        //     'name' => 'departamentos.edit',
        //     'description' => 'Editar departamento',
        //     'tipo' => 'crud'
        // ])->syncRoles([$role]);
        // Permission::create([
        //     'name' => 'departamentos.destroy',
        //     'description' => 'Eliminar departamento',
        //     'tipo' => 'crud'
        // ])->syncRoles([$role]);
        // Permission::create([
        //     'name' => 'empleados.index',
        //     'description' => 'Ver listado de empleados',
        //     'tipo' => 'crud'
        // ])->syncRoles([$role]);
        // Permission::create([
        //     'name' => 'empleados.create',
        //     'description' => 'Crear empleado',
        //     'tipo' => 'crud'
        // ])->syncRoles([$role]);
        // Permission::create([
        //     'name' => 'empleados.show',
        //     'description' => 'Ver detalle de empleado',
        //     'tipo' => 'crud'
        // ])->syncRoles([$role]);
        // Permission::create([
        //     'name' => 'empleados.edit',
        //     'description' => 'Editar empleado',
        //     'tipo' => 'crud'
        // ])->syncRoles([$role]);
        // Permission::create([
        //     'name' => 'empleados.destroy',
        //     'description' => 'Eliminar empleado',
        //     'tipo' => 'crud'
        // ])->syncRoles([$role]);

        // Permission::create([
        //     'name' => 'roles.index',
        //     'description' => 'Ver listado de roles',
        //     'tipo' => 'crud'
        // ])->syncRoles([$role]);
        // Permission::create([
        //     'name' => 'roles.create',
        //     'description' => 'Crear rol',
        //     'tipo' => 'crud'
        // ])->syncRoles([$role]);
        // Permission::create([
        //     'name' => 'roles.show',
        //     'description' => 'Ver detalle de rol',
        //     'tipo' => 'crud'
        // ])->syncRoles([$role]);
        // Permission::create([
        //     'name' => 'roles.edit',
        //     'description' => 'Editar rol',
        //     'tipo' => 'crud'
        // ])->syncRoles([$role]);
        // Permission::create([
        //     'name' => 'roles.destroy',
        //     'description' => 'Eliminar rol',
        //     'tipo' => 'crud'
        // ])->syncRoles([$role]);

        // Permission::create([
        //     'name' => 'permisos.index',
        //     'description' => 'Ver listado de permisos',
        //     'tipo' => 'crud'
        // ])->syncRoles([$role]);
        // Permission::create([
        //     'name' => 'permisos.create',
        //     'description' => 'Crear permiso',
        //     'tipo' => 'crud'
        // ])->syncRoles([$role]);
        // Permission::create([
        //     'name' => 'permisos.show',
        //     'description' => 'Ver detalle de permiso',
        //     'tipo' => 'crud'
        // ])->syncRoles([$role]);
        // Permission::create([
        //     'name' => 'permisos.edit',
        //     'description' => 'Editar permiso',
        //     'tipo' => 'crud'
        // ])->syncRoles([$role]);
        // Permission::create([
        //     'name' => 'permisos.destroy',
        //     'description' => 'Eliminar permiso',
        //     'tipo' => 'crud'
        // ])->syncRoles([$role]);
        // //*Compras:
        // Permission::create([
        //     'name' => 'orden-compras.index',
        //     'description' => 'Ver listado de ordenes de compras',
        //     'tipo' => 'crud'
        // ])->syncRoles([$role]);
        // Permission::create([
        //     'name' => 'orden-compras.create',
        //     'description' => 'Crear orden de compra',
        //     'tipo' => 'crud'
        // ])->syncRoles([$role]);
        // Permission::create([
        //     'name' => 'orden-compras.show',
        //     'description' => 'Ver detalle de orden de compra',
        //     'tipo' => 'crud'
        // ])->syncRoles([$role]);
        // Permission::create([
        //     'name' => 'orden-compras.edit',
        //     'description' => 'Editar orden de compra',
        //     'tipo' => 'crud'
        // ])->syncRoles([$role]);
        // Permission::create([
        //     'name' => 'orden-compras.destroy',
        //     'description' => 'Eliminar orden de compra',
        //     'tipo' => 'crud'
        // ])->syncRoles([$role]);
        // Permission::create([
        //     'name' => 'proveedores.index',
        //     'description' => 'Ver listado de proveedores',
        //     'tipo' => 'crud'
        // ])->syncRoles([$role]);
        // Permission::create([
        //     'name' => 'proveedores.create',
        //     'description' => 'Crear proveedor',
        //     'tipo' => 'crud'
        // ])->syncRoles([$role]);
        // Permission::create([
        //     'name' => 'proveedores.show',
        //     'description' => 'Ver detalle de proveedor',
        //     'tipo' => 'crud'
        // ])->syncRoles([$role]);
        // Permission::create([
        //     'name' => 'proveedores.edit',
        //     'description' => 'Editar proveedor',
        //     'tipo' => 'crud'
        // ])->syncRoles([$role]);
        // Permission::create([
        //     'name' => 'proveedores.destroy',
        //     'description' => 'Eliminar proveedor',
        //     'tipo' => 'crud'
        // ])->syncRoles([$role]);
    }
}
