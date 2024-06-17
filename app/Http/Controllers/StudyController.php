<?php

namespace App\Http\Controllers;

use App\Models\Kurs;
use App\Models\Lesson;
use App\Models\Study;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;


class StudyController extends Controller
{
    public function done_lesson(Request $request, $id, $id_lesson)
    {
        $kurs = Kurs::findOrFail($id);
        $lesson = Lesson::findOrFail($id_lesson);
        // dd($kurs->id);
        $id_kurs = $kurs->id;
        $user = Auth::user();
        $done_lesson = Study::where('id_user', $user->id)->where('id_lesson', $lesson->id)->where('modul', $kurs->id)->first();

        if ($done_lesson) {
            $done_lesson->update([
                'status' => 3
            ]);
        } else if (!$done_lesson) {
            Study::create([
                'id_user' => $user->id,
                'id_lesson' => $lesson->id,
                'modul' => $id_kurs,
                'status' => 3
            ]);
        };


        if ($kurs->lessons) {
            $lessons = json_decode(json_decode(($kurs->lessons)));
        }

        $currentIndex = array_search($lesson->id, $lessons);


        if ($currentIndex < (count($lessons) - 1)) {
            $nextLessonId = $lessons[$currentIndex + 1];
            return to_route('modul_lesson', ['id' => $kurs->id, 'id_lesson' => $nextLessonId]);
        } else {
            return back();
        }
    }


    public function stop_lesson(Request $request, $id, $id_lesson)
    {
        $kurs = Kurs::findOrFail($id);
        $lesson = Lesson::findOrFail($id_lesson);
        // dd($kurs->id);
        $id_kurs = $kurs->id;
        $user = Auth::user();
        $stop_lesson = Study::where('id_user', $user->id)->where('id_lesson', $lesson->id)->where('modul', $kurs->id)->first();

        if ($stop_lesson) {
            $stop_lesson->update([
                'status' => 2
            ]);
        } else if (!$stop_lesson) {
            Study::create([
                'id_user' => $user->id,
                'id_lesson' => $lesson->id,
                'modul' => $id_kurs,
                'status' => 2
            ]);
        };


        if ($kurs->lessons) {
            $lessons = json_decode(json_decode(($kurs->lessons)));
        }

        $currentIndex = array_search($lesson->id, $lessons);


        if ($currentIndex < (count($lessons) - 1)) {
            $nextLessonId = $lessons[$currentIndex + 1];
            return to_route('modul_lesson', ['id' => $kurs->id, 'id_lesson' => $nextLessonId]);
        } else {
            return back();
        }
    }


    public function delete_study(Request $request, $id)
    {
        $kurs = Kurs::findOrFail($id);
        $user = Auth::user();


        Study::where('id_user', $user->id)->where('modul', $kurs->id)->delete();

        return back();
    }

    public function create_study(Request $request, $id)
    {
        $kurs = Kurs::findOrFail($id);
        $user = Auth::user();


        $lessons = json_decode(json_decode(($kurs->lessons)));

        $create_study = Study::where('modul', $kurs->id)->where('id_user', $user->id)->get();


        if ($create_study->count() == 0) {
            Study::create([
                'id_user' => $user->id,
                'id_lesson' => $lessons[0],
                'modul' => $kurs->id,
                'status' => 1
            ]);
        };


        return to_route('modul_lesson', ['id' => $kurs->id, 'id_lesson' => $lessons[0]]);
    }
}
