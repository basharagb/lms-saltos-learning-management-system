<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Helpers\Qs;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->delete();

        $this->createNewUsers();
        $this->createManyUsers(3);
        $this->fixOrphanedStudentRecords();
    }

    protected function createNewUsers(): void
    {
        $password = Hash::make('123456789'); // Default user password
        $defaultPhoto = Qs::getDefaultUserImage();
        $now = now();

        $users = [
            [
                'name' => 'أحمد محمد - مدير النظام',
                'email' => 'cj@cj.com',
                'username' => 'cj',
                'password' => $password,
                'user_type' => 'super_admin',
                'code' => strtoupper(Str::random(10)),
                'photo' => $defaultPhoto,
                'gender' => 'Male',
                'phone' => '+966501234567',
                'address' => 'الرياض، المملكة العربية السعودية',
                'email_verified_at' => $now,
                'remember_token' => Str::random(10),
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'سارة أحمد - مدير إداري',
                'email' => 'admin@admin.com',
                'password' => $password,
                'user_type' => 'admin',
                'username' => 'admin',
                'code' => strtoupper(Str::random(10)),
                'photo' => $defaultPhoto,
                'gender' => 'Female',
                'phone' => '+966502345678',
                'address' => 'جدة، المملكة العربية السعودية',
                'email_verified_at' => $now,
                'remember_token' => Str::random(10),
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'محمد علي - مدرس',
                'email' => 'teacher@teacher.com',
                'user_type' => 'teacher',
                'username' => 'teacher',
                'password' => $password,
                'code' => strtoupper(Str::random(10)),
                'photo' => $defaultPhoto,
                'gender' => 'Male',
                'phone' => '+966503456789',
                'address' => 'الدمام، المملكة العربية السعودية',
                'email_verified_at' => $now,
                'remember_token' => Str::random(10),
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'فاطمة حسن - ولي أمر',
                'email' => 'parent@parent.com',
                'user_type' => 'parent',
                'username' => 'parent',
                'password' => $password,
                'code' => strtoupper(Str::random(10)),
                'photo' => $defaultPhoto,
                'gender' => 'Female',
                'phone' => '+966504567890',
                'address' => 'مكة المكرمة، المملكة العربية السعودية',
                'email_verified_at' => $now,
                'remember_token' => Str::random(10),
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'خالد يوسف - محاسب',
                'email' => 'accountant@accountant.com',
                'user_type' => 'accountant',
                'username' => 'accountant',
                'password' => $password,
                'code' => strtoupper(Str::random(10)),
                'photo' => $defaultPhoto,
                'gender' => 'Male',
                'phone' => '+966505678901',
                'address' => 'المدينة المنورة، المملكة العربية السعودية',
                'email_verified_at' => $now,
                'remember_token' => Str::random(10),
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'نور الدين - أمين مكتبة',
                'email' => 'librarian@librarian.com',
                'user_type' => 'librarian',
                'username' => 'librarian',
                'password' => $password,
                'code' => strtoupper(Str::random(10)),
                'photo' => $defaultPhoto,
                'gender' => 'Male',
                'phone' => '+966506789012',
                'address' => 'الطائف، المملكة العربية السعودية',
                'email_verified_at' => $now,
                'remember_token' => Str::random(10),
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'عمر خالد - طالب',
                'email' => 'student@student.com',
                'user_type' => 'student',
                'username' => 'student',
                'password' => $password,
                'code' => strtoupper(Str::random(10)),
                'photo' => $defaultPhoto,
                'gender' => 'Male',
                'phone' => '+966507890123',
                'address' => 'أبها، المملكة العربية السعودية',
                'email_verified_at' => $now,
                'remember_token' => Str::random(10),
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        DB::table('users')->insert($users);
    }

    protected function createManyUsers(int $count): void
    {
        $data = [];
        $defaultPhoto = Qs::getDefaultUserImage();
        $now = now();

        // Get user types excluding those already created in createNewUsers
        $user_types = ['teacher', 'parent', 'accountant', 'librarian', 'student'];

        // Arabic names for each user type
        $arabic_names = [
            'teacher' => ['أحمد محمود', 'فاطمة علي', 'محمد حسن', 'نور الهدى', 'خالد يوسف'],
            'parent' => ['سعد الدين', 'أم محمد', 'عبد الله أحمد', 'زينب حسن', 'يوسف علي'],
            'accountant' => ['مريم خالد', 'عمر سعد', 'هدى محمد', 'حسام الدين', 'ليلى أحمد'],
            'librarian' => ['نادية حسن', 'طارق محمد', 'سلمى علي', 'وائل خالد', 'رنا يوسف'],
            'student' => ['علي أحمد', 'سارة محمد', 'حسن علي', 'نور فاطمة', 'محمود خالد']
        ];

        // Saudi cities for addresses
        $saudi_cities = [
            'الرياض، المملكة العربية السعودية',
            'جدة، المملكة العربية السعودية',
            'الدمام، المملكة العربية السعودية',
            'مكة المكرمة، المملكة العربية السعودية',
            'المدينة المنورة، المملكة العربية السعودية',
            'الطائف، المملكة العربية السعودية',
            'أبها، المملكة العربية السعودية',
            'تبوك، المملكة العربية السعودية',
            'بريدة، المملكة العربية السعودية',
            'خميس مشيط، المملكة العربية السعودية'
        ];

        for($i = 1; $i <= $count; $i++){

            foreach ($user_types as $user_type){
                $name_index = ($i - 1) % count($arabic_names[$user_type]);
                $arabic_name = $arabic_names[$user_type][$name_index];

                $user_type_arabic = [
                    'teacher' => 'مدرس',
                    'parent' => 'ولي أمر',
                    'accountant' => 'محاسب',
                    'librarian' => 'أمين مكتبة',
                    'student' => 'طالب'
                ];

                // Generate random phone number
                $phone_number = '+9665' . str_pad(rand(10000000, 99999999), 8, '0', STR_PAD_LEFT);

                // Random gender (more males for variety)
                $gender = (rand(1, 10) <= 6) ? 'Male' : 'Female';

                // Random city
                $address = $saudi_cities[array_rand($saudi_cities)];

                $data[] = [
                    'name' => $arabic_name . ' - ' . $user_type_arabic[$user_type] . ' ' . $i,
                    'email' => "{$user_type}{$i}@lavsms.com",
                    'user_type' => $user_type,
                    'username' => "{$user_type}{$i}",
                    'password' => Hash::make('123456789'),
                    'code' => strtoupper(Str::random(10)),
                    'photo' => $defaultPhoto,
                    'gender' => $gender,
                    'phone' => $phone_number,
                    'address' => $address,
                    'email_verified_at' => $now,
                    'remember_token' => Str::random(10),
                    'created_at' => $now,
                    'updated_at' => $now,
                ];

            }

        }

        DB::table('users')->insert($data);
    }

    /**
     * Fix orphaned student records by creating missing user accounts
     */
    protected function fixOrphanedStudentRecords(): void
    {
        // Get all student records that don't have corresponding user records
        $orphanedStudents = DB::table('student_records')
            ->leftJoin('users', 'student_records.user_id', '=', 'users.id')
            ->whereNull('users.id')
            ->select('student_records.*')
            ->get();

        if ($orphanedStudents->count() > 0) {
            $password = Hash::make('student'); // Default student password
            $defaultPhoto = Qs::getDefaultUserImage();
            $now = now();

            foreach ($orphanedStudents as $student) {
                // Generate unique identifiers
                $admNo = $student->adm_no ?: 'STU' . $student->id;
                $uniqueId = time() . $student->id; // Ensure uniqueness

                // Create a new user record for this student
                $userId = DB::table('users')->insertGetId([
                    'name' => 'طالب رقم ' . $admNo,
                    'email' => 'student' . $uniqueId . '@university.edu.sa',
                    'username' => 'STU' . $uniqueId,
                    'password' => $password,
                    'user_type' => 'student',
                    'code' => strtoupper(Str::random(10)),
                    'photo' => $defaultPhoto,
                    'gender' => 'Male', // Default gender
                    'phone' => '+966500000000',
                    'address' => 'عنوان غير محدد',
                    'email_verified_at' => $now,
                    'remember_token' => Str::random(10),
                    'created_at' => $now,
                    'updated_at' => $now,
                ]);

                // Update the student record with the new user_id
                DB::table('student_records')
                    ->where('id', $student->id)
                    ->update(['user_id' => $userId]);
            }

            echo "Fixed " . $orphanedStudents->count() . " orphaned student records.\n";
        }
    }
}
