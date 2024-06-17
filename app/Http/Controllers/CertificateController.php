<?php

namespace App\Http\Controllers;

use App\Models\Kurs;
use App\Models\Certificate;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Transliterator;

class CertificateController extends Controller
{

    public function generate(Request $request, $id)
    {

        $kurs = Kurs::findOrFail($id);
        $user = auth()->user();


        // Создание PDF

        $pdf = new Dompdf();
        $options = new Options();
        $options->set('isRemoteEnabled', true);
        $options->set("isHtml5ParserEnabled", true);
        $options->set("isPhpEnabled", true);
        $options->setDefaultPaperOrientation("landscape");
        $options->setDefaultPaperSize('A4');

        $pdf->setOptions($options);
        $html = view('certificate', ['id' => $id])->render(); 

        $pdf->loadHtml($html);

        // Создаем уникальное имя файла
        $fileName = $this->generateUniqueFileName($user, $kurs);



        // Рендеринг и скачивание PDF
        $pdf->render();
        $output = $pdf->output();
        file_put_contents(public_path('storage/certificates/certificate.pdf'), $output); // Сохраняем PDF

        // Проверяем, есть ли уже сертификат для этого пользователя
        if (Storage::disk('public')->exists('certificates/' . $fileName . '.pdf')) {
            Storage::disk('public')->delete('certificates/' . $fileName . '.pdf'); // Удаляем старый сертификат
        }

        // Сохраняем PDF с уникальным именем
        Storage::disk('public')->put('certificates/' . $fileName . '.pdf', $output);



        $certificate_user = Certificate::where('id_user', $user->id)->where('modul', $kurs->id)->first();

        if ($certificate_user) {
            $certificate_user->update([
                'certificate' => $fileName . '.pdf'
            ]);
        } else if (!$certificate_user) {
            Certificate::create([
                'id_user' => $user->id,
                'modul' => $kurs->id,
                'certificate' => $fileName . '.pdf'
            ]);
        };


        $path = storage_path('app/public/certificates/' . $fileName . '.pdf');

        return response()->download($path)->deleteFileAfterSend(false);
    }




    private function generateUniqueFileName($user, $kurs)
    {
        return "$user->surname" . "_" . "$kurs->name";
    }
}
