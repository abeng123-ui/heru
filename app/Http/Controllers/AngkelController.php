<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Form;
use Illuminate\Support\Facades\Redirect;
use DB;
use Hash;
use Response;
use Session;
use App\Models\Angkel;
use App\Models\Penduduk;
use App\Models\Desa;
use App\Models\KK;
use DOMDocument;
use Illuminate\Support\Facades\Storage;
use PDF;

class AngkelController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function index($no_kk)
    {
        $data = Angkel::with('penduduk.data_agama')->where('no_kk', $no_kk)->get();

        return view('angkel.index', compact('data', 'no_kk'));
    }

    public function individu($nik)
    {
        $data = Penduduk::with('data_agama', 'angkel.kk')->where('nik', $nik)->first();

        return view('angkel.individu', compact('data'));
    }

    public function download_kk($no_kk)
    {
        // EXPORT PDF
        $desa = Desa::orderBy('id', 'desc')->first();

        $angkel = Angkel::with('penduduk.data_agama')->where('no_kk', $no_kk)->get();
        $kk = Kk::where('no_kk', $no_kk)->first();

        $data['desa'] = $desa;
        $data['angkel'] = $angkel;
        $data['kk'] = $kk;

        $fileName = "KK_".$kk->no_kk."_". round(microtime(true) * 1000) . uniqid() . '.pdf';

        view()->share('kk',$data);
        $pdf = PDF::loadView('angkel.template_pdf', $data)->setPaper('a3', 'landscape');

        return $pdf->download($fileName);
    }

    // public static function preparedDataExportTemplate($angkel, $kk, $desa)
    // {
    //     \Log::Info("1");
    //     $callback = [];
    //     $mpdf = new Mpdf([
    //         'mode'          => 'utf-8',
    //         'format'        => 'A4',
    //         'margin_left'   => 0,
    //         'margin_top'    => 5,
    //         'margin_right'  => 5,
    //         'margin_bottom' => 5,
    //         'margin_header' => 0,
    //         'margin_footer' => 0,
    //         'tempDir'       => storage_path('/app/tmp')
    //     ]);

    //     \Log::Info("2");
    //     $fileName = "KK_".$kk->no_kk."_". round(microtime(true) * 1000) . uniqid() . '.pdf';
    //     //$fileName = "Tes.pdf";

    //     $mpdf->SetDisplayMode('fullpage');
    //     $mpdf->list_indent_first_level = 0;

    //     \Log::Info("3");
    //     $modifiedDocument = self::putDataToTemplateExportPDF($angkel, $kk, $desa);
    //     $mpdf->writeHTML($modifiedDocument);

    //     Storage::disk('local')->put('tmp/' . $fileName, $mpdf->Output('_kk.pdf', Destination::STRING_RETURN));
    //     $callback =
    //         [
    //             'name'     => $fileName,
    //             'filePath' => storage_path('app/tmp/' . $fileName)
    //         ];

    //     return $callback;
    // }

    // public static function putDataToTemplateExportPDF($angkel, $kk, $desa)
    // {
    //     \Log::Info("4");

    //     $file_path_template = base_path('/templates/kartukeluarga.html');
    //     $content    = file_get_contents($file_path_template);

    //     $document   = new \DOMDocument();

    //     libxml_use_internal_errors(true);
    //     $document->loadHTML($content);
    //     libxml_clear_errors();

    //     // NO KK
    //     $nokkDom   = $document->getElementById('kk_no');
    //     $nokkDom->nodeValue = isset($kk->no_kk) ? 'No. '.$kk->no_kk : 'No. ';

    //     // NAMA KKEL
    //     $namaKkelDom   = $document->getElementById('kk_nama_kkel');
    //     $namaKkelDom->nodeValue = isset($kk->nama_kepala_keluarga) ? ': '.$kk->nama_kepala_keluarga : '-';

    //     // NAMA KECAMATAN
    //     $kecamatanDom   = $document->getElementById('kk_kecamatan');
    //     $kecamatanDom->nodeValue = isset($desa->kecamatan) ? ': '.$desa->kecamatan : '-';

    //     // NAMA KABUPATEN
    //     $kabupatenDom   = $document->getElementById('kk_kabupaten');
    //     $kabupatenDom->nodeValue = isset($desa->kabupaten) ? ': '.$desa->kabupaten : '-';

    //     // NAMA ALAMAT
    //     $alamatDom   = $document->getElementById('kk_alamat_kkel');
    //     $alamatDom->nodeValue = isset($kk->alamat_kkel) ? ': '.$kk->alamat_kkel : '-';

    //     // NAMA ALAMAT
    //     $alamatDom   = $document->getElementById('kk_rtrw');
    //     $alamatDom->nodeValue = isset($kk->rt) ? ': '.$kk->rt.'/'.$kk->rw : '-';

    //     // KODEPOS
    //     $kodeposDom   = $document->getElementById('kk_kodepos');
    //     $kodeposDom->nodeValue = isset($kk->kodepos) ? ': '.$kk->kodepos : '-';

    //     // DESA
    //     $desaDom   = $document->getElementById('kk_desa');
    //     $desaDom->nodeValue = isset($desa->desa) ? ': '.$desa->desa : '-';

    //     // PROVINSI
    //     $provinsiDom   = $document->getElementById('kk_provinsi');
    //     $provinsiDom->nodeValue = isset($desa->provinsi) ? ': '.$desa->provinsi : '-';

    //     // CONTENT
    //     $strContent = '<br><table style="width:100%" id="tb_ini" border="1">
    //           <tr align="center">
    //             <td>No</td>
    //             <td>Nama Lengkap</td>
    //             <td>NIK</td>
    //             <td>Jenis Kelamin</td>
    //             <td>Tempat Lahir</td>
    //             <td>Tanggal Lahir</td>
    //             <td>Agama</td>
    //             <td>Pendidikan</td>
    //             <td>Jenis Pekerjaan</td>
    //           </tr>
    //           <tr align="center">
    //             <td height="20"></td>
    //             <td>(1)</td>
    //             <td>(2)</td>
    //             <td>(3)</td>
    //             <td>(4)</td>
    //             <td>(5)</td>
    //             <td>(6)</td>
    //             <td>(7)</td>
    //             <td>(8)</td>
    //           </tr>';

    //     $no = 1;
    //     foreach ($angkel as $row) {
    //         $strContent = $strContent.'<tr>
    //             <td>'.$no.'</td>
    //             <td>'.$row->penduduk->nama_lengkap.'</td>
    //             <td>'.$row->penduduk->nik.'</td>
    //             <td>'.$row->penduduk->jk.'</td>
    //             <td>'.$row->penduduk->tmp_lahir.'</td>
    //             <td>'.$row->penduduk->tgl_lahir.'</td>
    //             <td>'.$row->penduduk->data_agama->agama.'</td>
    //             <td>'.$row->penduduk->pendidikan_terakhir.'</td>
    //             <td>'.$row->penduduk->klmp_pekerjaan.'</td>
    //           </tr>';

    //         $no++;
    //     }

    //     $strContent = $strContent."</table>";

    //     $contentDom = $document->getElementById('kk_content');
    //     self::appendHTML($contentDom, $strContent);

    //     // FOOTER
    //     $strFooter = '<br><table style="width:100%" id="tb_ini2" border="1">
    //           <tr align="center">
    //             <td>No</td>
    //             <td>Status Pernikahan</td>
    //             <td>Status Hubungan Dalam Keluarga</td>
    //             <td>Kewarganegaraan</td>
    //           </tr>
    //           <tr align="center">
    //             <td></td>
    //             <td>(9)</td>
    //             <td>(10)</td>
    //             <td>(11)</td>
    //           </tr>';

    //     $no = 1;
    //     foreach ($angkel as $row) {
    //         if(isset($row->penduduk->status_perkawinan) && $row->penduduk->status_perkawinan == 'kawin'){
    //             $status_kawin = 'Kawin';
    //         }else{
    //             $status_kawin = 'Belum Kawin';
    //         }

    //         $strFooter = $strFooter."<tr>
    //             <td>".$no."</td>
    //             <td>".$status_kawin."</td>
    //             <td>".$row->penduduk->status_hubungan_keluarga."</td>
    //             <td>".$row->penduduk->kewarganegaraan."</td>
    //           </tr>";

    //         $no++;
    //     }

    //     $strFooter = $strFooter."</table><br>";
    //     \Log::Info("str content ".$strContent);
    //     \Log::Info("str Footer ".$strFooter);
    //     $footerDom = $document->getElementById('kk_footer');
    //     self::appendHTML($footerDom, $strFooter);
    //     \Log::Info("5");
    //     return $document->saveHTML();
    // }

    // public static function appendHTML($parent, $source) {
    //     \Log::Info("111");
    //     $tmpDoc = new \DOMDocument();
    //     $tmpDoc->loadHTML($source);
    //     \Log::Info("222");
    //     foreach ($tmpDoc->getElementsByTagName('body')->item(0)->childNodes as $node) {
    //         $node = $parent->ownerDocument->importNode($node, true);
    //         $parent->appendChild($node);
    //     }
    //     \Log::Info("333");
    // }

}
