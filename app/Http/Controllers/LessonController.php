<?php

namespace App\Http\Controllers;

use App\Http\Requests\LessonRequest;
use App\Models\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use function Laravel\Prompts\alert;

class LessonController extends Controller
{


    public function create()
    {
        return view('add');
    }
    public function edit()
    {
        return view('edit');
    }
    public function add_lesson(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:80',
            'text' => 'required|string',
            'words' => 'required|string|min:3',
            'foto' => 'required|image|mimes:jpg,jpeg,png,webp|max:10000',
        ]);

        // if (is_array($words) && count($words) < 1) {
        //     $validator->errors()->add('words', 'The words field must be a non-empty array.');
        // }


        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        } else {
            // Получение значений из входящего JSON-запроса
            $name = $request->input('name');
            $text = $request->input('text');
            $foto = $request->file('foto'); // Для файлов
            $words = json_encode($request->input('words')); // Парсинг JSON



            if (!$request->hasFile('foto')) {
                return back()->withInput()->withErrors(['foto' => 'No image']);
            } else if ($request->hasFile('foto')) {
                $foto = $request->file('foto');
                $filename = time() . "." . $foto->getClientOriginalExtension();
                $foto->storeAs('/public/lessons', $filename);
            };

            Lesson::create([
                'name' => $request->input('name'),
                'foto' => $filename,
                'text' => $request->input('text'),
                'modul' => 0,
                'words' => $words,
            ]);

            return response()->json(['url' => '/admin?addSuccess'], 200);
        }
    }




    public function update(Request $request, $id)
    {
        $lesson = Lesson::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:80',
            'text' => 'required|string',
            'words' => 'required|string|min:3',
            'foto' => 'required|image|mimes:jpg,jpeg,png,webp|max:10000',
        ]);


        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        } else {
            // Получение значений из входящего JSON-запроса
            $name = $request->input('name');
            $text = $request->input('text');
            $foto = $request->file('foto'); // Для файлов
            $words = json_encode($request->input('words')); // Парсинг JSON



            if (!$request->hasFile('foto')) {
                return back()->withInput()->withErrors(['foto' => 'No image']);
            } else if ($request->hasFile('foto')) {

                $foto = $request->file('foto');
                $filename = time() . "." . $foto->getClientOriginalExtension();
                $foto->storeAs('/public/lessons', $filename);

                $filePath = storage_path('app/public/lessons/' . $lesson->foto);
                if (file_exists($filePath)) {
                    unlink($filePath);
                }; 
                $lesson->update([
                    'foto' => $filename,
                ]);
            };

            $lesson->update([
                'name' => $request->input('name'),
                'text' => $request->input('text'),
                'words' => $words,
            ]);

            return response()->json(['url' => "/admin/?editSuccess"], 200);
        }
    }



    public function destroy($id)
    {
        $lesson = Lesson::findOrFail($id);
        $filePath = storage_path('app/public/lessons/' . $lesson->foto);
        if (file_exists($filePath)) {
            unlink($filePath);
        }; 
        $lesson->delete();
        return redirect(route('admin').'?deleteSuccess');
    }
}
