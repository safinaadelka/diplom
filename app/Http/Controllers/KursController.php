<?php

namespace App\Http\Controllers;

use App\Http\Requests\KursRequest;
use App\Models\Kurs;
use App\Models\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KursController extends Controller
{
    public function create()
    {
        return view('add_kurs');
    }

    public function add_kurs(KursRequest $request)
    {

        $kurs = Kurs::create(
            [
                'name' => $request['name'],
                'descript' => $request['descript'],
                'lessons' => json_encode($request->input('lessons')),
                'status' => 0,
            ]
        );

        $lessons = json_decode(json_decode(($kurs->lessons)));
        if ($lessons) {
            $kurs_lessons = Lesson::whereIn('id', $lessons)->get()->sortBy(function ($item) use ($lessons) {
                return array_search($item->id, $lessons);
            });


            foreach ($kurs_lessons as $kurs_lesson) {
                Lesson::findOrFail($kurs_lesson->id)->update(['modul' => $kurs->id]);
            }

            return redirect(route('admin'). '?addSuccess');
        }
    }



    public function edit_kurs(KursRequest $request, $id)
    {
        $kurs = Kurs::findOrFail($id);


        $lessons = json_decode(json_decode(($kurs->lessons)));
        if ($lessons) {
            $kurs_lessons = Lesson::whereIn('id', $lessons)->get()->sortBy(function ($item) use ($lessons) {
                return array_search($item->id, $lessons);
            });


            foreach ($kurs_lessons as $kurs_lesson) {
                Lesson::findOrFail($kurs_lesson->id)->update(['modul' => 0]);
            }
        }


        $kurs->update(
            [
                'name' => $request['name'],
                'descript' => $request['descript'],
                'lessons' => json_encode($request->input('lessons')),
            ]
        );



        $lessons = json_decode(json_decode(($kurs->lessons)));
        if ($lessons) {
            $kurs_lessons = Lesson::whereIn('id', $lessons)->get()->sortBy(function ($item) use ($lessons) {
                return array_search($item->id, $lessons);
            });


            foreach ($kurs_lessons as $kurs_lesson) {
                Lesson::findOrFail($kurs_lesson->id)->update(['modul' => $kurs->id]);
            }
        };
        return redirect(route('admin') . '?editSuccess');
    }


    public function hide_kurs(Request $request, $id)
    {
        $kurs = Kurs::findOrFail($id);

        $kurs->update(
            [
                'status' => 0
            ]
        );

        return redirect(route('admin'));
    }


    public function publish_kurs(Request $request, $id)
    {
        $kurs = Kurs::findOrFail($id);

        $kurs->update(
            [
                'status' => 1
            ]
        );

        return redirect(route('admin'));
    }
}
