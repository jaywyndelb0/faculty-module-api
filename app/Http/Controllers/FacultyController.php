<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class FacultyController extends Controller
{
    public function index()
    {
        $faculty = DB::table('faculty')->get();

        return response()->json([
            'status' => 200,
            'message' => 'Faculty list retrieved successfully',
            'data' => $faculty
        ], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'department' => 'required|string|max:100',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $id = DB::table('faculty')->insertGetId([
            'name' => $request->name,
            'email' => $request->email,
            'department' => $request->department,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return response()->json([
            'status' => 201,
            'message' => 'Faculty created successfully',
            'data' => ['id' => $id, 'name' => $request->name]
        ], 201);
    }

    public function getSectionFaculty($id)
    {
        $section = DB::table('sections')
            ->leftJoin('faculty', 'sections.faculty_id', '=', 'faculty.id')
            ->where('sections.id', $id)
            ->select('sections.id as section_id', 'sections.section_name', 'faculty.id as faculty_id', 'faculty.name as faculty_name')
            ->first();

        if (!$section) {
            return response()->json(['status' => 404, 'message' => 'Section not found'], 404);
        }

        return response()->json([
            'status' => 200,
            'message' => 'Section assignment details retrieved successfully',
            'data' => $section
        ], 200);
    }

    public function assignToSection(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'faculty_id' => 'required|integer|exists:faculty,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $affected = DB::table('sections')
            ->where('id', $id)
            ->update(['faculty_id' => $request->faculty_id, 'updated_at' => now()]);

        if ($affected === 0) {
            return response()->json(['status' => 404, 'message' => 'Section not found'], 404);
        }

        return response()->json([
            'status' => 200,
            'message' => 'Faculty assigned to section successfully'
        ], 200);
    }

    public function getClasslist($id)
    {
        $section = DB::table('sections')->where('id', $id)->first();

        if (!$section) {
            return response()->json(['status' => 404, 'message' => 'Section not found'], 404);
        }

        $students = DB::table('students')->where('section_id', $id)->get(['id', 'name']);

        return response()->json([
            'status' => 200,
            'message' => 'Class list retrieved successfully',
            'data' => [
                'section_name' => $section->section_name,
                'students' => $students
            ]
        ], 200);
    }

    public function indexGrades()
    {
        $grades = DB::table('grades')
            ->join('students', 'grades.student_id', '=', 'students.id')
            ->select('grades.id', 'students.name as student_name', 'grades.subject', 'grades.grade', 'grades.created_at')
            ->get();

        return response()->json([
            'status' => 200,
            'message' => 'All grades retrieved successfully',
            'data' => $grades
        ], 200);
    }

    public function uploadGrade(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'student_id' => 'required|integer|exists:students,id',
            'subject' => 'required|string|max:100',
            'grade' => 'required|string|max:5',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $id = DB::table('grades')->insertGetId([
            'student_id' => $request->student_id,
            'subject' => $request->subject,
            'grade' => $request->grade,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return response()->json([
            'status' => 201,
            'message' => 'Grade uploaded successfully',
            'data' => ['id' => $id]
        ], 201);
    }

    public function getStudentGrades($studentId)
    {
        $student = DB::table('students')->where('id', $studentId)->first();

        if (!$student) {
            return response()->json(['status' => 404, 'message' => 'Student not found'], 404);
        }

        $grades = DB::table('grades')->where('student_id', $studentId)->get(['id', 'subject', 'grade']);

        return response()->json([
            'status' => 200,
            'message' => 'Grades retrieved successfully',
            'data' => [
                'student_name' => $student->name,
                'grades' => $grades
            ]
        ], 200);
    }

    public function recordAttendance(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'student_id' => 'required|integer|exists:students,id',
            'date' => 'required|date',
            'status' => 'required|string|max:20',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $id = DB::table('attendance')->insertGetId([
            'student_id' => $request->student_id,
            'date' => $request->date,
            'status' => $request->status,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return response()->json([
            'status' => 201,
            'message' => 'Attendance recorded successfully',
            'data' => ['id' => $id]
        ], 201);
    }

    public function getAttendance($studentId)
    {
        $student = DB::table('students')->where('id', $studentId)->first();

        if (!$student) {
            return response()->json(['status' => 404, 'message' => 'Student not found'], 404);
        }

        $attendance = DB::table('attendance')->where('student_id', $studentId)->orderBy('date', 'desc')->get();

        return response()->json([
            'status' => 200,
            'message' => 'Attendance retrieved successfully',
            'data' => [
                'student_name' => $student->name,
                'attendance' => $attendance
            ]
        ], 200);
    }
}
