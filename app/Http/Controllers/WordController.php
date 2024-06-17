<?php

namespace App\Http\Controllers;

use App\Http\Requests\WordRequest;
use App\Models\Word;
use App\Models\Dictionary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class WordController extends Controller
{
    public function create(WordRequest $request)
    {
        Word::create(
            [
                'original' => $request['original'],
                'translate' => $request['translate'],
            ]
        );
        
        return redirect(route('admin') . '?addSuccess');
    }

    public function createAjax(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'original' => 'required|string|max:50',
            'translate' => 'required|string|max:50',
        ]);



        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        } else {
            // Получение значений из входящего JSON-запроса
            $original = $request->input('original');
            $translate = $request->input('translate');

            $word = Word::create([
                'original' => $original,
                'translate' => $translate,
            ]);
            return response()->json($word);
        }
    }

    public function update(WordRequest $request, $id)
    {
        $word = Word::findOrFail($id);
        $word->update([
            'original' => $request['original'],
            'translate' => $request['translate'],
        ]);
        return redirect(route('admin') . '?editSuccess');
    }
    public function destroy($id)
    {
        $word = Word::findOrFail($id);
        $word->delete();
        return redirect(route('admin') . '?deleteSuccess');
    }


    public function save_dictionary(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|int',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        } else {
            $id_word = $request['id'];
            $word = Word::find($id_word);
            if ($word) {
                $userId = Auth::user()->id;
                $dictionary = Dictionary::where('id_word', $word->id)->where('id_user', $userId)->first();
                if (!$dictionary) {
                    Dictionary::create([
                        'id_user' => Auth::user()->id,
                        'id_word' => $word->id,
                        'status' => 1,
                    ]);
                }
            };
        }
    }

    public function delete_dictionary(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|int',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        } else {
            $id_word = $request['id'];
            $word = Word::find($id_word);
            if ($word) {
                $userId = Auth::user()->id;
                $dictionary = Dictionary::where('id_word', $word->id)->where('id_user', $userId)->first();
                if ($dictionary) {
                    $dictionary->delete();
                }
            };
        }
    }

    public function learn_dictionary(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|int',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        } else {
            $id_word = $request['id'];
            $word = Word::find($id_word);
            if ($word) {
                $userId = Auth::user()->id;
                $dictionary = Dictionary::where('id_word', $word->id)->where('id_user', $userId)->first();
                if ($dictionary) {
                    $dictionary->update([
                        'status' => 2, 
                    ]); 
                    return response()->json(200);
                }; 
            };
        }
    }

    public function forget_dictionary(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|int',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        } else {
            $id_word = $request['id'];
            $word = Word::find($id_word);
            if ($word) {
                $userId = Auth::user()->id;
                $dictionary = Dictionary::where('id_word', $word->id)->where('id_user', $userId)->first();
                if ($dictionary) {
                    $dictionary->update([
                        'status' => 0, 
                    ]); 
                    return response()->json(200);
                }; 
            };
        }
    }
}
