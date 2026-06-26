import { Routes, Route, Navigate } from "react-router-dom";
import Login from "./pages/auth/Login";
// import Register from "./pages/Register";
import Dashboard from "./pages/dashboard/Dashboard";
import ProtectedRoute from "./routes/ProtectedRoute";

function App() {
  return (
    <Routes>
      {/* default langsung ke login */}
      <Route path="/" element={<Navigate to="/login" />} />

      {/* halaman login */}
      <Route path="/login" element={<Login />} />

      {/* register */}
      {/* <Route path="/register" element={<Register />} /> */}

      {/* dashboard */}
      <Route path="/dashboard" element={<ProtectedRoute> <Dashboard /></ProtectedRoute>}/>
    </Routes>
  );
}

export default App;