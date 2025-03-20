<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Business;
use App\Models\BusinessKeys;
use App\Models\TaskSheet;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();
        try {

            DB::beginTransaction();

            $user = User::create([
                'lastName'        => $request->lastName,
                'firstName'       => $request->firstName,
                'email'           => $request->email,
                'phoneNumber'     => $request->phoneNumber,
                'password'        => Hash::make($request->password),
                'referralChannel' => $request->referralChannel,
            ]);

            if (! $user) {
                throw new \Exception("Account creation failed");
            }

            $business = Business::create([
                'businessName' => $request->businessName,
                'user_id'      => $user->id,
            ]);

            if (! $business) {
                throw new \Exception("Account creation failed");
            }

            $task = TaskSheet::create([
                'business_id' => $business->id,
                'user_id'     => $user->id,
                'role_id'     => 1,
            ]);

            if (! $task) {
                throw new \Exception("Account creation failed");
            }

            // Generate keys
            $keys = $this->generateKeys($business->id);

            // Encrypt the secret key before storing
            $encryptedSecretKey = Crypt::encrypt($keys['secret_key']);

            $bizKeys = BusinessKeys::create([
                'business_id' => $business->id,
                'public_key'  => $keys['public_key'],
                'secret_key'  => $encryptedSecretKey,
            ]);

            if (! $bizKeys) {
                throw new \Exception("Account creation failed");
            }

            DB::commit();

            event(new Registered($user));

            if (! $user || ! $user instanceof \App\Models\User) {
                throw new \Exception("User registration failed");
            }

            $this->guard()->login($user);

            return $this->registered($request, $user)
            ?: redirect($this->redirectPath());

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withInput()->withErrors(['regError' => $e->getMessage()]);
            report($e);
        }

    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'firstName'    => ['required', 'string', 'max:255'],
            'lastName'     => ['required', 'string', 'max:255'],
            'businessName' => ['required', 'string', 'max:255'],
            'email'        => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phoneNumber'  => ['required', 'string', 'max:255', 'unique:users'],
            'password'     => ['required', 'string', 'min:8'],
            'terms'        => ['required'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'lastName'        => $data['lastName'],
            'firstName'       => $data['firstName'],
            'email'           => $data['email'],
            'phoneNumber'     => $data['phoneNumber'],
            'password'        => Hash::make($data['password']),
            'referralChannel' => $data['referralChannel'],
        ]);

    }

    public function generateKeys($bizId)
    {
        $salt = hash('sha256', $bizId . config('app.key')); // Unique salt

        return [
            'public_key' => "PUB" . substr(hash('sha256', $salt . microtime() . bin2hex(random_bytes(16))), 0, 32),
            'secret_key' => "PRI" . substr(hash('sha256', $salt . microtime() . bin2hex(random_bytes(16))), 0, 32),
        ];
    }

    // public function getSecretKey($businessId)
    // {
    //     $business = Business::findOrFail($businessId);
    //     return Crypt::decrypt($business->secret_key);
    // }

}
