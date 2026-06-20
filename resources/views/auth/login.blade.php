<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TLMS - Login</title>
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    
    <style>
        * { 
            font-family: 'Outfit', sans-serif; 
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            background: linear-gradient(135deg, #847deb 0%, #6c68d7 50%, #af87ec 100%) !important;
            min-height: 100vh;
        }
        
        .login-bg {
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%) !important;
            position: relative;
            overflow: hidden;
        }
        
        .login-bg::before {
            content: '';
            position: absolute;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 50%);
            top: -50%;
            left: -50%;
            animation: float 10s ease-in-out infinite;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(-50px) rotate(10deg); }
        }
        
        .login-card {
            background: rgba(255, 255, 255, 0.98) !important;
            backdrop-filter: blur(20px);
            border-radius: 24px;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.25);
        }
        
        .form-input {
            width: 100%;
            padding: 14px 18px;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            font-size: 15px;
            transition: all 0.3s;
            background: #f8fafc;
        }
        
        .form-input:focus {
            border-color: #6366f1;
            outline: none;
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
            background: white;
        }
        
        .btn-login {
            background: linear-gradient(135deg, #6366f1, #8b5cf6) !important;
            color: white;
            padding: 14px 32px;
            border-radius: 12px;
            font-weight: 600;
            width: 100%;
            transition: all 0.3s;
            box-shadow: 0 4px 15px rgba(99, 102, 241, 0.4);
            border: none;
            cursor: pointer;
            font-size: 16px;
        }
        
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(99, 102, 241, 0.5);
        }
        
        .brand-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #6366f1, #8b5cf6) !important;
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
        }
        
        .brand-icon i {
            color: white;
            font-size: 36px;
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4">
    
    <!-- Left Side - Background with Logo -->
    {{-- <div class="hidden lg:flex lg:w-1/2 login-bg items-center justify-center relative">
        <div class="text-center text-white z-10 p-8">
            <div class="brand-icon mb-6">
                <i class="fas fa-building"></i>
            </div>
            <h1 class="text-5xl font-bold mb-4">TLMS</h1>
            <p class="text-xl text-indigo-100">Time & Labor Management System</p>
            
            <div class="mt-10 text-indigo-200 space-y-3">
                <p class="text-lg">✓ Track daily attendance</p>
                <p class="text-lg">✓ Manage employees</p>
                <p class="text-lg">✓ Generate reports</p>
            </div>
        </div>
    </div> --}}
    
    <!-- Right Side - Login Form -->
    <div class="w-full lg:w-1/2 flex items-center justify-center p-8">
        <div class="login-card w-full max-w-md p-8">
            
            <!-- Mobile Logo -->
            <div class="lg:hidden text-center mb-8">
                <div class="brand-icon mx-auto mb-4">
                    <i class="fas fa-building"></i>
                </div>
                <h1 class="text-3xl font-bold text-indigo-600">TLMS</h1>
                <p class="text-gray-500">Time & Labor Management System</p>
            </div>
            
            <h2 class="text-2xl font-bold text-gray-800 mb-2">Welcome Back! </h2>
            <p class="text-gray-500 mb-8">Please enter your details to sign in</p>
            
            <form method="POST" action="{{ route('login') }}">
                @csrf
                
                <!-- Email -->
                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2">Email Address</label>
                    <input type="email" name="email" value="{{ old('email') }}" required
                        class="form-input @error('email') border-red-500 @enderror"
                        placeholder="Enter your email">
                    @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Password -->
                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold mb-2">Password</label>
                    <input type="password" name="password" required
                        class="form-input @error('password') border-red-500 @enderror"
                        placeholder="Enter your password">
                    @error('password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Remember & Forgot -->
                <div class="flex justify-between items-center mb-6">
                    <label class="flex items-center">
                        <input type="checkbox" name="remember" class="rounded text-indigo-600">
                        <span class="ml-2 text-gray-600">Remember me</span>
                    </label>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-indigo-600 hover:text-indigo-800 text-sm">
                            Forgot password?
                        </a>
                    @endif
                </div>
                
                <!-- Login Button -->
                <button type="submit" class="btn-login">
                Sign In
                </button>
            </form>
            
            <!-- Register Link -->
            @if (Route::has('register'))
                <p class="text-center text-gray-600 mt-8">
                    Don't have an account?
                    <a href="{{ route('register') }}" class="text-indigo-600 hover:text-indigo-800 font-semibold">
                        Create one
                    </a>
                </p>
            @endif
            
        </div>
    </div>
    
</body>
</html>