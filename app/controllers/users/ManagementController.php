<?php

class Users_ManagementController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$users = User::paginate();

		if($users->count() > 0)
		{
			return View::make('layouts.users.management.list')
				->with('users', $users);		
		}
		else
		{
			Session::flash('warning', Lang::get('messages.users.management.index'));
			return View::make('layouts.users.management.list')
				->with('users', $users);
		}		
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$user = new User;

		$form_data = array('route' => 'admin.users.store', 'method' => 'POST');

        $action = 'Crear';    

		return View::make('layouts.users.management.form', compact('user', 'form_data', 'action'));		
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{		
        $user = new User;
        
        $data = Input::all();
        
        if ($user->validAndSave($data))
        {
        	Session::flash('success', Lang::get('messages.users.management.store'));	            
        	return Redirect::route('admin.users.show', array($user->id));
        }
        else
        {	            
			return Redirect::route('admin.users.create')->withInput()->withErrors($user->errors);
        } 
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$user = User::find($id);

		if(empty($user))
		{
			App::abort(404);			
		}
		else
		{
			return View::make('layouts.users.management.show')->with('user', $user);
		}		
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$user = User::find($id);

		if(empty($user))
		{
			App::abort(404);			
		}
		else
		{
			$form_data = array('route' => array('admin.users.update', $user->id), 'method' => 'PATCH');
        	$action = 'Editar';
			return View::make('layouts.users.management.form', compact('user', 'form_data', 'action'));
		}
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$user = User::find($id);

		if(empty($user))
		{
			return Redirect::route('admin.users.index')
				->with('error', Lang::get('messages.users.management.update'));			
		}
		else
		{
			$data = Input::all();

			if ($user->validAndSave($data))
        	{	            
            	 return Redirect::route('admin.users.show', array($user->id));
        	}
        	else
        	{	            
				return Redirect::route('admin.users.edit', $user->id)
					->withInput()->withErrors($user->errors);
        	}  		
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$user = User::find($id);

		if(empty($user))
		{
			if (Request::ajax())
        	{	            
            	return Response::json(array(            	 		
            		'success' => false,
            		'msg' => Lang::get('messages.users.management.destroy.error')            		
            	));
        	}
        	else
        	{
				return Redirect::route('admin.users.index')
					->with('error', Lang::get('messages.users.management.destroy.error'));			
			}
		}
		else
		{
			$user->delete();

			if (Request::ajax())
	        {	            
	           	return Response::json(array(            	 		
	           		'success' => true,
	           		'msg' => Lang::get('messages.users.management.destroy.success', 
						array('username' => $user->username)),
	           		'id' => $user->id
	           	));
	        }
	        else
	        {	            
				return Redirect::route('admin.users.index')
					->with('success', Lang::get('messages.users.management.destroy.success', 
						array('username' => $user->username)));
	        }        	 		
		}
	}
}
