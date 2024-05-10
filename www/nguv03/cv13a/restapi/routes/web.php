<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// READ (GET request)
Route::get('/presidents/{id?}', function (Request $request) {
    $presidents = [ // obviously fetch data from DB
        [ 'id' => '1', 'name' => 'Barrack Obamama', 'job' => 'US Ex-President' ],
        [ 'id' => '2', 'name' => 'Joe Bidenen',     'job' => 'US President'    ],
        [ 'id' => '3', 'name' => 'Donald Trump',    'job' => 'US Ex-President' ],
    ];
    if ($request->id) {
        $id = $request->id;
        $filteredPresidents = array_values(array_filter($presidents, function ($president) use ($id) {
            return $id == $president['id'];
        }));
        if (empty($filteredPresidents)) {
            return response([], 404);
        }
        return response()->json($filteredPresidents);
    }
    return response()->json($presidents);
    // return response()->json([ 'data' => $request->id ]);
});

// CREATE (POST request)
Route::post('/presidents', function (Request $request) {
    // access request body
    // $request->job
    // $request->name
    // $request->...
    // pass to controller to save
    return response()->json([ 'data' => $request->job ]);
});

// UPDATE
Route::put('/presidents/{id}', function (Request $request) {
    return response()->json([ 'data' => $request->id ]);
});

// DELETE
Route::delete('/presidents/{id}', function (Request $request) {
    return response()->json([ 'data' => $request->id ]);
});