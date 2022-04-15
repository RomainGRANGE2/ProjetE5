<?php

namespace App\Http\Controllers;

use App\dao\ServiceFormulation;
use App\dao\ServiceInteraction;
use App\dao\ServiceMedicament;
use App\dao\ServicePresentation;
use Illuminate\Support\Facades\Input;
use Request;
Use App\Exceptions\MonException;
use Illuminate\Support\Facades\Session;
use Exception;

class InteractionController
{
    public function getInteraction($id_medicament){
        if (Session::get('id') > 0) {
            try {
                $erreur = Session::get('erreur');
                Session::forget('erreur');
                $unServiceInteraction = new ServiceInteraction();
                $unServiceMedicament = new ServiceMedicament();
                $mesInteractions = $unServiceInteraction->getLesInteractions($id_medicament);
                $leMedicament = $unServiceMedicament->getleMedoc($id_medicament);
                return view('vues.listeInteractions', compact('mesInteractions','leMedicament','erreur'));
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

    public function ajoutinteraction($id_medicament){
        if (Session::get('id') > 0) {
            try {
                $erreur = Session::get('erreur');
                Session::forget('erreur');
                $unServiceFormulation = new ServiceFormulation();
                $unServicePresentation = new ServicePresentation();
                $unServiceMedicament = new ServiceMedicament();
                $unServiceInteraction = new ServiceInteraction();
                $leMedicament = $unServiceMedicament->getleMedoc($id_medicament);
                $mesMedicaments = $unServiceMedicament->getlesMedicaments();
                $mesInteractions = $unServiceInteraction->getLesInteractions($id_medicament);
                return view('vues.FormInteraction', compact('mesInteractions','leMedicament','mesMedicaments','erreur'));
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

    public function ajouterLaInteraction(){
        if (Session::get('id') > 0) {
            try {
                $erreur = Session::get('erreur');
                Session::forget('erreur');
                $id_medicament = Request::input('id_medicament');
                $id_med_medicament = Request::input('id_med_medicament');
                $unServiceFormulation = new ServiceFormulation();
                $unServiceInteraction = new ServiceInteraction();
                $unServiceMedicament = new ServiceMedicament();
                $ajoutinteraction = $unServiceInteraction->ajouterLainteraction($id_medicament,$id_med_medicament);
                $mesFormulations = $unServiceFormulation->getLesFormulations($id_medicament);
                $mesInteractions = $unServiceInteraction->getLesInteractions($id_medicament);
                $leMedicament = $unServiceMedicament->getleMedoc($id_medicament);
                return view('vues.listeInteractions', compact('mesFormulations','leMedicament','mesInteractions','erreur'));
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

    public function supprimerInteraction($id_medicament,$med_id_medicament){
        if (Session::get('id') > 0) {
            try {
                $erreur = Session::get('erreur');
                Session::forget('erreur');
                $unServiceInteraction = new ServiceInteraction();
                $unServiceMedicament = new ServiceMedicament();
                $suppInteraction = $unServiceInteraction->supprInteraction($id_medicament,$med_id_medicament);
                $mesInteractions = $unServiceInteraction->getLesInteractions($id_medicament);
                $leMedicament = $unServiceMedicament->getleMedoc($id_medicament);
                return view('vues.listeInteractions', compact('mesInteractions','leMedicament','erreur'));
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

    public function modifInteractions($id_medicament,$med_id_medicament){
        if (Session::get('id') > 0) {
            try {
                $erreur = Session::get('erreur');
                Session::forget('erreur');
                $unServiceMedicament = new ServiceMedicament();
                $unServiceInteraction = new ServiceInteraction();
                $mesMedicaments = $unServiceMedicament->getlesMedicaments();
                $leMedicament = $unServiceMedicament->getleMedoc($id_medicament);
                $laInteraction = $unServiceInteraction->getLaIntercation($med_id_medicament);
                $lesInteractions = $unServiceInteraction->getLesInteractions($id_medicament);
                $mesInteractions = $unServiceInteraction->getLesInteractions($id_medicament);
                return view('vues.FormInteraction', compact('mesInteractions','mesMedicaments','lesInteractions','laInteraction','leMedicament','erreur'));
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

    public function modifierLaInteraction(){
        if (Session::get('id') > 0) {
            try {
                $erreur = Session::get('erreur');
                Session::forget('erreur');
                $id_medicament = Request::input('id_medicament');
                $ancien_med_id_medicament = Request::input('ancien_med_id_medicament');
                $new_med_id_medicament = Request::input('new_med_id_medicament');
                $unServiceInteraction = new ServiceInteraction();
                $unServiceMedicament = new ServiceMedicament();
                $leMedicament = $unServiceMedicament->getleMedoc($id_medicament);
                $modifIntercation = $unServiceInteraction->modiferLaInteraction($id_medicament,$ancien_med_id_medicament,$new_med_id_medicament);
                $mesInteractions = $unServiceInteraction->getLesInteractions($id_medicament);
                return view('vues.listeInteractions', compact('leMedicament','mesInteractions','erreur'));
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

