<?php

namespace App\Services;

use App\Http\Requests\StoreNotebookRequest;
use App\Http\Requests\UpdateNotebookRequest;
use Illuminate\Http\Request;
use App\Models\notebook;
use App\Models\Company;
use phpDocumentor\Reflection\Types\Boolean;

class NotebookServise
{

    public static function AllNoteBooks(){
        return notebook::simplePaginate(2);
    }

    public static function GetSingleNoteBook($id){
        return notebook::findOrFail($id);
    }

    public static function DeleteNoteBookById($id){
        $notebook_todel = notebook::find($id);
        if($notebook_todel != null){
            $notebook_todel->delete();
            $data = ['message' => "Notebook ".$id." was deleted"];
        }
        else{
            $data = ['message' => "Notebook ".$id." doesn exists"];
        }
        return response()->json($data);
    }


    public static function CreateNewNoteBook(StoreNotebookRequest $request, bool $isId){
        $notebook = new notebook;
        $notebook->FCs = $request->input('FCs');
        $notebook->mob_phone = $request->input('mob_phone');
        $notebook->birthdate = $request->input('birthdate');
        $notebook->email = $request->input('email');
        $notebook->photo_path = $request->input('photo_path');
        if ($isId) {
            $company = Company::find($request->input('company'));
        }
        else{
            $company = Company::where('Name', '=', $request->input('company'))->first();
        }

        if ($company == null){
            $notebook->company_id = 0;
        }
        else {
            $notebook->company_id = $company->id;
            }
        $result = $notebook->save();
        return $result;
    }

    public static function UpdateNotebookById(UpdateNotebookRequest $request, $id){
        $notebook_to_edit = notebook::find($id);
        if($notebook_to_edit != null){
            $input = $request->all();
            $notebook_to_edit->fill($input)->save();
            $data = ['message' => "Notebook ".$id." was updated"];
        }
        else{
            $data = ['message' => "Notebook ".$id." doesn exists"];
        }
        return response()->json($data);
    }
}
