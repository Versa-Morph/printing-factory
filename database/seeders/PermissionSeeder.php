<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'create-role',
            'edit-role',
            'delete-role',
            'create-user',
            'edit-user',
            'delete-user',
            'create-product',
            'edit-product',
            'delete-product',
            'list-pelanggan',
            'create-pelanggan',
            'edit-pelanggan',
            'delete-pelanggan',
            'list-karyawan',
            'create-karyawan',
            'edit-karyawan',
            'delete-karyawan',
            'list-gaji',
            'create-gaji',
            'edit-gaji',
            'delete-gaji',
            'list-desain-product',
            'create-desain-product',
            'edit-desain-product',
            'delete-desain-product',
            'list-rencana-produksi',
            'create-rencana-produksi',
            'edit-rencana-produksi',
            'delete-rencana-produksi',
            'list-order',
            'create-order',
            'edit-order',
            'delete-order',
            'list-jadwal-produksi',
            'create-jadwal-produksi',
            'edit-jadwal-produksi',
            'delete-jadwal-produksi',
            'list-laporan-produksi',
            'create-laporan-produksi',
            'edit-laporan-produksi',
            'delete-laporan-produksi',
            'list-customer',
            'create-customer',
            'edit-customer',
            'delete-customer',
            'list-attendance',
            'list-overtime',
            'list-absence',
            'list-work-schedule',
            'list-employe',
            'create-employe',
            'edit-employe',
            'delete-employe',
            'list-employee-salary',
            'create-employee-salary',
            'edit-employee-salary',
            'delete-employee-salary',

            // HR MANAGER 
            'menu-manager',
            'dashboard-manager-hr',
            'employee-management',
            'absence-management',
            'payroll-management',
            'list-work-schedule',

            // HR  
            'menu-staff',
            'dashboard-staff-hr',
            'employee-records',
            'absence-requests',
            'payroll-access',
            'self-service',
         
            'menu-analytics-manager',
            'attendance-analysis',
            'payroll-analysis',
            'employee-performance',

            'menu-analytics-staff',
            'task-performance',
            'absence-reports',

            'list-shift',
            'master-data',

            'settings',
            'user-preferences',
            'role-specific-settings',
            'logout',


            // SALES 
            'dashboard-manager-sales',
            'customer-management',
            'quotation-management',
            'order-management',
            'sales-team-management',
            'discount-&-Promotion-Management',

            'dashboard-staff-sales',
            'sales-task',
            'sales-performance-reports',
            'kpi-tracking',
            'customer-analytics',
            'quotation-&-order-analytics',
            'personal-sales-reports',
            'customer-interaction-analysis',

            // Accounting 
            'dashboard-manager-accounting',
            'invoice-management',
            'accounts-receivable',
            'accounts-payable',
            'tax-management',
            'general-ledger',
            'financial-reporting',
            'dashboard-staff-accounting',
            'financial-analysis',
            'cash-flow-analysis',
            'tax-analysis',
            'budget-&-Forecast',
            'accounts-performance',
            'transaction-reports',
            'payment-analysis',
        ];


        // Looping and Inserting Array's Permissions into Permission Table
        foreach ($permissions as $permission) {
            Permission::updateOrCreate(
                ['name' => $permission]
            );
        }

        // GIVE ALL PERMISSON TO SUPERADMIN
        $superAdmin = Role::updateOrCreate(['name' => 'Super Admin']);
        $permissions = Permission::all();
        $superAdmin->givePermissionTo($permissions);


        // HR 
        $this->setupRoleHR();
        $this->setupRoleHRManager();
        $this->setupRoleHRStaff();

        // Sales 
        $this->setupRoleSales();
        $this->setupRoleSalesManager();
        $this->setupRoleSalesStaff();

        // Accounting 
        $this->setupRoleAccounting();
        $this->setupRoleAccountingManager();
        $this->setupRoleAccountingStaff();
    }

    public function setupRoleHR(){
        // PERMISSION HR 
        $hr = Role::updateOrCreate(['name' => 'Human Resource']);
        $accessHr = [
            'list-attendance',
            'list-overtime',
            'list-absence',
            'list-work-schedule',
            'list-employe',
            'create-employe',
            'edit-employe',
            'delete-employe',
            'list-employee-salary',
            'create-employee-salary',
            'edit-employee-salary',
            'delete-employee-salary',
            'menu-manager',
            'dashboard-manager-hr',
            'employee-management',
            'absence-management',
            'payroll-management',
            'list-work-schedule',
            'menu-staff',
            'dashboard-staff-hr',
            'employee-records',
            'absence-requests',
            'payroll-access',
            'self-service',
            'menu-analytics-manager',
            'attendance-analysis',
            'payroll-analysis',
            'employee-performance',
            'menu-analytics-staff',
            'task-performance',
            'absence-reports',
            'list-shift',
            'master-data',
            'settings',
            'user-preferences',
            'role-specific-settings',
            'logout'
        ] ;
        $permissionsHR = Permission::whereIn('name',$accessHr)->get();
        $hr->givePermissionTo($permissionsHR);
    }

    public function setupRoleHRManager(){
        // PERMISSION HR 
        $hr = Role::updateOrCreate(['name' => 'Human Resource Manager']);
        $accessHr = [
            'list-attendance',
            'list-overtime',
            'list-absence',
            'list-work-schedule',
            'list-employe',
            'create-employe',
            'edit-employe',
            'delete-employe',
            'list-employee-salary',
            'create-employee-salary',
            'edit-employee-salary',
            'delete-employee-salary',
            'menu-manager',
            'dashboard-manager-hr',
            'employee-management',
            'absence-management',
            'payroll-management',
            'list-work-schedule',
            'menu-analytics-manager',
            'attendance-analysis',
            'payroll-analysis',
            'employee-performance',
            'list-shift',
            'master-data',
            'settings',
            'user-preferences',
            'role-specific-settings',
            'logout'
        ] ;
        $permissionsHR = Permission::whereIn('name',$accessHr)->get();
        $hr->givePermissionTo($permissionsHR);
    }

    public function setupRoleHRStaff(){
        // PERMISSION HR 
        $hr = Role::updateOrCreate(['name' => 'Human Resource Staff']);
        $accessHr = [
            'list-attendance',
            'list-overtime',
            'list-absence',
            'list-work-schedule',
            'menu-staff',
            'dashboard-staff-hr',
            'employee-records',
            'absence-requests',
            'payroll-access',
            'self-service',
            'menu-analytics-staff',
            'task-performance',
            'absence-reports',
            'list-shift',
            'master-data',
            'settings',
            'user-preferences',
            'role-specific-settings',
            'logout'
        ] ;
        $permissionsHR = Permission::whereIn('name',$accessHr)->get();
        $hr->givePermissionTo($permissionsHR);
    }

    public function setupRoleSales(){
        // PERMISSION Sales 
        $Sales = Role::updateOrCreate(['name' => 'Sales']);
        $accessSales = [
            'list-attendance',
            'list-overtime',
            'list-absence',
            'list-work-schedule',
            'dashboard-manager-sales',
            'customer-management',
            'quotation-management',
            'order-management',
            'sales-team-management',
            'discount-&-Promotion-Management',
            'dashboard-manager-sales',
            'sales-task',
            'sales-performance-reports',
            'kpi-tracking',
            'customer-analytics',
            'quotation-&-order-analytics',
            'personal-sales-reports',
            'customer-interaction-analysis',
            'settings',
            'user-preferences',
            'role-specific-settings',
            'logout'
        ] ;
        $permissionsSales = Permission::whereIn('name',$accessSales)->get();
        $Sales->givePermissionTo($permissionsSales);
    }

    public function setupRoleSalesManager(){
        // PERMISSION Sales 
        $Sales = Role::updateOrCreate(['name' => 'Sales Manager']);
        $accessSales = [
            'list-attendance',
            'list-overtime',
            'list-absence',
            'list-work-schedule',
            'dashboard-manager-sales',
            'customer-management',
            'quotation-management',
            'order-management',
            'sales-team-management',
            'discount-&-Promotion-Management',
            'sales-performance-reports',
            'kpi-tracking',
            'customer-analytics',
            'quotation-&-order-analytics',
            'settings',
            'user-preferences',
            'role-specific-settings',
            'logout'
        ] ;
        $permissionsSales = Permission::whereIn('name',$accessSales)->get();
        $Sales->givePermissionTo($permissionsSales);
    }
    public function setupRoleSalesStaff(){
        // PERMISSION Sales 
        $Sales = Role::updateOrCreate(['name' => 'Sales Staff']);
        $accessSales = [
            'list-attendance',
            'list-overtime',
            'list-absence',
            'list-work-schedule',
            'dashboard-staff-sales',
            'customer-management',
            'quotation-management',
            'order-management',
            'sales-task',
            'personal-sales-reports',
            'customer-interaction-analysis',
            'settings',
            'user-preferences',
            'role-specific-settings',
            'logout'
        ] ;
        $permissionsSales = Permission::whereIn('name',$accessSales)->get();
        $Sales->givePermissionTo($permissionsSales);
    }

    public function setupRoleAccounting(){
        // PERMISSION Accounting 
        $Accounting = Role::updateOrCreate(['name' => 'Accounting']);
        $accessAccounting = [
            'list-attendance',
            'list-overtime',
            'list-absence',
            'list-work-schedule',
            'dashboard-manager-accounting',
            'invoice-management',
            'accounts-receivable',
            'accounts-payable',
            'tax-management',
            'general-ledger',
            'financial-reporting',
            'dashboard-staff-accounting',
            'financial-analysis',
            'cash-flow-analysis',
            'tax-analysis',
            'budget-&-Forecast',
            'accounts-performance',
            'transaction-reports',
            'payment-analysis',
            'settings',
            'user-preferences',
            'role-specific-settings',
            'logout'
        ] ;
        $permissionsAccounting = Permission::whereIn('name',$accessAccounting)->get();
        $Accounting->givePermissionTo($permissionsAccounting);
    }
    public function setupRoleAccountingManager(){
        // PERMISSION Accounting 
        $Accounting = Role::updateOrCreate(['name' => 'Accounting Manager']);
        $accessAccounting = [
            'list-attendance',
            'list-overtime',
            'list-absence',
            'list-work-schedule',
            'dashboard-manager-accounting',
            'invoice-management',
            'accounts-receivable',
            'accounts-payable',
            'tax-management',
            'general-ledger',
            'financial-reporting',
            'financial-analysis',
            'cash-flow-analysis',
            'tax-analysis',
            'budget-&-Forecast',
            'accounts-performance',
            'settings',
            'user-preferences',
            'role-specific-settings',
            'logout'
        ] ;
        $permissionsAccounting = Permission::whereIn('name',$accessAccounting)->get();
        $Accounting->givePermissionTo($permissionsAccounting);
    }

    public function setupRoleAccountingStaff(){
        // PERMISSION Accounting 
        $Accounting = Role::updateOrCreate(['name' => 'Accounting Staff']);
        $accessAccounting = [
            'list-attendance',
            'list-overtime',
            'list-absence',
            'list-work-schedule',
            'invoice-management',
            'accounts-receivable',
            'accounts-payable',
            'tax-management',
            'dashboard-staff-accounting',
            'transaction-reports',
            'payment-analysis',
            'settings',
            'user-preferences',
            'role-specific-settings',
            'logout'
        ] ;
        $permissionsAccounting = Permission::whereIn('name',$accessAccounting)->get();
        $Accounting->givePermissionTo($permissionsAccounting);
    }
}
