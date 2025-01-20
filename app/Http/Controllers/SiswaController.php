<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use BaconQrCode\Writer;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\Image\SvgImageBackEnd;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function bulkPrint(Request $request)
    {
        $studentIds = $request->input('student_ids');
        $students = Siswa::whereIn('id', $studentIds)->get();

        // Generate QR codes for each student
        $qrCodes = [];
        foreach ($students as $student) {
            $renderer = new ImageRenderer(
                new RendererStyle(200),
                new SvgImageBackEnd()
            );
            $writer = new Writer($renderer);
            $qrCodes[$student->id] = $writer->writeString($student->nis);
        }

        return view('siswa.bulk-print', compact('students', 'qrCodes'));
    }
}
