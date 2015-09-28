<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	public $errors;

	protected $perPage = 10;

	protected $fillable = array('username', 'email', 'name', 'lastname', 'password');

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password');

	/**
	 * Validar si los datos introducidos por el usuario son correctos.
	 *
	 * @param  array  $data
	 * @return Boolean
	 */
    public function isValid($data)
    {
        $rules = array(
        	'username' => 'required|alpha_num|unique:users',
            'email' => 'required|email|unique:users',
            'password'  => 'min:8|confirmed|max:20',
            'name' => 'required|alpha_spaces|min:3|max:40',
            'lastname' => 'required|alpha_spaces|min:3|max:40',           
            //'birthday'  => 'required|date_format:ddmmyyyy'            
        );
		
        if ($this->exists)
        {            
			$rules['email'] .= ',email,' . $this->id;
			$rules['username'] .= ',username,' . $this->id;
        }
        else 
        {            
            $rules['password'] .= '|required';
        }
        
        $validator = Validator::make($data, $rules);
        
        if ($validator->passes())
        {
            return true;
        }
        
        $this->errors = $validator->errors();
        
        return false;
    }

    /**
	 * Cifra la contraseña en caso de que la haya introducido
	 *
	 * @param string $value	 
	 */
    public function setPasswordAttribute($value)
    {
        if ( ! empty ($value))
        {
            $this->attributes['password'] = Hash::make($value);
        }
    }	
	
    /**
	 * Valida y salva el usuario en la bdd
	 *
	 * @param string $value	 
	 */
	public function validAndSave($data)
    {
        if ($this->isValid($data))
        {
            $this->fill($data);
            
            $this->save();
            
            return true;
        }
        else
        {        
        	return false;
        }
    }		

	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}

	/**
	 * Get the password for the user.
	 *
	 * @return string
	 */
	public function getAuthPassword()
	{
		return $this->password;
	}

	/**
	 * Get the token value for the "remember me" session.
	 *
	 * @return string
	 */
	public function getRememberToken()
	{
		return $this->remember_token;
	}

	/**
	 * Set the token value for the "remember me" session.
	 *
	 * @param  string  $value
	 * @return void
	 */
	public function setRememberToken($value)
	{
		$this->remember_token = $value;
	}

	/**
	 * Get the column name for the "remember me" token.
	 *
	 * @return string
	 */
	public function getRememberTokenName()
	{
		return 'remember_token';
	}

	/**
	 * Get the e-mail address where password reminders are sent.
	 *
	 * @return string
	 */
	public function getReminderEmail()
	{
		return $this->email;
	}
	
}
