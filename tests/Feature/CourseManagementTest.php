<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Course;
use App\Models\CourseEnrollment;
use App\Models\User;
use App\Models\MyClass;
use App\Models\StudentRecord;

class CourseManagementTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected $admin;
    protected $myClass;

    protected function setUp(): void
    {
        parent::setUp();
        
        // Create admin user
        $this->admin = User::factory()->create([
            'user_type' => 'super_admin',
            'name' => 'Test Admin',
            'email' => 'admin@test.com'
        ]);

        // Create a class
        $this->myClass = MyClass::factory()->create([
            'name' => 'Computer Science',
            'class_type_id' => 1
        ]);
    }

    /** @test */
    public function admin_can_view_courses_index()
    {
        $response = $this->actingAs($this->admin)
                         ->get(route('courses.index'));

        $response->assertStatus(200);
        $response->assertViewIs('pages.support_team.courses.index');
    }

    /** @test */
    public function admin_can_create_course()
    {
        $courseData = [
            'name' => 'Introduction to Programming',
            'code' => 'CS101',
            'description' => 'Basic programming concepts',
            'credit_hours' => 3,
            'my_class_id' => $this->myClass->id,
            'semester' => 'first',
            'academic_year' => '2023-2024',
            'status' => 'active'
        ];

        $response = $this->actingAs($this->admin)
                         ->post(route('courses.store'), $courseData);

        $response->assertRedirect(route('courses.index'));
        $this->assertDatabaseHas('courses', [
            'name' => 'Introduction to Programming',
            'code' => 'CS101'
        ]);
    }

    /** @test */
    public function admin_can_view_course_details()
    {
        $course = Course::factory()->create([
            'my_class_id' => $this->myClass->id
        ]);

        $response = $this->actingAs($this->admin)
                         ->get(route('courses.show', $course->id));

        $response->assertStatus(200);
        $response->assertViewIs('pages.support_team.courses.show');
        $response->assertViewHas('course', $course);
    }

    /** @test */
    public function admin_can_update_course()
    {
        $course = Course::factory()->create([
            'my_class_id' => $this->myClass->id,
            'name' => 'Old Course Name'
        ]);

        $updateData = [
            'name' => 'Updated Course Name',
            'code' => $course->code,
            'credit_hours' => 4,
            'my_class_id' => $this->myClass->id,
            'semester' => 'second',
            'academic_year' => '2023-2024',
            'status' => 'active'
        ];

        $response = $this->actingAs($this->admin)
                         ->put(route('courses.update', $course->id), $updateData);

        $response->assertRedirect(route('courses.index'));
        $this->assertDatabaseHas('courses', [
            'id' => $course->id,
            'name' => 'Updated Course Name',
            'credit_hours' => 4
        ]);
    }

    /** @test */
    public function course_code_must_be_unique()
    {
        Course::factory()->create([
            'code' => 'CS101',
            'my_class_id' => $this->myClass->id
        ]);

        $courseData = [
            'name' => 'Another Course',
            'code' => 'CS101', // Duplicate code
            'credit_hours' => 3,
            'my_class_id' => $this->myClass->id,
            'semester' => 'first',
            'academic_year' => '2023-2024',
            'status' => 'active'
        ];

        $response = $this->actingAs($this->admin)
                         ->post(route('courses.store'), $courseData);

        $response->assertSessionHasErrors('code');
    }

    /** @test */
    public function admin_can_view_course_enrollments()
    {
        $course = Course::factory()->create([
            'my_class_id' => $this->myClass->id
        ]);

        $response = $this->actingAs($this->admin)
                         ->get(route('courses.enrollments', $course->id));

        $response->assertStatus(200);
        $response->assertViewIs('pages.support_team.courses.enrollments');
        $response->assertViewHas('course', $course);
    }

    /** @test */
    public function course_filters_work_correctly()
    {
        $course1 = Course::factory()->create([
            'my_class_id' => $this->myClass->id,
            'semester' => 'first',
            'status' => 'active'
        ]);

        $course2 = Course::factory()->create([
            'my_class_id' => $this->myClass->id,
            'semester' => 'second',
            'status' => 'inactive'
        ]);

        // Test class filter
        $response = $this->actingAs($this->admin)
                         ->get(route('courses.index', ['class_id' => $this->myClass->id]));
        
        $response->assertStatus(200);

        // Test semester filter
        $response = $this->actingAs($this->admin)
                         ->get(route('courses.index', ['semester' => 'first']));
        
        $response->assertStatus(200);

        // Test status filter
        $response = $this->actingAs($this->admin)
                         ->get(route('courses.index', ['status' => 'active']));
        
        $response->assertStatus(200);
    }
}
