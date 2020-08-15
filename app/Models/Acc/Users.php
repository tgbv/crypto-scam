<?php

namespace App\Models\Acc;

use Mail;
use App\Mail\UserConfirmation;
use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
	# set connection
	protected $connection = 'mysql';

	# table
	protected $table = 'acc_users';

	# fillable
	protected $fillable = [
		'email', 'phone', 'password',
	];

	# casts
	protected $casts = [
		'roles' => 'json',
	];

	# appended
	protected $appends = ['roles'];

	#
	#	set password
	#
	public function setPasswordAttribute(string &$data)
	{
		$this->attributes['password'] = bcrypt($data);
	}

	#
	#	sets email
	#
	public function setEmailAttribute(string &$data)
	{
		$this->attributes['email'] = $this->getHashed($data);
	}

	#
	#	sets phone
	#
	public function setPhoneAttribute(string &$data)
	{
		$this->attributes['phone'] = $this->getHashed($data);
	}

	#
	#	retrieves the roles
	#
	public function getRolesAttribute(&$data)
	{
		if(empty($this->attributes['roles']))
			$this->attributes['roles'] = $this->getRoles();

		return $this->attributes['roles'];
	}

	#
	#	get roles
	#
	public function getRoles()
	{
		return $this->hasMany(\App\Models\Acc\UserRole::class, 'user_id', 'id');
	}

	#
	#	get Suspended Status
	#
	public function getSuspendedStatus()
	{
		return $this->hasOne(\App\Models\Acc\SuspendedUsers::class, 'user_id', 'id');
	}

	#
	#	retrieves pending confirmations
	#
	public function getPendingConfirmations()
	{
		return $this->hasMany(\App\Models\Acc\PendingUserConfirmations::class, 'user_id', 'id');
	}

	#
	#	retreive the active password resets records
	#
	public function getPasswordResets()
	{
		return $this->hasOne(\App\Models\Acc\PasswordResets::class, 'user_id', 'id');
	}

	#
	#	retrieves user by email
	#
	public static function getByEmail(string $email, array $cols = ['*'])
	{
		return self::select($cols)
					->where('email', self::getHashed($email))
					->first();
	}

	#
	#	retrieves user by phone
	#
	public static function getByPhone(string $phone, array $cols = ['*'])
	{
		return self::select($cols)
					->where('phone', self::getHashed($phone))
					->first();
	}

	#
	#	creates a standard user
	#
	public static function createStandardUser(array $attrs)
	{
		# creates user and assign role
    	$User = self::create($attrs);
    	$User->getRoles()->create([
    		'role_id' => 2
    	]);

    	# request phone/email confirmation
    	$User->requireConfirmation([
    		'email' => $attrs['email'],
    		'phone' => $attrs['phone'],
    	]);

    	# return beloved model
    	return $User;
	}

	#
	#	sends phone/email verification
	#
	public function requireConfirmation(array $data)
	{
		$this->requireEmailConfirmation($data['email']);
		$this->requirePhoneConfirmation($data['phone']);
	}

	#
	#	sends phone verification
	#
	public function requirePhoneConfirmation(string $data)
	{

	}

	#
	#	sends email verification
	#
	public function requireEmailConfirmation(string $data)
	{
		Mail::to($data)
			->send(new UserConfirmation([
				'Confirmation' => $this->getPendingConfirmations()->create([
					'passphrase' => $this->generateEmailConfirmationToken(),
					'type' => 1,
				])
			]));
	}

	#
	#	generate email verification token
	#
	public function generateEmailConfirmationToken()
	{
		return hash('sha512', microtime());
	}

	#
	#	generate phone verification token
	#
	public static function generatePhoneConfirmationToken()
	{
		for($i=0; $i<8; $i++)
			$tmp .= rand(0, 9);

		return $tmp;
	}

	#
	#	retrieves hashed val
	#
	private static function getHashed(string $data)
	{
		return hash('sha512', $data . config('app.db_sha_salt'));
	}
}
