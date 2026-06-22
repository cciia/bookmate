import React, { useState } from 'react';
import axios from 'axios';
import { useNavigate } from 'react-router-dom';
import logoBookmate from '../assets/images//logo/logo-bookmate.png';
import { FiMail, FiLock, FiEye, FiEyeOff } from "react-icons/fi";


const Login = () => {
    const navigate = useNavigate();
    const [email, setEmail] = useState('');
    const [password, setPassword] = useState('');
    const [showPassword, setShowPassword] = useState(false);
    const [error, setError] = useState('');

    const handleLogin = async (e) => {
    e.preventDefault();

    if (!email || !password) {
        setError('Email dan password harus diisi');
        return;
    }

    try {
        const res = await axios.post('http://localhost:8000/api/login', {
        email,
        password
        });

        // simpan token dari backend
        localStorage.setItem('token', res.data.token);

        // simpan user (optional)
        localStorage.setItem('user', JSON.stringify(res.data.user));

        setError('');

        alert('Login berhasil');

        // pindah ke dashboard
        navigate('/dashboard');

    } catch (err) {
        setError(err.response?.data?.message || 'Login gagal');
    }
    };

  const togglePasswordVisibility = () => {
    setShowPassword(!showPassword);
  };

  return (
    <div className="min-h-screen bg-gray-50 flex items-center justify-center p-4">
      <div className="w-full max-w-md bg-white rounded-lg shadow-lg p-8">
        <div className="text-center mb-8">
          <div className="flex justify-center mb-2">
           <div className="flex justify-center">
                <img
                    src={logoBookmate}
                    alt="BookMate Logo"
                    className="h-30 w-auto"/>
            </div>
          </div>
          <h1 className="text-3xl font-bold text-black mb-2">BookMate</h1>
          <p className="text-gray-500 text-sm">Your library. Anytime. Anywhere.</p>
        </div>
        <form onSubmit={handleLogin} className="space-y-4">
          {error && (
            <div className="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-md text-sm">
              {error}
            </div>
          )}
          <div>
            <div className="relative">
             <FiMail className="absolute left-3 top-3.5 w-5 h-5 text-gray-400" />
              <input
                type="email"
                placeholder="Email"
                value={email}
                onChange={(e) => setEmail(e.target.value)}
                className="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-md focus:outline-none focus:border-black transition"/>
            </div>
          </div>
          <div>
            <div className="relative">
              <FiLock className="absolute left-3 top-3.5 w-5 h-5 text-gray-400" />
              <input
                type={showPassword ? 'text' : 'password'}
                placeholder="Password"
                value={password}
                onChange={(e) => setPassword(e.target.value)}
                className="w-full pl-10 pr-10 py-2.5 border border-gray-300 rounded-md focus:outline-none focus:border-black transition"/>
              <button
                type="button"
                onClick={togglePasswordVisibility}
                className="absolute right-3 top-3.5 text-gray-400 hover:text-gray-600 transition">
               {showPassword ? (
                <FiEye className="w-5 h-5" />
                ) : (
                <FiEyeOff className="w-5 h-5" />
                )}
              </button>
            </div>
          </div>
          <div className="text-right">
            <a href="/forgot-password" className="text-sm text-gray-600 hover:text-black transition">
              Lupa password?
            </a>
          </div>
          <button 
            type="submit" 
            className="w-full bg-black text-white py-2.5 rounded-md font-medium hover:bg-gray-800 transition duration-200">
            Login
          </button>
        </form>
        <div className="text-center mt-6">
          <p className="text-sm text-gray-600">
            Belum punya akun? <a href="/register" className="text-black font-medium hover:underline">Daftar di sini</a>
          </p>
        </div>
      </div>
    </div>
  );
};
export default Login;