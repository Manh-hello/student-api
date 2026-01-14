<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    // GET /api/students - Lấy danh sách tất cả sinh viên
    public function index()
    {
        $students = Student::all();
        return response()->json($students);
    }

    // POST /api/students - Tạo sinh viên mới
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email',
            'phone' => 'required|string|max:20',
            'major' => 'required|string|max:255',
            'year' => 'required|integer|min:2000|max:2030'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 400);
        }

        $student = Student::create($request->all());

        return response()->json([
            'message' => 'Tạo sinh viên thành công',
            'data' => $student
        ], 201);
    }

    // GET /api/students/{id} - Lấy chi tiết 1 sinh viên
    public function show($id)
    {
        $student = Student::find($id);

        if (!$student) {
            return response()->json([
                'message' => 'Không tìm thấy sinh viên'
            ], 404);
        }

        return response()->json($student);
    }

    // PUT/PATCH /api/students/{id} - Cập nhật sinh viên
    public function update(Request $request, $id)
    {
        $student = Student::find($id);

        if (!$student) {
            return response()->json([
                'message' => 'Không tìm thấy sinh viên'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|email|unique:students,email,' . $id,
            'phone' => 'sometimes|required|string|max:20',
            'major' => 'sometimes|required|string|max:255',
            'year' => 'sometimes|required|integer|min:2000|max:2030'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 400);
        }

        $student->update($request->all());

        return response()->json([
            'message' => 'Cập nhật sinh viên thành công',
            'data' => $student
        ]);
    }

    // DELETE /api/students/{id} - Xóa sinh viên
    public function destroy($id)
    {
        $student = Student::find($id);

        if (!$student) {
            return response()->json([
                'message' => 'Không tìm thấy sinh viên'
            ], 404);
        }

        $student->delete();

        return response()->json([
            'message' => 'Xóa sinh viên thành công'
        ]);
    }
}
