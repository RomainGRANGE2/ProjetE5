<?php

namespace App\dao;

use Illuminate\Support\Facades\DB;

class ServicePrescription
{
    public function getLesPrescriptions($id_medicament){
        try{
            $lesPrescriptions = DB::table('prescrire')
                ->Select()
                ->join('medicament' , 'medicament.id_medicament','=','prescrire.id_medicament')
                ->join('dosage' , 'dosage.id_dosage','=','prescrire.id_dosage')
                ->join('type_individu' , 'type_individu.id_type_individu','=','prescrire.id_type_individu')
                ->where('medicament.id_medicament','=', $id_medicament)
                ->get();
            return $lesPrescriptions;
        }catch (QueryException $e){
            throw new Exception($e->getMessage(),5);
        }
    }

    public function getLesDosages(){
        try{
            $lesDosages = DB::table('dosage')
                ->Select()
                ->get();
            return $lesDosages;
        }catch (QueryException $e){
            throw new Exception($e->getMessage(),5);
        }
    }

    public function getLesIndividus(){
        try{
            $lesIndividus = DB::table('type_individu')
                ->Select()
                ->get();
            return $lesIndividus;
        }catch (QueryException $e){
            throw new Exception($e->getMessage(),5);
        }
    }

    public function ajouterLaPrescription($id_dosage,$id_medicament,$id_type_individu,$posologie){
        try{
            DB::table('prescrire')->insert(
                [
                    'prescrire.id_dosage' => $id_dosage,
                    'prescrire.id_medicament' => $id_medicament,
                    'prescrire.id_type_individu' => $id_type_individu,
                    'prescrire.posologie' => $posologie]
            );
        }catch (QueryException $e){
            throw new Exception($e->getMessage(),5);
        }
    }

    public function suppPrescription($id_medicament,$id_dosage,$id_type_individu){
        try{
            $lesPrescriptions = DB::table('prescrire')
                ->where('prescrire.id_medicament','=',$id_medicament)
                ->where('prescrire.id_dosage','=',$id_dosage)
                ->where('prescrire.id_type_individu','=',$id_type_individu)
                ->delete();
            return $lesPrescriptions;
        }catch (QueryException $e){
            throw new Exception($e->getMessage(),5);
        }
    }

    public function getLaPrescription($id_medicament,$id_dosage,$id_type_individu){
        try{
            $laPrescription = DB::table('prescrire')
                ->Select()
                ->where('prescrire.id_medicament','=',$id_medicament)
                ->where('prescrire.id_dosage','=',$id_dosage)
                ->where('prescrire.id_type_individu','=',$id_type_individu)
                ->get();
            return $laPrescription;
        }catch (QueryException $e){
            throw new Exception($e->getMessage(),5);
        }
    }

    public function getLeDosage($id_dosage){
        try{
            $leDosage = DB::table('dosage')
                ->Select()
                ->where('dosage.id_dosage','=',$id_dosage)
                ->get();
            return $leDosage;
        }catch (QueryException $e){
            throw new Exception($e->getMessage(),5);
        }
    }

    public function getLeIndividu($id_type_individu){
        try{
            $leIndividu = DB::table('type_individu')
                ->Select()
                ->where('type_individu.id_type_individu','=',$id_type_individu)
                ->get();
            return $leIndividu;
        }catch (QueryException $e){
            throw new Exception($e->getMessage(),5);
        }
    }
    public function modifierLaPrescription($id_medicament,$new_id_dosage,$new_id_type_individu,$posologie,$id_dosage,$id_type_individu){
        try{
            DB::table('prescrire')
                ->where('id_medicament', "=" ,$id_medicament)
                ->where('id_dosage', '=', $id_dosage)
                ->where('id_type_individu', '=', $id_type_individu)
                ->update([
                        'id_dosage' => $new_id_dosage,
                        'id_type_individu' => $new_id_type_individu,
                        'posologie' => $posologie]
                );
        }catch (QueryException $e){
            throw new Exception($e->getMessage(),5);
        }
    }

}



