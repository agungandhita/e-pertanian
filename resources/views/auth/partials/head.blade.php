<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Website agriedu - @yield('title', 'Authentication')</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Custom CSS -->
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #0f0f23;
            min-height: 100vh;
            overflow-x: hidden;
            position: relative;
        }

        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background:
                radial-gradient(circle at 25% 25%, #1e40af 0%, transparent 50%),
                radial-gradient(circle at 75% 75%, #7c3aed 0%, transparent 50%),
                radial-gradient(circle at 50% 50%, #059669 0%, transparent 70%);
            opacity: 0.1;
            animation: float 20s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            33% { transform: translateY(-20px) rotate(1deg); }
            66% { transform: translateY(10px) rotate(-1deg); }
        }

        .container-fluid {
            position: relative;
            z-index: 2;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0;
        }

        .auth-wrapper {
            display: grid;
            grid-template-columns: 1fr 1fr;
            width: 100vw;
            min-height: 100vh;
            box-shadow: none;
        }

        .auth-visual {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%);
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .auth-visual::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="50" cy="50" r="1" fill="%23ffffff" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
            opacity: 0.3;
        }

        .visual-content {
            text-align: center;
            color: white;
            z-index: 2;
            position: relative;
            padding: 40px;
        }

        .visual-icon {
            width: 120px;
            height: 120px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 30px;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            animation: pulse 3s ease-in-out infinite;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }

        .visual-icon i {
            font-size: 48px;
            color: white;
        }

        .visual-title {
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 16px;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
        }

        .visual-subtitle {
            font-size: 18px;
            opacity: 0.9;
            line-height: 1.6;
            max-width: 400px;
            margin: 0 auto;
        }

        .floating-elements {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            pointer-events: none;
        }

        .floating-element {
            position: absolute;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            animation: floatAround 15s linear infinite;
        }

        .floating-element:nth-child(1) {
            width: 60px;
            height: 60px;
            top: 20%;
            left: 10%;
            animation-delay: 0s;
        }

        .floating-element:nth-child(2) {
            width: 40px;
            height: 40px;
            top: 60%;
            right: 15%;
            animation-delay: -5s;
        }

        .floating-element:nth-child(3) {
            width: 80px;
            height: 80px;
            bottom: 20%;
            left: 20%;
            animation-delay: -10s;
        }

        @keyframes floatAround {
            0% { transform: translateY(0px) translateX(0px) rotate(0deg); }
            33% { transform: translateY(-30px) translateX(20px) rotate(120deg); }
            66% { transform: translateY(20px) translateX(-15px) rotate(240deg); }
            100% { transform: translateY(0px) translateX(0px) rotate(360deg); }
        }

        .auth-form {
            background: #ffffff;
            padding: 60px 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        .auth-form::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #667eea, #764ba2, #f093fb);
            background-size: 200% 100%;
            animation: shimmer 3s ease-in-out infinite;
        }

        @keyframes shimmer {
            0%, 100% { background-position: 200% 0; }
            50% { background-position: -200% 0; }
        }

        .auth-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .auth-logo {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 24px;
            position: relative;
            overflow: hidden;
        }

        .auth-logo::before {
            content: '';
            position: absolute;
            top: -2px;
            left: -2px;
            right: -2px;
            bottom: -2px;
            background: linear-gradient(45deg, #667eea, #764ba2, #f093fb, #667eea);
            border-radius: 22px;
            z-index: -1;
            animation: rotate 4s linear infinite;
        }

        @keyframes rotate {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .auth-logo img {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            object-fit: cover;
        }

        .auth-title {
            font-size: 28px;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 8px;
            letter-spacing: -0.5px;
        }

        .auth-subtitle {
            font-size: 16px;
            color: #6b7280;
            font-weight: 400;
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 12px;
            padding: 16px 24px;
            font-weight: 600;
            font-size: 16px;
            color: white;
            width: 100%;
            position: relative;
            overflow: hidden;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
            letter-spacing: 0.5px;
        }

        .btn-primary::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.6s;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.5);
            background: linear-gradient(135deg, #7c8cff 0%, #8a5cb8 100%);
        }

        .btn-primary:hover::before {
            left: 100%;
        }

        .btn-primary:active {
            transform: translateY(0px);
        }

        .btn-primary:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.3);
        }

        .form-label {
             font-weight: 600;
             color: #374151;
             margin-bottom: 8px;
             font-size: 14px;
             letter-spacing: 0.3px;
         }

         .form-control {
             border-radius: 12px;
             border: 2px solid #e5e7eb;
             padding: 14px 16px;
             font-size: 15px;
             background: #ffffff;
             transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
             box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
         }

         .form-control:focus {
             border-color: #667eea;
             box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
             outline: none;
         }

         .form-control::placeholder {
             color: #9ca3af;
             font-weight: 400;
         }

         .input-group {
             position: relative;
             display: flex;
             border-radius: 12px;
             overflow: hidden;
             box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
         }

         .input-group-text {
             border-radius: 12px 0 0 12px;
             border: 2px solid #e5e7eb;
             border-right: none;
             background: #f9fafb;
             color: #6b7280;
             font-size: 16px;
             padding: 14px 16px;
             display: flex;
             align-items: center;
         }

         .input-group .form-control {
             border-left: none;
             border-radius: 0 12px 12px 0;
             box-shadow: none;
         }

         .input-group:focus-within .input-group-text {
             border-color: #667eea;
             background: #f0f4ff;
             color: #667eea;
         }

         .input-group:focus-within .form-control {
             border-color: #667eea;
         }

         .password-toggle {
             cursor: pointer;
             position: absolute;
             right: 16px;
             top: 50%;
             transform: translateY(-50%);
             z-index: 10;
             color: #9ca3af;
             font-size: 16px;
             padding: 4px;
             border-radius: 6px;
             transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
         }

         .password-toggle:hover {
             color: #667eea;
             background: rgba(102, 126, 234, 0.1);
         }

         .alert {
             border-radius: 12px;
             border: none;
             padding: 16px 20px;
             margin-bottom: 24px;
             box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
         }

         .alert-success {
             background: #f0fdf4;
             color: #166534;
             border-left: 4px solid #22c55e;
         }

         .alert-danger {
             background: #fef2f2;
             color: #991b1b;
             border-left: 4px solid #ef4444;
         }

         .alert-info {
             background: #eff6ff;
             color: #1e40af;
             border-left: 4px solid #3b82f6;
         }

         .form-check-input {
             border-radius: 4px;
             border: 2px solid #d1d5db;
             transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
         }

         .form-check-input:checked {
             background-color: #667eea;
             border-color: #667eea;
         }

         .form-check-input:focus {
             box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
         }

         .form-text {
             color: #9ca3af;
             font-size: 13px;
             margin-top: 6px;
         }

         .invalid-feedback {
             color: #ef4444;
             font-size: 13px;
             margin-top: 6px;
         }

         a {
             color: #667eea;
             text-decoration: none;
             font-weight: 600;
             transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
         }

         a:hover {
             color: #5a67d8;
             text-decoration: underline;
             text-decoration-color: rgba(102, 126, 234, 0.3);
             text-underline-offset: 4px;
         }

         @media (max-width: 768px) {
             .auth-wrapper {
                 grid-template-columns: 1fr;
                 width: 100vw;
             }

             .auth-visual {
                 display: none;
             }

             .auth-form {
                 padding: 40px 30px;
                 width: 100vw;
             }

             .auth-title {
                 font-size: 24px;
             }

             .visual-title {
                 font-size: 28px;
             }

             .visual-subtitle {
                 font-size: 16px;
             }
         }

         @media (max-width: 480px) {
             .auth-form {
                 padding: 30px 20px;
             }

             .auth-title {
                 font-size: 22px;
             }
         }
    </style>
</head>
<body>
