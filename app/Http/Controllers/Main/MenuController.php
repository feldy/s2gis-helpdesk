<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Admin\InputDataAwalPegawaiController;
use App\Http\Controllers\Admin\ProfilPegawaiController;
use App\Http\Controllers\Admin\ProsesUsulanKepegawaianController;
use App\Http\Controllers\User\DataPegawai\ProfilInformasiPegawaiController;
use App\Http\Controllers\User\DataPegawai\ProfilKeluargaController;
use App\Http\Controllers\User\DataPegawai\ProfilPendidikanController;
use App\Http\Controllers\User\DataPegawai\ProfilPribadiController;
use App\Http\Controllers\User\DataPegawai\RiwayatHukumanDisiplinController;
use App\Http\Controllers\User\DataPegawai\RiwayatJabatanController;
use App\Http\Controllers\User\DataPegawai\RiwayatPangkatController;
use App\Http\Controllers\User\DataPegawai\RiwayatPelatihanController;
use App\Http\Controllers\User\DataPegawai\RiwayatPenghargaanController;
use App\Http\Controllers\User\DataPegawai\RiwayatSKPDP3Controller;
use App\Http\Controllers\User\IssueController;
use App\Http\Controllers\User\UsulanKepegawaian\UsulanCutiPegawaiController;
use App\Http\Controllers\User\UsulanKepegawaian\UsulanKepegawaianController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MenuController extends Controller
{
    public function showIssues() {
        return IssueController::showForm();
    }

    public function showCreateIssues() {
        return IssueController::showCreateIssues();
    }

    public function showViewIssues() {
        return IssueController::showViewIssues();
    }
}
