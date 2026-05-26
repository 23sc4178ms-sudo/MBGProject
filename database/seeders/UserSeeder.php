<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserAccount;
use App\Models\Degree;
use App\Models\Student;
use App\Models\Course;
use App\Models\Profile;
use App\Models\Post;
use App\Models\CourseEnrollment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed Degrees if not existing
        $it = Degree::firstOrCreate(['Degree' => 'BS Information Technology']);
        $cs = Degree::firstOrCreate(['Degree' => 'BS Computer Science']);
        $is = Degree::firstOrCreate(['Degree' => 'BS Information System']);

        // Seed Students based on your list
        $student1 = Student::firstOrCreate(
            ['email' => 'john.reyes@example.com'],
            ['name' => 'John Carlo', 'lname' => 'Reyes', 'contact' => '09123456789', 'degree_id' => $it->id]
        );
        $student2 = Student::firstOrCreate(
            ['email' => 'mia.santos@example.com'],
            ['name' => 'Mia Shiela', 'lname' => 'Santos', 'contact' => '09987654321', 'degree_id' => $cs->id]
        );
        $student3 = Student::firstOrCreate(
            ['email' => 'maricar.delacruz@example.com'],
            ['name' => 'Maricar', 'lname' => 'Dela Cruz', 'contact' => '09112223334', 'degree_id' => $is->id]
        );

        // Seed Users for Profiles and Posts
        $user1 = User::firstOrCreate(
            ['email' => 'admin@psu.edu.ph'],
            ['name' => 'Admin User', 'username' => 'admin', 'role' => 'admin', 'password' => Hash::make('admin123')]
        );
        $user2 = User::firstOrCreate(
            ['email' => 'instructor@psu.edu.ph'],
            ['name' => 'Instructor Maria', 'username' => 'teacher', 'role' => 'teacher', 'password' => Hash::make('teacher123')]
        );

        // Seed UserAccounts for Students
        $account1 = UserAccount::firstOrCreate(
            ['email' => 'john.reyes@example.com'],
            ['username' => 'john.reyes', 'password' => Hash::make('student123'), 'role' => 'student', 'is_active' => 1, 'password_changed_at' => now()]
        );
        $account2 = UserAccount::firstOrCreate(
            ['email' => 'mia.santos@example.com'],
            ['username' => 'mia.santos', 'password' => Hash::make('student123'), 'role' => 'student', 'is_active' => 1, 'password_changed_at' => now()]
        );
        $account3 = UserAccount::firstOrCreate(
            ['email' => 'maricar.delacruz@example.com'],
            ['username' => 'maricar.delacruz', 'password' => Hash::make('student123'), 'role' => 'student', 'is_active' => 1, 'password_changed_at' => now()]
        );

        // Link user accounts to students
        $student1->update(['user_account_id' => $account1->id]);
        $student2->update(['user_account_id' => $account2->id]);
        $student3->update(['user_account_id' => $account3->id]);

        // Seed Profiles
        Profile::firstOrCreate(['user_id' => $user1->id], ['bio' => 'I am the system administrator for the Student Dashboard.']);
        Profile::firstOrCreate(['user_id' => $user2->id], ['bio' => 'Computer Science instructor with 10 years experience.']);

        // Seed Courses
        $course1 = Course::firstOrCreate(['course_name' => 'Web Development'], ['description' => 'Learn HTML, CSS, JS and PHP Laravel.']);
        $course2 = Course::firstOrCreate(['course_name' => 'Database Management'], ['description' => 'Master SQL and Database Design.']);
        $course3 = Course::firstOrCreate(['course_name' => 'Mobile App Development'], ['description' => 'Create apps for Android and iOS.']);

        // Seed Enrollments (Connecting Students to Courses)
        CourseEnrollment::firstOrCreate(
            ['student_id' => $student1->id, 'course_id' => $course1->id],
            ['enrollment_date' => now()]
        );
        CourseEnrollment::firstOrCreate(
            ['student_id' => $student2->id, 'course_id' => $course1->id],
            ['enrollment_date' => now()]
        );
        CourseEnrollment::firstOrCreate(
            ['student_id' => $student2->id, 'course_id' => $course2->id],
            ['enrollment_date' => now()]
        );
        CourseEnrollment::firstOrCreate(
            ['student_id' => $student3->id, 'course_id' => $course3->id],
            ['enrollment_date' => now()]
        );

        // Seed Posts
        Post::firstOrCreate(
            ['title' => 'Welcome to PSU Portal'],
            ['content' => 'We are glad to have you here. This is our new student management system.', 'user_id' => $user1->id]
        );
        Post::firstOrCreate(
            ['title' => 'New Course Update'],
            ['content' => 'The mobile app development course is now open for enrollment.', 'user_id' => $user2->id]
        );
    }
}
