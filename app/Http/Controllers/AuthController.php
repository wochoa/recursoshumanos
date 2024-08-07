<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;
    use App\Models\User;
    use Validator;

    class AuthController extends Controller
    {
        public function __construct() {
            $this->middleware('auth:api', ['except' => ['login', 'register']]);
        }
        /**
         * Get a JWT via given credentials.
         *
         * @return \Illuminate\Http\JsonResponse
         */
        public function login(Request $request)
        {
            $validator = Validator::make($request->all(), [
                'adm_email' => 'required',
                'password' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }
            if (! $token = auth()->attempt($validator->validated())) {
                return response()->json(['error' => 'Usuario no autorizado'], 401);
            }
            return $this->createNewToken($token);
        }
        /**
         * Register a User.
         *
         * @return \Illuminate\Http\JsonResponse
         */
        public function register(Request $request)
        {
            $validator = Validator::make($request->all(), [
                'adm_name' => 'required|string|between:2,100',
                'adm_email' => 'required|string|max:100|unique:users',
                'password' => 'required|string|confirmed|min:6',
            ]);
            if($validator->fails()){
                return response()->json($validator->errors()->toJson(), 400);
            }
            $user = User::create(array_merge(
                        $validator->validated(),
                        ['password' => bcrypt($request->password)]
                    ));
            return response()->json([
                'message' => 'User successfully registered',
                'user' => $user
            ], 201);
        }

        /**
         * Log the user out (Invalidate the token).
         *
         * @return \Illuminate\Http\JsonResponse
         */
        public function logout()
        {
            // auth()->logout();
            // return response()->json(['message' => 'El usuario cerró sesión correctamente']);
            auth()->user()->tokens()->delete();
            return response()->json([
                'status' => true,
                'message' => 'User logged out successfully'
            ],200);

        }
        /**
         * Refresh a token.
         *
         * @return \Illuminate\Http\JsonResponse
         */
        public function refresh()
        {
            return $this->createNewToken(auth()->refresh());
        }
        /**
         * Get the authenticated User.
         *
         * @return \Illuminate\Http\JsonResponse
         */
        public function userProfile()
        {
            return response()->json(auth()->user());
        }
        /**
         * Get the token array structure.
         *
         * @param  string $token
         *
         * @return \Illuminate\Http\JsonResponse
         */
        protected function createNewToken($token){
            return response()->json([
                'access_token' => $token,
                'token_type' => 'bearer',
                'expires_in' => auth()->factory()->getTTL() * 60,
                'user' => auth()->user()
            ]);
        }
}
