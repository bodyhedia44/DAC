<?php
namespace Database\Seeders;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
class PermissionTableSeeder extends Seeder
{
    public function run()
    {
        //Permissions
        $permissions = [
            'قائمة الصلاحيات',
            'اضافة صلاحية',
            'تعديل صلاحية',
            'حذف صلاحية',
            'قائمة المستخدمين',
            'اضافة مستخدم',
            'تعديل مستخدم',
            'حذف مستخدم',
            'الصفحة الرئيسية',
            'صفحة نقاط البيع',
            'عرض المنتجات',
            'انشاء منتجات',
            'تعديل منتجات',
            'حذف منتج',
            'عرض التصنيفات',
            'انشاء تصنيفات',
            'تعديل تصنيفات',
            'حذف تصنيف',
            'عرض نقاط الولاء',
            'انشاء نقاط ولاء',
            'تعديل نقاط الولاء',
            'حذف نقاط الولاء',
            'الاعدادات',
            'المرتجعات',
            'الاحصائيات',
            'المبيعات',
            'تقرير المنتجات',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
