<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use App\Models\Channel;
use App\Http\Resources\ChannelResource;
use App\Http\Requests\StoreChannelRequest;
use Exception;

class ChannelController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $channels = Channel::all();

		return $this->successResponse(ChannelResource::collection($channels), 'Channels retrieved successfully.');
    }
	
	/**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreChannelRequest $request)
    {
        $input = $request->all();
		$validated = $request->validated();
		try {
			$channel = Channel::create($input);
			$success = new ChannelResource($channel);
            $message = 'Channel created successfully.';
			
			return $this->successResponse($success,$message);
		} catch (Exception $e) {
            $message = 'Oops! Unable to create a new channel.';
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
        
		$channel = Channel::find($id);
  
        if (is_null($channel)) {
            return $this->errorResponse('Channel not found.',201);
        }
   
        return $this->successResponse(new ChannelResource($channel), 'Channel retrieved successfully.');
    }
	
	/**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Channel $channel)
    {
        $input = $request->all();
        $channel->channel_name = $input['channel_name'];
        $channel->program_id = $input['program_id'];
		$channel->epg_date = $input['epg_date'];
        $channel->epg_start_time = $input['epg_start_time'];
		$channel->epg_end_time = $input['epg_end_time'];
        $channel->save();
   
        return $this->successResponse(new ChannelResource($channel), 'Channel updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Channel $channel)
    {
		try {
            $channel->delete();
            return $this->successResponse(null, 'The Channel has been successfully deleted.');
        } catch (Exception $e) {
            return $this->errorResponse('Oops! Unable to delete Channel.');
        }
    }
}
