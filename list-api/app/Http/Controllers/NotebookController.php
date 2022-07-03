<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\NotebookReauest;
use App\Http\Requests\StoreNotebookRequest;
use App\Http\Requests\UpdateNotebookRequest;
use Illuminate\Http\Request;
use App\Services\NotebookServise;
use App\Models\notebook;

class NotebookController extends Controller
{

    /**
     * @OA\GET(
     *     path="/notebook/",
     *     operationId="GetNotebooks",
     *     tags={"Notebooks"},
     *     summary="Get list of all notebooks",
     *
     *     @OA\Response(
     *      response="200",
     *      description="Succses operation",
     *      @OA\MediaType(
     *          mediaType="application/json",
     *          @OA\Schema(
     *              @OA\Property (
     *                  property="current_page",
     *                  type="integer",
     *              ),
     *              @OA\Property(
     *                  property="data",
     *                  type="array",
     *                  @OA\Items(
     *                      @OA\Property (
     *                         property="id",
     *                         type="integer"
     *                      ),
     *                      @OA\Property (
     *                          property="created_at",
     *                          type="datetime"
     *                      ),
     *                      @OA\Property (
     *                          property="updated_at",
     *                          type="datetime"
     *                      ),
     *                      @OA\Property (
     *                          property="FCs",
     *                          type="string"
     *                      ),
     *                      @OA\Property (
     *                          property="mob_phone",
     *                          type="string",
     *                          example="+19803655718"
     *                      ),
     *                      @OA\Property (
     *                          property="birthdate",
     *                          type="date",
     *                      ),
     *                      @OA\Property (
     *                          property="email",
     *                          type="string",
     *                          example="example@ya.ru"
     *                      ),
     *                      @OA\Property (
     *                          property="company_id",
     *                          type="integer",
     *                          example="1"
     *                      ),
     *                      @OA\Property (
     *                          property="photo_path",
     *                          type="string",
     *                          example="image.png"
     *                      ),
     *                  ),
     *              ),
     *                      @OA\Property (
     *                          property="first_page_url",
     *                          type="string",
     *                          example="http://127.0.0.1:8080/api/v1/notebook?page=1"
     *                      ),
     *                      @OA\Property (
     *                          property="from",
     *                          type="integer",
     *                          example="0"
     *                      ),
     *                      @OA\Property (
     *                          property="next_page_url",
     *                          type="string",
     *                          example="http://127.0.0.1:8080/api/v1/notebook?page=2"
     *                      ),
     *                      @OA\Property (
     *                          property="path",
     *                          type="string",
     *                          example="http://127.0.0.1:8080/api/v1/notebook"
     *                      ),
     *                      @OA\Property (
     *                          property="per_page",
     *                          type="integer",
     *                          example="1"
     *                      ),
     *                      @OA\Property (
     *                          property="prev_page_url",
     *                          type="string",
     *                          example="http://127.0.0.1:8080/api/v1/notebook?page=2"
     *                      ),
     *                      @OA\Property (
     *                          property="to",
     *                          type="intgeger",
     *                          example="2"
     *                      ),
     *
     *                  ),
     *              ),
     *          ),
     *
     * )
     *
     */


    public function index(){
        return NotebookServise::AllNoteBooks();
    }


    /**
     * @OA\POST(
     *     path="/notebook/",
     *     operationId="SaveNotebook",
     *     tags={"Notebooks"},
     *     summary="Save single notebook",
     *
     *     @OA\RequestBody(
     *        required=true,
     *        description="parameters for new notebook",
     *       @OA\JsonContent(
     *       required={"FCs","email", "mob_phone"},
     *                      @OA\Property (
     *                          property="FCs",
     *                          type="string"
     *                      ),
     *                      @OA\Property (
     *                          property="mob_phone",
     *                          type="string",
     *                          example="+19803655718"
     *                      ),
     *                      @OA\Property (
     *                          property="birthdate",
     *                          type="date",
     *                      ),
     *                      @OA\Property (
     *                          property="email",
     *                          type="string",
     *                          example="example@ya.ru"
     *                      ),
     *                      @OA\Property (
     *                          property="company_id",
     *                          type="integer",
     *                          example="1"
     *                      ),
     *                      @OA\Property (
     *                          property="photo_path",
     *                          type="string",
     *                          example="image.png"
     *                      ),
     *                  ),
     *              ),
     *         @OA\Response(
     *         response="200",
     *         description="NoteBook add succeces",
     *     ),
     *         @OA\Response(
     *         response="402",
     *         description="Validation error",
     *     ),
     * )
     *
     */





    public function store(StoreNotebookRequest $request){
        $is_valid = $request->validated();
        if ($is_valid){
            if(gettype($request->input('company')) == 'string'){
            NotebookServise::CreateNewNoteBook($request, false);
            }
            else{
                NotebookServise::CreateNewNoteBook($request, true);
            }
        }
        else{
            return $is_valid;
        }
        return $is_valid;
    }

    /**
     * @OA\Delete(
     *     path="/notebook/{id}",
     *     operationId="notebooksDelete",
     *     tags={"Notebooks"},
     *     summary="Delete notebook by ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="The ID of notebook",
     *         required=true,
     *         example="1",
     *         @OA\Schema(
     *             type="integer",
     *         ),
     *     ),
     *     @OA\Response(
     *         response="202",
     *         description="NoteBook delete succeces",
     *     ),
     *     @OA\Response(
     *         response="402",
     *         description="NoteBook with id doesnt exist",
     *     ),
     * )
     *
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     */

    public function delete($id){
        return NotebookServise::DeleteNoteBookById($id);
    }

    /**
     * @OA\GET(
     *     path="/notebook/{id}",
     *     operationId="GetSingleNotebook",
     *     tags={"Notebooks"},
     *     summary="Get notebook by ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="The ID of notebook",
     *         required=true,
     *         example="1",
     *         @OA\Schema(
     *             type="integer",
     *         ),
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="NoteBook get succeces",
     *          @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema(
     *                      @OA\Property (
     *                         property="id",
     *                         type="integer"
     *                      ),
     *                      @OA\Property (
     *                          property="created_at",
     *                          type="datetime"
     *                      ),
     *                      @OA\Property (
     *                          property="updated_at",
     *                          type="datetime"
     *                      ),
     *                      @OA\Property (
     *                          property="FCs",
     *                          type="string"
     *                      ),
     *                      @OA\Property (
     *                          property="mob_phone",
     *                          type="string",
     *                          example="+19803655718"
     *                      ),
     *                      @OA\Property (
     *                          property="birthdate",
     *                          type="date",
     *                      ),
     *                      @OA\Property (
     *                          property="email",
     *                          type="string",
     *                          example="example@ya.ru"
     *                      ),
     *                      @OA\Property (
     *                          property="company_id",
     *                          type="integer",
     *                          example="1"
     *                      ),
     *                      @OA\Property (
     *                          property="photo_path",
     *                          type="string",
     *                          example="image.png"
     *                      ),
     * ),
     *     ),
     *     ),
     *     @OA\Response(
     *         response="404",
     *         description="NoteBook with id doesnt exist",
     *     ),
     * )
     *
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     */


    public function SingleNoteBook(Request $request, $id){
        return NotebookServise::GetSingleNoteBook($id);
    }

    /**    @OA\POST(
     *     path="/notebook/{id}",
     *     operationId="UpdateSingleNotebook",
     *     tags={"Notebooks"},
     *     summary="Update notebook by ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="The ID of notebook",
     *         required=true,
     *         example="1"),
     *     @OA\RequestBody (
     *          required=true,
     *          description="Parameters that will update",
     *          @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema(
     *                      @OA\Property (
     *                          property="FCs",
     *                          type="string"
     *                      ),
     *                      @OA\Property (
     *                          property="mob_phone",
     *                          type="string",
     *                          example="+19803655718"
     *                      ),
     *                      @OA\Property (
     *                          property="birthdate",
     *                          type="date",
     *                      ),
     *                      @OA\Property (
     *                          property="email",
     *                          type="string",
     *                          example="example@ya.ru"
     *                      ),
     *                      @OA\Property (
     *                          property="company_id",
     *                          type="integer",
     *                          example="1"
     *                      ),
     *                      @OA\Property (
     *                          property="photo_path",
     *                          type="string",
     *                          example="image.png"
     *                      ),
     *
     * ),
     *  ),
     *     ),
     *     @OA\Response(
     *         response="404",
     *         description="NoteBook with id doesnt exist",
     *     ),
     *     @OA\Response(
     *         response="402",
     *         description="Validation error",
     *     ),
     * )
     */




    public function updateNotebook(UpdateNotebookRequest $request, $id){
        $request->validated();
        return NotebookServise::UpdateNoteBookById($request, $id);
    }

}
