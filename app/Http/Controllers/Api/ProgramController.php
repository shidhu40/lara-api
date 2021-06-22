<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use App\Models\Program;
use App\Http\Resources\ProgramResource;
use App\Http\Requests\ProgramStore;
use Exception;
class ProgramController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $programs = Program::all();

        return $this->successResponse(ProgramResource::collection($programs), 'Programs retrieved successfully.');
    }
	
	/**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProgramStore $request)
    {
        $validated = $request->validated();
		try {
			$program = Program::create($request->all());
			$success = new ProgramResource($program);

            $message = 'Yay! A program has been successfully created.';
			
			return $this->successResponse($success,$message);
		} catch (Exception $e) {
            $success = [];
            $message = 'Oops! Unable to create a new program.';
			return $this->errorResponse($message,201);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $program = Program::find($id);
  
        if (is_null($program)) {
            return $this->errorResponse('Program not found.');
        }
   
        return $this->successResponse(new ProgramResource($program), 'Program retrieved successfully.');
    }
	
	/**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProgramStore $request, Program $program)
    {
		$validated = $request->validated();
		$input = $request->all();
		try {
			$program->program_title = $input['program_title'];
			$program->program_age_rating = $input['program_age_rating'];
			$program->program_description = $input['program_description'];
			$program->program_type = $input['program_type'];
			$program->save();

            $success = new ProgramResource($program);
            $message = 'Yay! Program has been successfully updated.';
			
			return $this->successResponse($success,$message);
        } catch (Exception $e) {
            $success = [];
            $message = 'Oops, Failed to update the program.';
			return $this->errorResponse($message,201);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Program $program)
    {
		try {
            $program->delete();
            return $this->successResponse(null, 'The Program has been successfully deleted.');
        } catch (Exception $e) {
            return $this->errorResponse('Oops! Unable to delete Program.');
        }
    }
}
