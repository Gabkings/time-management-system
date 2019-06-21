<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Activity;
class ActivityController extends Controller
{
    //

    public function index()
    {
        $activity = auth()->user()->activities();
 
        return response()->json([
            'success' => true,
            'data' => $activity
        ],200);
    }


    public function show($id)
    {
        $activity = auth()->user()->activities()->find($id);
 
        if (!$activity) {
            return response()->json([
                'success' => false,
                'message' => 'Activity with id ' . $id . ' not found'
            ], 400);
        }
 
        return response()->json([
            'success' => true,
            'data' => $activity->toArray()
        ], 400);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'date' => 'required',
            'hours' => 'required'
        ]);
        $activity = new Product();
        $activity->activity_name = $request->name;
        $activity->description = $request->description;
        $activity->activity_date = $request->date;
        $activity->hours_spent = $request->hours;
 
        if (auth()->user()->products()->save($activity))
            return response()->json([
                'success' => true,
                'data' => $activity->toArray()
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'Product could not be added'
            ], 500);
    }

    public function update(Request $request, $id)
    {
        $activity = auth()->user()->products()->find($id);
 
        if (!$activity) {
            return response()->json([
                'success' => false,
                'message' => 'Product with id ' . $id . ' not found'
            ], 400);
        }
 
        $updated = $activity->fill($request->all())->save();
 
        if ($updated)
            return response()->json([
                'success' => true
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'Product could not be updated'
            ], 500);
    }

    public function destroy($id)
    {
        $activity = auth()->user()->products()->find($id);
 
        if (!$activity) {
            return response()->json([
                'success' => false,
                'message' => 'Product with id ' . $id . ' not found'
            ], 400);
        }
 
        if ($activity->delete()) {
            return response()->json([
                'success' => true
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Product could not be deleted'
            ], 500);
        }
    }


}


