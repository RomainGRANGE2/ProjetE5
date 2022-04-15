<?php

namespace App\Http\Controllers;

use App\dao\ServiceFormulation;
use App\dao\ServiceMedicament;
use App\dao\ServicePresentation;
use App\dao\ServicePrescription;
use Illuminate\Support\Facades\Input;
use Request;
Use App\Exceptions\MonException;
use Illuminate\Support\Facades\Session;
use Exception;

class PrescriptionController
{
    public function getPrescription($id_medicament){
        if (Session::get('id') > 0) {
            try {
                $erreur = Session::get('erreur');
                Session::forget('erreur');
                $unServicePrescription = new ServicePrescription();
                $unServiceMedicament = new ServiceMedicament();
                $mesPrescriptions = $unServicePrescription->getLesPrescriptions($id_medicament);
                $leMedicament = $unServiceMedicament->getleMedoc($id_medicament);
                return view('vues.listePrescription', compact('mesPrescriptions','leMedicament','erreur'));
            } catch (MonException $e) {
                $erreur = $e->getMessage();
                return view('vues/pageErreur', compact('erreur'));
            } catch (\Exception $e) {
                $erreur = $e->getMessage();
                return view('vues/pageErreur', compact('erreur'));
            }
        }
        else {
            $erreur = "Vous n'êtes pas authentifié";
            return view('vues/formLogin', compact('erreur'));
        }
    }

    public function ajoutPrescription($id_medicament){
        if (Session::get('id') > 0) {
            try {
                $erreur = Session::get('erreur');
                Session::forget('erreur');
                $unServiceMedicament = new ServiceMedicament();
                $unServicePrescription = new ServicePrescription();
                $leMedicament = $unServiceMedicament->getleMedoc($id_medicament);
                $mesDosages = $unServicePrescription->getLesDosages();
                $mesIndividus = $unServicePrescription->getLesIndividus();
                return view('vues.formPrescription', compact('mesIndividus','mesDosages','leMedicament','erreur'));
            } catch (MonException $e) {
                $erreur = $e->getMessage();
                return view('vues/pageErreur', compact('erreur'));
            } catch (\Exception $e) {
                $erreur = $e->getMessage();
                return view('vues/pageErreur', compact('erreur'));
            }
        }
        else {
            $erreur = "Vous n'êtes pas authentifié";
            return view('vues/formLogin', compact('erreur'));
        }
    }

    public function ajouterLaPrescription(){
        if (Session::get('id') > 0) {
            try {
                $erreur = Session::get('erreur');
                Session::forget('erreur');
                $id_dosage = Request::input('id_dosage');
                $id_medicament = Request::input('id_medicament');
                $id_type_individu = Request::input('id_type_individu');
                $posologie = Request::input('posologie');
                $unServiceMedicament = new ServiceMedicament();
                $unServicePrescription = new ServicePrescription();
                $ajouterlaPrescription = $unServicePrescription->ajouterLaPrescription($id_dosage,$id_medicament,$id_type_individu,$posologie);
                $mesPrescriptions = $unServicePrescription->getLesPrescriptions($id_medicament);
                $leMedicament = $unServiceMedicament->getleMedoc($id_medicament);
                return view('vues.listePrescription', compact('leMedicament','mesPrescriptions','erreur'));
            } catch (MonException $e) {
                $erreur = $e->getMessage();
                return view('vues/pageErreur', compact('erreur'));
            } catch (\Exception $e) {
                $erreur = $e->getMessage();
                return view('vues/pageErreur', compact('erreur'));
            }
        }
        else {
            $erreur = "Vous n'êtes pas authentifié";
            return view('vues/formLogin', compact('erreur'));
        }
    }

    public function supprimerPrescription($id_medicament,$id_dosage,$id_type_individu){
        if (Session::get('id') > 0) {
            try {
                $erreur = Session::get('erreur');
                Session::forget('erreur');
                $unServicePrescription = new ServicePrescription();
                $unServiceMedicament = new ServiceMedicament();
                $suppPrescription = $unServicePrescription->suppPrescription($id_medicament,$id_dosage,$id_type_individu);
                $mesPrescriptions = $unServicePrescription->getLesPrescriptions($id_medicament);
                $leMedicament = $unServiceMedicament->getleMedoc($id_medicament);
                return view('vues.listePrescription', compact('leMedicament','mesPrescriptions','erreur'));
            } catch (MonException $e) {
                $erreur = $e->getMessage();
                return view('vues/pageErreur', compact('erreur'));
            } catch (\Exception $e) {
                $erreur = $e->getMessage();
                return view('vues/pageErreur', compact('erreur'));
            }
        }
        else {
            $erreur = "Vous n'êtes pas authentifié";
            return view('vues/formLogin', compact('erreur'));
        }
    }

    public function modifPrescription($id_medicament,$id_dosage,$id_type_individu){
        if (Session::get('id') > 0) {
            try {
                $erreur = Session::get('erreur');
                Session::forget('erreur');
                $unServiceMedicament = new ServiceMedicament();
                $unServicePrescription = new ServicePrescription();
                $mesPrescriptions = $unServicePrescription->getLesPrescriptions($id_medicament);
                $laPrescription = $unServicePrescription->getLaPrescription($id_medicament,$id_dosage,$id_type_individu);
                $leMedicament = $unServiceMedicament->getleMedoc($id_medicament);
                $leDosage = $unServicePrescription->getLeDosage($id_dosage);
                $leIndividu = $unServicePrescription->getLeIndividu($id_type_individu);
                $mesDosages = $unServicePrescription->getLesDosages();
                $mesIndividus = $unServicePrescription->getLesIndividus();
                return view('vues.formPrescription', compact('laPrescription','leMedicament','mesDosages','mesIndividus','leDosage','leIndividu','mesPrescriptions','erreur'));
            } catch (MonException $e) {
                $erreur = $e->getMessage();
                return view('vues/pageErreur', compact('erreur'));
            } catch (\Exception $e) {
                $erreur = $e->getMessage();
                return view('vues/pageErreur', compact('erreur'));
            }
        }
        else {
            $erreur = "Vous n'êtes pas authentifié";
            return view('vues/formLogin', compact('erreur'));
        }
    }

    public function modifierLaPrescription(){
        if (Session::get('id') > 0) {
            try {
                $erreur = Session::get('erreur');
                Session::forget('erreur');
                $id_medicament = Request::input('id_medicament');
                $new_id_dosage = Request::input('new_id_dosage');
                $new_id_type_individu = Request::input('new_id_type_individu');
                $id_dosage = Request::input('id_dosage');
                $id_type_individu = Request::input('id_individu');
                $posologie = Request::input('posologie');
                $unServiceMedicament = new ServiceMedicament();
                $unServicePrescription = new ServicePrescription();
                $leMedicament = $unServiceMedicament->getleMedoc($id_medicament);
                $modifPrescription = $unServicePrescription->modifierLaPrescription($id_medicament,$new_id_dosage,$new_id_type_individu,$posologie,$id_dosage,$id_type_individu);
                $mesPrescriptions = $unServicePrescription->getLesPrescriptions($id_medicament);
                return view('vues.listePrescription', compact('leMedicament','mesPrescriptions','erreur'));
            } catch (MonException $e) {
                $erreur = $e->getMessage();
                return view('vues/pageErreur', compact('erreur'));
            } catch (\Exception $e) {
                $erreur = $e->getMessage();
                return view('vues/pageErreur', compact('erreur'));
            }
        }
        else {
            $erreur = "Vous n'êtes pas authentifié";
            return view('vues/formLogin', compact('erreur'));
        }
    }
}
