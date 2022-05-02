<?php

namespace App\Http\Controllers;

use App\dao\ServiceFormulation;
use App\dao\ServiceMedicament;
use App\dao\ServicePresentation;
use Illuminate\Support\Facades\Input;
use Request;
Use App\Exceptions\MonException;
use Illuminate\Support\Facades\Session;
use Exception;


class FormulationController
{
    public function getFormulations($id_medicament){
        if (Session::get('id') > 0) {
            try {
                $erreur = Session::get('erreur');
                Session::forget('erreur');
                $unServiceFormulation = new ServiceFormulation();
                $unServicemedicament = new ServiceMedicament();
                $mesFormulations = $unServiceFormulation->getLesFormulations($id_medicament);
                $leMedicament = $unServicemedicament->getleMedoc($id_medicament);
                return view('vues.listeFormulations', compact('leMedicament','mesFormulations','erreur'));
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

    public function supprimerFormulation($id_medicament,$id_presentation){
        if (Session::get('id') > 0) {
            try {
                $erreur = Session::get('erreur');
                Session::forget('erreur');
                $unServiceFormulation = new ServiceFormulation();
                $unServiceMedicament = new ServiceMedicament();
                $suppFormulation = $unServiceFormulation->suppFormulation($id_medicament,$id_presentation);
                $mesFormulations = $unServiceFormulation->getLesFormulations($id_medicament);
                $leMedicament = $unServiceMedicament->getleMedoc($id_medicament);
                return view('vues.listeFormulations', compact('leMedicament','mesFormulations','erreur'));
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

    public function ajoutFormulation($id_medicament){
        if (Session::get('id') > 0) {
            try {
                $erreur = Session::get('erreur');
                Session::forget('erreur');
                $mauvaiseqte = "";
                $unServiceFormulation = new ServiceFormulation();
                $unServicePresentation = new ServicePresentation();
                $unServiceMedicament = new ServiceMedicament();
                $mesFormulations = $unServiceFormulation->getLesFormulations($id_medicament);
                $mesPresentation = $unServicePresentation->getLesPresentation();
                $leMedicament = $unServiceMedicament->getLeMedoc($id_medicament);
                return view('vues.FormFormulation', compact('leMedicament','mesPresentation','mesFormulations','erreur','mauvaiseqte'));
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

    public function ajouterLaFormulation(){
        if (Session::get('id') > 0) {
            try {
                $erreur = Session::get('erreur');
                Session::forget('erreur');
                $id_medicament = Request::input('id_medicament');
                $id_presentation = Request::input('id_presentation');
                $qte_formuler = Request::input('qte_formuler');
                $unServiceFormulation = new ServiceFormulation();
                $unServiceMedicament = new ServiceMedicament();
                $unServicePresentation = new ServicePresentation();
                $mesFormulations = $unServiceFormulation->getLesFormulations($id_medicament);
                $leMedicament = $unServiceMedicament->getleMedoc($id_medicament);
                if (($qte_formuler <= 0) or ($qte_formuler > 10000)){
                    $mauvaiseqte = "La quantité doit être supérieur à 0 et plus petite que 10 000";
                    $mesPresentation = $unServicePresentation->getLesPresentation();
                    return view('vues.FormFormulation', compact('mauvaiseqte','leMedicament','mesPresentation','mesFormulations'));
                }
                else {
                    $ajoutFormulation = $unServiceFormulation->ajouterLaFormulation($id_medicament,$id_presentation,$qte_formuler);
                    $mesFormulations = $unServiceFormulation->getLesFormulations($id_medicament);
                }
                return view('vues.listeFormulations', compact('leMedicament','mesFormulations','erreur'));
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

    public function modifFormulation($id_medicament,$id_presentation){
        if (Session::get('id') > 0) {
            try {
                $erreur = Session::get('erreur');
                Session::forget('erreur');
                $mauvaiseqte = '';
                $unServiceFormulation = new ServiceFormulation();
                $unServicePresentation = new ServicePresentation();
                $mesFormulations = $unServiceFormulation->getLesFormulations($id_medicament);
                $laFormulation = $unServiceFormulation->getLaFormulation($id_medicament,$id_presentation);
                $mesPresentation = $unServicePresentation->getLesPresentation();
                $laPresentation = $unServicePresentation->getLaPresentation($id_presentation);
                return view('vues.FormFormulation', compact('mesPresentation','mesFormulations','laPresentation','laFormulation','erreur','mauvaiseqte'));
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

    public function modifierLaFormulation(){
        if (Session::get('id') > 0) {
            try {
                $erreur = Session::get('erreur');
                Session::forget('erreur');
                $id_medicament = Request::input('id_medicament');
                $id_presentation = Request::input('id_presentation');
                $old_id_presentation = Request::input('old_id_presentation');
                if ($id_presentation == null){
                    $id_presentation = $old_id_presentation;
                }
                $qte_formuler = Request::input('qte_formuler');
                $unServiceFormulation = new ServiceFormulation();
                $unServiceMedicament = new ServiceMedicament();
                $unServicePresentation = new ServicePresentation();
                 if (($qte_formuler <= 0) or ($qte_formuler > 10000)){
                    $mauvaiseqte = "La quantité doit être supérieur à 0 et plus petite que 10 000.";
                    $mesPresentation = $unServicePresentation->getLesPresentation();
                    $mesFormulations = $unServiceFormulation->getLesFormulations($id_medicament);
                    $leMedicament = $unServiceMedicament->getleMedoc($id_medicament);
                    $laPresentation = $unServicePresentation->getLaPresentation($id_presentation);
                    $laFormulation = $unServiceFormulation->getLaFormulation($id_medicament,$id_presentation);
                    return view('vues.FormFormulation', compact('mauvaiseqte','leMedicament','mesPresentation','mesFormulations',"laPresentation","laFormulation"));
                }
                $ajoutFormulation = $unServiceFormulation->modifierLaFormulation($id_medicament,$id_presentation,$old_id_presentation,$qte_formuler);
                $mesFormulations = $unServiceFormulation->getLesFormulations($id_medicament);
                $leMedicament = $unServiceMedicament->getleMedoc($id_medicament);
                return view('vues.listeFormulations', compact('leMedicament','mesFormulations','erreur'));
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
