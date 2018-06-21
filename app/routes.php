<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('hello');
});

Route::get('/todos', function()
{
	$todos = DB::table('todos')->get();
	foreach ($todos as $todo)
	{
		if($todo->isCompleted == "0"){
			$todo->isCompleted = false;
		}else{
			$todo->isCompleted = true;
		}
	} 	
 	return Response::json(array("todos" => $todos));
});

Route::post('/todos', function()
{
	$todo_input = Input::get('todo');
	
        $todo = DB::table('todos')->insertGetId(
    		array('title' => $todo_input['title'], 'isCompleted' => $todo_input['isCompleted'])
	);
	if($todo){
		return Response::json(array("todo" => array("id" => $todo, 'title' => $todo_input['title'], 'isCompleted' => $todo_input['isCompleted']) ));
	}else{
		return Response::json(array("todo" => $todo));
	}
});

Route::put('/todos/{id}', function($id)
{
        $todo_input = Input::get('todo');
        
        $todo = DB::table('todos')->where('id', $id)->update(
                array('title' => $todo_input['title'], 'isCompleted' => $todo_input['isCompleted'])
        );
	if($todo){
                return Response::json(array("todo" => array("id" => $id, 'title' => $todo_input['title'], 'isCompleted' => $todo_input['isCompleted']) ));
        }else{
              	return Response::json(array("todo" => $todo));
        }
	//return Response::json(array("todo" => $todo));
});

Route::delete('/todos/{id}', function($id)
{
        $todo = DB::table('todos')->where('id',$id)->delete();
	if($todo){
		return "Item was deleted";
	}else{
		return "Error";
	}
});

//Route::resource('todos', 'todosController');
